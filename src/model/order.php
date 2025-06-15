<?php
require_once __DIR__ . "/../controller/db.php";

class Order
{
    private $id;
    private $total;
    private $date;

    function __construct($id, $total, $date)
    {
        $this->id = $id;
        $this->total = $total;
        $this->date = $date;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getTotal()
    {
        return $this->total;
    }

    function setTotal($total)
    {
        $this->total = $total;
    }

    function getDate()
    {
        return $this->date;
    }

    function setDate($date)
    {
        $this->date = $date;
    }
}

function insertOrder($order)
{
    try {
        $pdo = getPdo();
        $query = "
        INSERT INTO pedido (valor, data)
        VALUES (:total, :data);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ":total" => $order->getTotal(),
            ":data" => $order->getDate(),
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}
