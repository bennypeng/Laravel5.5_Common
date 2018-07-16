<?php

return [

    /**
     * 操作返回码相关
     */
    'VERFY_TOKEN_ERROR'        => ['message' => 'token验证错误',                'code' => 10000],
    'VERFY_ARGS_ERROR'         => ['message' => '参数验证错误',                 'code' => 10001],

    'LOGIN_SUCCESS'            => ['message' => '登录成功',                     'code' => 10100],
    'LOGIN_ERROR'              => ['message' => '登录失败',                     'code' => 10101],
    'LOGIN_OUT'                => ['message' => '登出成功',                     'code' => 10102],
    'LOGIN_OUT_ERROR'          => ['message' => '登出失败',                     'code' => 10103],

    'REGIST_ERROR'             => ['message' => '注册失败',                     'code' => 10200],
    'REGIST_SUCCESS'           => ['message' => '注册成功',                     'code' => 10201],

];
