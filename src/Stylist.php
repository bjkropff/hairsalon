<?php

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test;password=1234');


    class Stylist
    {
        private $employee;
        private $id;

        function __construct($employee, $id)
        {
            $this->employee = $employee;
            $this->id = $id;
        }

        function getEmployee()
        {
            return $this->employee;
        }

        function setEmployee($new_employee)
        {
            $this->employee = (string) $new_employee;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO stylists (employee) VALUES ('{$this->getEmployee()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $one_stylist){
                $employee = $one_stylist['employee'];
                $id = $one_stylist['id'];
                $new_stylist = new Stylist($employee, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM stylists *;');
        }

        static function findStylist($search_id)
        {
            $found_stylist = null;
            $all_stylists = Stylist::getAll();
            foreach($all_stylists as $person) {
                $stylist_id = $person->getId();
                if($stylist_id == $search_id) {
                    $found_stylist = $person;
                }
            }
            return $found_stylist;
        }

        function getClients()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            $gottenClients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($name, $id, $stylist_id);
                array_push($gottenClients, $new_client);
            }
            return $gottenClients;
        }

        function update($new_employee)
        {
            $GLOBALS['DB']->exec("UPDATE stylist SET employee = '{$new_employee}' WHERE id = {$this->getId()}");
            $this->setEmployee($new_employee);
        }
        
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM client WHERE stylist_id = {$this->getId()}");
        }
    }//closes the Stylist class

?>
