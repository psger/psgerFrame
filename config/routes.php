<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-22
 * Time: 21:25
 */
use NoahBuscher\Macaw\Macaw;

Macaw::get('home', 'HomeController@home');
Macaw::get('vip', 'VipController@index');
Macaw::get('del', 'CurlController@del');
Macaw::get('csv', 'CsvController@export');

Macaw::$error_callback = function() {
    throw new Exception("路由无匹配项 404 Not Found");
};

Macaw::dispatch();