<?php

namespace app\lib;

/** 
 * Класс отвечающий за ответы сервером
 */
class Responser
{
    public $response_messages = require "app/config/response_msg.php";

    public static function redirectResponse($url)
    {
        header('location: ' . $url);
        exit;
    }

    public static function ajaxResponseSuccess()
    {
        self::ajaxResponse(true);
    }

    public static function ajaxResponseError($msg)
    {
        self::ajaxResponse(false, ["msg" => $msg]);
    }

    protected static function ajaxResponse($status, $data = [])
    {
        $response = ['status' => $status];
        foreach ($data as $key => $value) $response[$key] = $value;

        echo json_encode($response);
        exit();
    }
}
