<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {

        return 'admin';
    }

    public function info()
    {

        return '{
            "roles": ["admin"],
            "token": "admin",
            "introduction": "我是超级管理员",
            "avatar": "https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif",
            "name": "Super Admin"
        }';
    }
}