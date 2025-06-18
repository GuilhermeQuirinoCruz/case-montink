<?php
class OperationStatus {
    private $success;
    private $message;

    function __construct($success, $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    function getSuccess()
    {
        return $this->success;
    }

    function setSuccess($success)
    {
        $this->success = $success;
    }
    
    function getMessage()
    {
        return $this->message;
    }

    function setMessage($message)
    {
        $this->message = $message;
    }
}

function getErrorMessageFromException(Exception $exception) {
    return $exception->getCode() . ": " . $exception->getMessage();
}