<?php
require_once("./config.php");

$response = [];
if(isset($_POST['tr_desc']) && $db->filter($_POST['tr_desc'])){
    $tr_desc = $db->filter($_POST['tr_desc']);
} else {
    $response = [
        'status' => "error",
        "msg" => "Description is required"
    ];
}


if(isset($_POST['tr_amount']) && $db->filter($_POST['tr_amount'])){
    $tr_amount = $db->filter($_POST['tr_amount']);
} else {
    $response = [
        'status' => "error",
        "msg" => "Amount is required"
    ];
}

if(isset($_POST['tr_type']) && $db->filter($_POST['tr_type'])){
    $tr_type = $db->filter($_POST['tr_type']);
} else {
    $response = [
        'status' => "error",
        "msg" => "Please select Transaction type!!"
    ];
}

if(!isset($response['status'])){
    $results = $db->query("INSERT INTO transactions ( amount, type, description ) VALUES ( '$tr_amount', '$tr_type', '$tr_desc' )");

    $response = [
        'status' => "error",
        "msg" => "Something went  wrong !!"
    ];

    if($results){
        $response = [
            'status' => "success",
            "msg" => "Added successfully"
        ];
    }

}

echo json_encode(($response));
