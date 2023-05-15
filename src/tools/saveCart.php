<?php


$data = file_get_contents("php://input");
if ($data === false)
{
    echo '{"ReturnCode": 1}';
    exit;
}

$object = json_decode($data, true);
if ($object === null)
{
    echo '{"ReturnCode": 1}';
    exit;
}

$userId = $object['id'];
foreach($object['cart'] as $item)
{
    $articleId = $item['id'];
    $articleQuantity = $item['quantity'];
    // Update xxxxx
}



echo '{"ReturnCode": 0}';