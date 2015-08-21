<?php
    class Client
    {
        private $name;
        private $phone;
        private $email;
        private $stylist_id;
        private $id;
    }

    function __construct($name, $phone, $email, $stylist_id, $id=null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

?>
