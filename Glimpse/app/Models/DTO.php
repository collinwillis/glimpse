<?php

namespace App\Models;

class DTO implements \JsonSerializable {
    
    private $code;
    private $message;
    private $data;
    
    public function __construct($code, $message, $data) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}