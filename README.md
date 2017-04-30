# web-crontab
页面管理定时任务，多方案、多用户身份运行，快捷切换。


# 安装
```php
git clone https://github.com/selden1992/web-crontab.git

cd web-crontab

sudo php cron make
```
项目不依赖数据库，必须保证storage目录可读写。

新安装的账号密码都是：admin

# 编译，未发版本时，克隆是不能运行

```php
cd resources

npm run build

cp -R -f ./* ../public/
```
编译前端代码，并且copy到public下，就可以运行

# 修改命令
项目所有命令保存在 config/command.php 下，

系统命令不兼容时、如果发现项目不能运行，查看该文件修改。

最好提bug给我们，我们会尽快新增适配不同linux不同版本的差异

# 项目原理


# 配置路由

route/public.php
```php
<?php
/**
 * 公开路由
 */
return [
    '404'=>'PublicController@error',

    '/'=>'PublicController@index',
];
```

# 这只中间件

config/route.php
```php
<?php
use system\Route;

/**
 * 设置路由中间件
 */


Route::middleware('auth','Auth');

/**
 * 统一整理路由
 */
Route::Arrangement();
```
