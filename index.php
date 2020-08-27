<?php

namespace App;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $caller = new Caller;
    $caller->make('https://api.github.com/users', 'get');
    $caller->where('site_admin','=', false);
    $caller->where('id','!=', 4);
    $caller->sort('id', 'DESC');
    echo $caller->get();
} catch (\Exception | \Error $e) {
    echo $e->getMessage();
}