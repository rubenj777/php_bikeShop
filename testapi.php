<?php


$tab1 = ['prenom' => 'charles', 'grave' => 'ruben'];
$tab2 = ['cool' => 'super', 'top' => 'notvch'];
$tab3 = ['neuf' => 'dix', 'onze' => 'douze'];

$array = [$tab1, $tab2, $tab3];

$requestBody = file_get_contents('php://input');
$values = json_decode($requestBody, true);

if (!empty($values['truc']) && $values['truc'] == 'machin') {
    header('Access-Control-Allow-Origin: *');
    echo json_encode($array);
} else {
    header('Access-Control-Allow-Origin: *');
    echo json_encode("nooo");
}

