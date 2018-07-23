<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

#### 主要修改了一下内容

- 安装了常用的包，如debugbar、dbal、predis、log-viewer等
- 修改了时区、本地语言、日志记录方式（按天）、session驱动使用redis
- 使用jwt进行用户授权验证
- 增加constants.php用于自定义常量
- 提供注册、登录、登出示例（注册登录POST方法使用mobile及password参数，登出POST在header中加入Authorization即可）
    - /api/user/register 
    - /api/user/login
    - /api/user/logout
- 提供helper自定义方法，在TestController中提供使用示例
- 集成了laravel-admin后台管理，使用/admin访问
- 集成了日志管理后台，使用/logs访问
- 翻译了验证控件validation
- 集成了laravel-s来使用swoole
    - 配置参考https://github.com/hhxsv5/laravel-s/blob/master/README-CN.md
    - 使用php artisan laravels start 方法启动服务（默认使用8081作为监听端口）
    - 加入/chat简易聊天室DEMO
- 加入bootstrap、jQuery 本地库

#### 并没有加入什么新奇玩意，仅用于工作方便使用