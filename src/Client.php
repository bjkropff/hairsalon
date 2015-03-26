<?php

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test;password=1234');


    class Client
    {
        private $name;
        private $id;
        private $stylist_id;

        function __construct($name, $id, $stylist_id)
        {
            $this->name = $name;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }

        //SETTERS
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setStylistId()
        {
            $this->stylist_id = (int) $new_stylist_id;
        }

        //GETTERS
        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', '{$this->getStylistId()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_names = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $names = array();
            foreach($returned_names as $a_name){
                $name = $a_name['name'];
                $id = $a_name['id'];
                $stylist_id = $a_name['stylist_id'];
                $new_name = new Client($name, $id, $stylist_id);
                array_push($names, $new_name);
            }
            return $names;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM clients *;');
        }

        static function findClient($find_id)
        {
            $found_client = null;
            $all_clients = Client::getAll();
            foreach($all_clients as $person) {
                $client_id = $person->getId();
                if($client_id == $find_id) {
                    $found_client = $person;
                }
            }
            return $found_client;

        }

    }//closes class


?>
