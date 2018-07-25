<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

#### 主要修改了一下内容

- 安装了常用的包，如debugbar、dbal、predis、log-viewer等
- 加入bootstrap、jQuery 本地库
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
    - nginx的配置如下，也可参考（https://github.com/hhxsv5/laravel-s/blob/master/README-CN.md）
    ```
    gzip on;
    gzip_min_length 1024;
    gzip_comp_level 2;
    gzip_types text/plain text/css text/javascript application/json application/javascript application/x-javascript application/xml application/x-httpd-php image/jpeg image/gif image/png font/ttf font/otf image/svg+xml;
    gzip_vary on;
    gzip_disable "msie6";
    
    map $http_upgrade $connection_upgrade {
        default upgrade;
        ''      close;
    }
    
    upstream laravels {
        server 127.0.0.1:8081 weight=5 max_fails=3 fail_timeout=30s;
    }
    
    server {
        listen 80;
        server_name .laravel.test;
        root "/home/vagrant/Code/Laravel5.5_Common/public";
    
        autoindex off;
        index index.html index.htm;
    
        location / {
            try_files $uri $uri/ @laravels;
        }
    
        location =/ws {
            proxy_http_version 1.1;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Real-PORT $remote_port;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Host $http_host;
            proxy_set_header Scheme $scheme;
            proxy_set_header Server-Protocol $server_protocol;
            proxy_set_header Server-Name $server_name;
            proxy_set_header Server-Addr $server_addr;
            proxy_set_header Server-Port $server_port;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection $connection_upgrade;
            proxy_pass http://laravels;
        }
    
        location @laravels {
            proxy_http_version 1.1;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Real-PORT $remote_port;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Host $http_host;
            proxy_set_header Scheme $scheme;
            proxy_set_header Server-Protocol $server_protocol;
            proxy_set_header Server-Name $server_name;
            proxy_set_header Server-Addr $server_addr;
            proxy_set_header Server-Port $server_port;
            proxy_pass http://laravels;
            add_header Access-Control-Allow-Origin *;
            add_header Access-Control-Allow-Headers "Origin, X-Requested-With, Content-Type, Accept";
            add_header Access-Control-Allow-Methods "GET, POST, OPTIONS";
        }
    
    }

    ```
    - 使用php artisan laravels start 方法启动服务（默认使用8081作为监听端口）
    - 8081作为websocket端口，8082作为tcp端口，8086作为udp端口
    - 加入/chat简易聊天室DEMO
- 修复使用了swoole后 Laravel Log Viewer 中操作日志的BUG，需要手动修改以下文件
    - /vendor/rap2hpoutre/laravel-log-viewer/src/controllers/LogViewerController.php
    ```
    public function index()
    {
        //  重置request
        unset($this->request);
        $this->request = app('request');
        ......
    }
    ```
    - /vendor/rap2hpoutre/laravel-log-viewer/src/Rap2hpoutre/LaravelLogViewer/LaravelLogViewer.php
    ```
    public static function all()
    {
        $log = array();
        $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?\].*/';

        if (self::$file && !file_exists(self::$file)) {
            self::$file = null;
        }
        ......
    }
    ```
    

#### 并没有加入什么新奇玩意，仅用于工作方便使用