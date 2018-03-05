<?php


use App\Models\User;
use Phinx\Seed\AbstractSeed;

class Database extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->initUser();
    }

    /**
     * 默认本地环境
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function initEnv()
    {
        $data = [
            [
                'title'=>'admin',
                'type'=>'本机',
            ],
        ];
        $environment = $this->table('environment');
        $environment->insert($data)->save();
    }

    /**
     * 初始化用户
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    private function initUser()
    {
        $data = [
            [
                'username'=>'admin',
                'password'=>(new User())->password('admin'),
                'email'=>'admin@admin.com'
            ],
        ];
        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
