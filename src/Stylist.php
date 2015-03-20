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

        function getName()
        {
            return $this->employee;
        }

        function setName($new_employee)
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
            $GLOBALS['DB']->exec('INSERT INTO stylist (name) VALUES ("{$this->getEmployee()}")');
        }

        // static function getAll()
        // {
        //     $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
        //     $stylists = array();
        //     foreach($returned_stylist as $one_stylist){
        //         $employee = $one_stylist['employee'];
        //         $new_stylist = new Stylist($emplyee);
        //         array_push($stylists, $new_stylist);
        //     }
        //     return $stylists;
        // }
        //
        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM stylists *;');
        }

        // static function find($search_id)
        // {
        //     $found_stylist = null
        //     $stylists = Stylist::getAll();
        //     foreach($stylists as $person) {
        //         $stylist_id = $person->getId();
        //         if($stylist_id == $search_id) {
        //             $found_stylist = $person;
        //         }
        //     }
        //     return $found_stylist;
        // }
    }//closes the Stylist class

?>
