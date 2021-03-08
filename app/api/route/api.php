<?php
use think\facade\Route;

Route::rule('smscode', 'sms/code', 'POST');
Route::rule('lists', 'mall.lists/index');
Route::rule('detail/:id', 'mall.detail/index');
Route::resource('order', 'order.index');