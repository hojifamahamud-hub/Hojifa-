<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// cPanel স্ট্রাকচার: /home/username/laravel_app/ এ পুরো কোড, public_html/ এ এই ফাইলগুলো।
// নিচের পাথগুলো আগে থেকেই laravel_app ফোল্ডারে পয়েন্ট করা — আর কিছু বদলাতে হবে না।
if (file_exists($maintenance = __DIR__.'/../laravel_app/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../laravel_app/vendor/autoload.php';

$app = require_once __DIR__.'/../laravel_app/bootstrap/app.php';

$app->handleRequest(Request::capture());
