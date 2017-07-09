# web-crontab
页面管理定时任务，多方案、多用户身份运行，快捷切换。 


# 安装
```php
git clone https://github.com/selden1992/web-crontab.git

cd web-crontab

su

php cron init

```
php cron init命令会生成当前系统的命令备份，和安装一个crontab检查任务

项目不依赖数据库，必须保证storage、config目录可读写。这两个目录保存了所有的命令和账号信息

新安装的账号密码都是：admin

# 手动启动命令
如果关闭了默认安装 方案，必须手动执行下面命令才可以生效命令
```php
cd web-crontab
php cron check
```

# 修改命令

项目所有命令保存在 config/command.php 下，

系统命令不兼容时、如果发现项目不能运行，查看该文件修改。
```php
// 重启命令
'crontab_restart'=>'service cron restart',

// cron命令目录
'cron_path'=>'/usr/bin/crontab',
```
最好提bug给我们，我们会尽快新增适配不同linux不同版本的差异

# 项目原理

