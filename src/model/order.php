<?php
require_once $BASE_PATH . "/controller/db.php";
require_once $BASE_PATH . "/model/operation-status.php";

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

function getOrderFromData($data)
{
    return new Order(
        $data["id"],
        $data["valor"],
        $data["data"],
        $data["endereco"]
    );
}

function getAllOrders(): array
{
    try {
        $pdo = getPdo();
        $query = "
        SELECT * FROM pedido;";

        $stmt = $pdo->query($query);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map("getOrderFromData", $data);
    } catch (Exception $e) {
        return [];
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
