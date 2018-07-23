<?php


//  简易聊天室
Route::get('/chat', function () {
    return view('chat');
});

//  日志查询
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
