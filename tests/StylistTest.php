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

        function test_getEmployee()
        {
            //Arrange
            $employee = "Bob";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);

            //Act
            $result = $test_get_employee->getEmployee();

            //Assert
            $this->assertEquals($employee, $result);

        }

        function test_getId()
        {
            //Arrange
            $employee = "Bob";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);
            //Act
            $result = $test_get_employee->getId();
            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $employee = "Bob";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);

            //Act
            $test_get_employee->save();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals($test_get_employee, $result[0]);
        }
        //
        // function test_deleteAll()
        // {
        //     //Arrange
        //     $employee = "Bob";
        //     $id = 1;
        //     $employee2 = "Sally";
        //     $id = 2;
        //     $test_Stylist = new Stylist($employee, $id);
        //     $test_Stylist->save();
        //     $test_Stylist2 = new Stylist($employee2, $id);
        //     $test_Stylist2->save();
        //
        //     //Act
        //     Stylist::deleteAll();
        //
        //     //Assert
        //     $result = Stylist::getAll();
        //     $this->assertEquals([], $result);
        // }


    }//closes the StylistTest

?>
