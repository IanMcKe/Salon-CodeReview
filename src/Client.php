<?php
    class Client
    {
        private $name;
        private $phone;
        private $email;
        private $stylist_id;
        private $id;


        function __construct($name, $phone, $email, $stylist_id, $id=null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->email = $email;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getEmail()
        {
            return $this->email;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function setEmail($new_email)
        {
            $this->email = $new_email;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, phone, email, stylist_id) VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getEmail()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->name = $new_name;
        }

        function updatePhone($new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET phone = '{$new_phone}' WHERE id={$this->getId()};");
            $this->phone = $new_phone;
        }

        function updateEmail($new_email)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET email = '{$new_email}' WHERE id={$this->getId()};");
            $this->email = $new_email;
        }

        function updateStylistId($new_stylist_id)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET stylist_id = {$new_stylist_id} WHERE id={$this->getId()};");
            $this->stylist_id = $new_stylist_id;
        }

        function update($new_name, $new_phone, $new_email, $new_stylist_id)
        {
            $this->updateName($new_name);
            $this->updatePhone($new_phone);
            $this->updateEmail($new_email);
            $this->updateStylistId($new_stylist_id);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id={$this->getId()};");
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client){
                $name = $client['name'];
                $phone = $client['phone'];
                $email = $client['email'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $phone, $email, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $found_client = NULL;
            $clients = Client::getAll();
            foreach($clients as $client){
                $id = $client->getId();
                if($id == $search_id){
                    $found_client = $client;
                }
            }
            return $found_client;
        }

    }


?>
