<?php

namespace App;

class Response
{
    /**
     * @param $res
     * @return void
     * renvoie le contenu sérialisé en JSON en tant que réponse
     */
    public static function json($res, ?string $methodSpe = null)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers:*');

        if($methodSpe == 'delete'){
            header('Access-Control-Allow-Methods: DELETE');
        }
        if($methodSpe == 'put') {
            header('Access-Control-Allow-Methods: PUT');
        }

        echo json_encode($res);
    }

    /**
     * redirige vers l'url passée en param
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
