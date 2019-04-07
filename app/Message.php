<?php

namespace App;

class Message
{
 
    const OK = 1;

    const DB_ERROR = 2;
    const DB_DUPLICATED_KEY = 3;

    const MESSAGE = [
        self::OK => '成功',
        self::DB_ERROR => '資料庫發生錯誤',
        self::DB_DUPLICATED_KEY => '不可存入相同的資料到資料庫中'
    ];

    public static function getByCode($code, $message = null) {
        if (empty($message)) {
            $message = self::message($code);
        }

        return [
            'code' => $code,
            'message' => $message
        ];
    }

    public static function message($code) {
        if (array_key_exists($code, self::MESSAGE)) {
            return self::MESSAGE[$code];
        }

        return null;
    }

}
