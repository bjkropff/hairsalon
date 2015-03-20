<?php

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');


    class Client
    {
        private $name;
        private $id;

        function __construct($name, $id)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }


        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (name) VALUES ('{$this->getName()}') RETURNING id;");
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
                $new_name = new Client($name, $id);
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
