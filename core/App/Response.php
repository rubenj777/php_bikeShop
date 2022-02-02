<?php

namespace App;

class Response
{
    /**
     * redirigie vers l'url passée en param
     * @param array $param
     * @return void
     */
    public static function redirect(?array $param = null): void
    {
        $url = "";
        if ($param) {
            $url = "?";
            foreach ($param as $key => $value) {
                $newParamGet = $key . "=" . $value . "&";
                $url .= $newParamGet;
            }
        }
        header("Location: " . $url);
        exit();
    }
}
