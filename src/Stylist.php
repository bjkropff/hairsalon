<?php

    class Stylist
    {
        private $name;
    //    private $id

        function __construct($name)//, $id)
        {
            $this->name = $name;
        //    $this->is = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec('INSERT INTO stylist (name) VALUES ("{$this->getName()}")');
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylist as $one_stylist){
                $name = $one_stylist['name'];
                $new_stylist = new Stylist($name);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM stylists *;');
        }
    }//closes the Stylist class

?>
