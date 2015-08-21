<?php
    class Stylist
    {
        private $name;
        private $phone;
        private $email;
        private $id;

        function __construct($name, $phone, $email, $id=null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->email = $email;
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

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, phone, email) VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getEmail()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->name = $new_name;
        }

        function updatePhone($new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET phone = '{$new_phone}' WHERE id={$this->getId()};");
            $this->phone = $new_phone;
        }

        function updateEmail($new_email)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET email = '{$new_email}' WHERE id={$this->getId()};");
            $this->email = $new_email;
        }

        function update($new_name, $new_phone, $new_email)
        {
            $this->updateName($new_name);
            $this->updatePhone($new_phone);
            $this->updateEmail($new_email);
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients ORDER BY name;");
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

        function delete()
        //Idea: have this function set all clients' stylist_id under the stylist this function is called on to 0. Then have them grouped under "unassigned clients" on the webpage.
        {
            $GLOBALS['DB']->exec("UPDATE clients SET stylist_id = 0 WHERE stylist_id={$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id={$this->getId()};");
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist){
                $name = $stylist['name'];
                $phone = $stylist['phone'];
                $email = $stylist['email'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $phone, $email, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function find($search_id)
        {
            $found_stylist = NULL;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist){
                $id = $stylist->getId();
                if($id == $search_id){
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

    }
?>
