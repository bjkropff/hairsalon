<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_get()
        {
            //Arrange
            $name = "Bob";
            $test_get_name = new Stylist($name);

            //Act
            $result = $test_get_name->getName();

            //Assert
            $this->assertEquals($test_get_name, $result);

        }

        function test_save()
        {
            //Arrange
            $name = "Bob";
            $test_get_name = new Stylist($name);

            //Act
            $test_get_name->save();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals($test_get_name, $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bob";
            $name = "Sally";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            //Act
            Stylist::deleteAll();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([], $result);
        }


    }//closes the StylistTest

?>
