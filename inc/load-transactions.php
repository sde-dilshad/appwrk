<?php
require_once("./config.php");
$results = $db->query("SELECT * FROM transactions ORDER BY id DESC");

$response = [
];
$response_sql = [];

while($row = $results->fetch_assoc()){
    $response_sql[] = $row;
}

// $balance = 0;
// if(empty($response_sql)){
//     echo json_encode(['status']);
// }

$response_sql = array_reverse($response_sql);
foreach($response_sql as $result) {
    if($result['type'] == 1){
        $balance += $result['amount'];
    } elseif ($result['type'] == 2) {
        $balance -= $result['amount'];
    }

    // echo balance;
    $result['balance'] = $balance;

    $response[] = $result;
}



echo json_encode(array_reverse($response));
?>