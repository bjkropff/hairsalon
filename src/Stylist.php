<?php

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');


    class Stylist
    {
        private $employee;
    //    private $id

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
            $GLOBALS['DB']->exec('INSERT INTO stylist (employee) VALUES ("{$this->getEmployee()}") RETURNING id;')
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
                $new_stylist = new Stylist($emplyee, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM stylists *;');
        }

        // static function find($search_id)
        // {
        //     $found_stylist = null
        //     $all_stylists = Stylist::getAll();
        //     foreach($all_stylists as $person) {
        //         $stylist_id = $person->getId();
        //         if($stylist_id == $search_id) {
        //             $found_stylist = $person;
        //         }
        //     }
        //     return $found_stylist;
        //}
    }//closes the Stylist class

?>
