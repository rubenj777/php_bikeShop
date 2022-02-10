<?php

namespace App;

class Request
{
    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public static function post(string $dataType, array $requestBodyParams)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return false;
        }
        return Request::isSubmitted($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public static function get(string $dataType, array $requestBodyParams)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return false;
        }
        return Request::isSubmitted($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public static function put(string $dataType, array $requestBodyParams)
    {
        if($_SERVER['REQUEST_METHOD'] != 'PUT'){
            return false;
        }
        return Request::isSubmitted($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public static function delete(string $dataType, array $requestBodyParams)
    {
        if($_SERVER['REQUEST_METHOD'] != 'DELETE'){
            return false;
        }
        return Request::isSubmitted($dataType, $requestBodyParams);
    }


    /**
     * verifie si tous les parametres de la requete sont bons, text ou nombres entiers
     * si tout est valide, renvoie un tableau avec ces parametres
     * sinon renvoie un booleen faux
     *
     * @param string $dataType
     * @param array $requestBodyParams
     * @return false | array
     */
    public static function isSubmitted(string $dataType, array $requestBodyParams)
    {
        if($dataType == "json"){
            $bodyRequest = file_get_contents('php://input');
            $requestParams = json_decode($bodyRequest, true);
        }

        if($dataType == "form"){
            $requestParams = $_POST;
        }

        $results = false;

        foreach($requestBodyParams as $parametre=>$type) {
            if(!empty($requestParams[$parametre]))
            {
                if($type == 'text'){
                    $results[$parametre] = htmlspecialchars($requestParams[$parametre]);
                } else if($type == 'number') {
                    if(ctype_digit($requestParams[$parametre])){
                        $num = htmlspecialchars($requestParams[$parametre]);
                        $results[$parametre] = (int)$num;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        return $results;
    }
}