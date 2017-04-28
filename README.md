# simple
一个微框架，简单到只有路由和中间件

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
