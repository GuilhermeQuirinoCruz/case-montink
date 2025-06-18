<?php
function getStatusAsJSON($success, $title, $message)
{
    return json_encode(array(
        "success" => $success,
        "title" => $title,
        "message" => nl2br($message)
    ));
}

function formatPrice($price)
{
    return number_format($price, 2);
}