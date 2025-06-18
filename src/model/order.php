<?php
require_once __DIR__ . "/../controller/db.php";
require_once __DIR__ . "/operation-status.php";

class Order
{
    private $id;
    private $total;
    private $date;
    private $address;

    function __construct($id, $total, $date, $address)
    {
        $this->id = $id;
        $this->total = $total;
        $this->date = $date;
        $this->address = $address;
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

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($Address)
    {
        $this->address = $Address;
    }
}

function insertOrder($order): OperationStatus
{
    try {
        $pdo = getPdo();
        $query = "
        INSERT INTO pedido (valor, data, endereco)
        VALUES (:total, :data, :endereco);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ":total" => $order->getTotal(),
            ":data" => $order->getDate(),
            ":endereco" => $order->getAddress(),
        ]);

        return new OperationStatus(true, "");
    } catch (Exception $e) {
        return new OperationStatus(false, getErrorMessageFromException($e));
    }
}
