<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/24
 * Time: 15:49
 */

namespace App\Models;


class System
{
    public $login   = false;
    public $connect = null;

    /**
     * 打开某个环境ssh链接
     * @param $env
     */
    public function __construct($env)
    {
        $arrHost = explode(':', $env->host);
        $connect = ssh2_connect($arrHost[0], $arrHost[1] ?? 22);
        if ($connect === false) {
            return false;
        }
        if ($env->username && $env->password) {
            $auth = ssh2_auth_password($connect, $env->username, $env->password);
            if ($auth === false) {
                return false;
            }
            $this->login   = true;
            $this->connect = $connect;
        }else{
            // 没有密码，使用ssh-key登录
            exec("id -un",$arr);
            $env->username = reset($arr);
            unset($arr);
            exec("cd ~/ && pwd",$arr);
            $userHome = reset($arr);
            $auth = ssh2_auth_pubkey_file($connect, $env->username, "{$userHome}/.ssh/id_rsa.pub","{$userHome}/.ssh/id_rsa");
            if ($auth === false) {
                return false;
            }
            $this->login   = true;
            $this->connect = $connect;
        }
    }

    /**
     * 停止单个任务
     *
     * @param $user
     * @param $id
     * @param $cmd
     * @return bool
     * @author 明月有色 <2206582181@qq.com>
     */
    public function stopCmd($user,$id,$cmd)
    {
        $userCmd = $this->getUserCrontab($user);
        $isDelete = false;
        foreach ($userCmd as $key=>$value){
            if( $value->id==$id ){
                if( $cmd==$value->command ){
                    unset($userCmd[$key]);
                    $isDelete = true;
                }else{
                    return false;
                }
            }
        }
        if( $isDelete ){
            if( $userCmd ){
                $this->push($userCmd);
            }else{
                $this->exec("crontab -u {$user} -r");
            }
        }
        return $isDelete;
    }

    /**
     * 获取允许su user切换的用户
     *
     * @return array
     * @author 明月有色 <2206582181@qq.com>
     */
    public function getUserList()
    {
        //$data = $this->exec("cat /etc/passwd | cut -f 1 -d:");
        $data = $this->exec("cat /etc/passwd");
        $data = $data ? explode(PHP_EOL, $data) : [];
        $user = [];
        foreach ($data as $str) {
            $temp = explode(":", $str);
            if (end($temp) == "/bin/bash") {
                $user[] = $temp[0];
            }
        }
        return $user;
    }

    /**
     * 清空所有用户的定时任务
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function clear()
    {
        $this->exec('for u in `cat /etc/passwd | cut -f 1 -d:`;do crontab -r -u $u;done');
    }

    /**
     * 获取所有定时任务列表
     *
     * @return array
     * @author 明月有色 <2206582181@qq.com>
     */
    public function getCrontab()
    {
        $users      = $this->getUserList();
        $arrUserCmd = [];
        foreach ($users as $user) {
            $data = $this->exec("crontab -l -u {$user}");
            if ($data) {
                $data = $data ? array_filter(explode(PHP_EOL, $data)) : [];
                foreach ($data as $key => $cmd) {
                    if (is_numeric($cmd{0}) || $cmd{0} == "*") {
                        if (isset($data[$key - 1]) && ($data[$key - 1]{0} == "#")) {
                            $title = substr($data[$key - 1], 1);
                        } else {
                            $title = '';
                        }
                        $temp = explode(' ', $cmd);
                        list($run_time['minute'], $run_time['hour'], $run_time['day'], $run_time['month'], $run_time['week']) = array_slice($temp,
                                                                                                                                            0,
                                                                                                                                            5);
                        $tmp          = [
                            "id"       => "{$user}_" . $key,
                            'sys_user' => $user,
                            'title'    => $title,
                            'run_time' => implode(' ', $run_time),
                            "command"  => implode(' ', array_slice($temp, 5)),
                        ];
                        $arrUserCmd[] = json_decode(json_encode($tmp));
                    }
                }
            }
        }
        return $arrUserCmd;
    }

    /**
     * 获取某用户定时任务
     *
     * @param $user
     * @return array
     * @author 明月有色 <2206582181@qq.com>
     */
    public function getUserCrontab($user)
    {
        $arrUserCmd = [];
        $data       = $this->exec("crontab -l -u {$user}");
        if ($data) {
            $data = $data ? array_filter(explode(PHP_EOL, $data)) : [];
            foreach ($data as $key => $cmd) {
                if (is_numeric($cmd{0}) || $cmd{0} == "*") {
                    if (isset($data[$key - 1]) && ($data[$key - 1]{0} == "#")) {
                        $title = substr($data[$key - 1], 1);
                    } else {
                        $title = '';
                    }
                    $temp = explode(' ', $cmd);
                    list($run_time['minute'], $run_time['hour'], $run_time['day'], $run_time['month'], $run_time['week']) = array_slice($temp,
                                                                                                                                        0,
                                                                                                                                        5);
                    $tmp          = [
                        "id"       => $key,
                        'sys_user' => $user,
                        'title'    => $title,
                        'run_time' => implode(' ', $run_time),
                        "command"  => implode(' ', array_slice($temp, 5)),
                    ];
                    $arrUserCmd[] = json_decode(json_encode($tmp));
                }
            }
        }
        return $arrUserCmd;
    }

    /**
     * @param string $user
     * @param array $arrCmd
     * @author 明月有色 <2206582181@qq.com>
     */
    public function createCmd($user, $arrCmd)
    {
        $cmdList   = $this->getUserCrontab($user);
        $cmdList[] = (object)$arrCmd;
        $string    = '';
        foreach ($cmdList as $cmd) {
            $tmp    = PHP_EOL ."#{$cmd->title}" . PHP_EOL . "{$cmd->run_time} {$cmd->command}" . PHP_EOL;
            $string = $string.$tmp;
        }
        $string = $string.PHP_EOL;
        $file   = "/tmp/{$user}.crontab";
        $this->putContent($file,$string);
        $this->exec("crontab -u {$user} {$file}");
    }

    /**
     * 保存文件
     *
     * @param $file
     * @param $text
     * @author 明月有色 <2206582181@qq.com>
     */
    public function putContent($file,$text)
    {
        $sftp = ssh2_sftp($this->connect);
        $stream = fopen("ssh2.sftp://{$sftp}{$file}",'w+');
        fwrite($stream,$text);
        fclose($stream);
    }

    /**
     * 批量写入
     *
     * @param $commands
     * @author 明月有色 <2206582181@qq.com>
     */
    public function push($commands)
    {
        $userCmd = [];
        foreach ($commands as $cmd) {
            if( $cmd->sys_user ){
                $userCmd[$cmd->sys_user][] = $cmd;
            }
        }
        foreach ($userCmd as $user=>$commands) {
            $string    = '';
            foreach ($commands as $cmd) {
                $tmp    = PHP_EOL ."#{$cmd->title}" . PHP_EOL . "{$cmd->run_time} {$cmd->command}" . PHP_EOL;
                $string = $string.$tmp;
            }
            $string = $string.PHP_EOL;
            $file   = "/tmp/{$user}.crontab";
            $this->putContent($file,$string);
            $this->exec("crontab -u {$user} {$file}");
        }
    }

    /**
     * @param $cmd
     * @return bool|string
     * @author 明月有色 <2206582181@qq.com>
     */
    public function exec($cmd)
    {
        $data = ssh2_exec($this->connect, $cmd);
        stream_set_blocking($data, true);
        if ($data == false) {
            return false;
        }
        return stream_get_contents($data);
    }

    /**
     * 关闭链接
     */
    public function __destruct()
    {
        if ($this->login) {
            $this->login   = false;
            $this->connect = null;
        }
    }
}