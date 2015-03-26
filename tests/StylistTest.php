<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test;password=1234');

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
            $test_get_employee->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_get_employee, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $employee = "Billy";
            $id = 1;
            $employee2 = "Bob";
            $id2 = 2;
            $test_get_employee = new Stylist($employee, $id);
            $test_get_employee->save();
            $test_get_employee2 = new Stylist($employee2, $id2);
            $test_get_employee2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_get_employee, $test_get_employee2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $employee = "Bob";
            $id = 1;
            $employee2 = "Sally";
            $id = 2;
            $test_stylist = new Stylist($employee, $id);
            $test_stylist->save();
            $test_stylist2 = new Stylist($employee2, $id);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([], $result);
        }

        function test_findStylist()
        {
            //Arrange
            $employee = "Bob";
            $id = 1;
            $employee2 = "Sally";
            $id = 2;
            $test_stylist = new Stylist($employee, $id);
            $test_stylist->save();
            $test_stylist2 = new Stylist($employee2, $id);
            $test_stylist2->save();

            //Act
            $result = Stylist::findStylist($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        // function test_getClient()
        // {
        //     //Arrange
        //     $employee = "Bob";
        //     $id = 1;
        //     $test_stylist = new Stylist($employee, $id);
        //     $test_stylist->save();
        //
        //     $test_employee_id = $test_stylist->getId();
        //
        //     $name = "Dodo";
        //     $test_client = new Client($name, $id, $stylist_id);
        //     $test_client->save();
        //
        //     $name2 = "Dummy";
        //     $test_client2 = new Client($name2, $id, $stylist_id);
        //     $test_client2->save();
        //
        //     //Act
        //     $result = $test_stylist->getClients();
        //
        //     //Assert
        //     $this->assertEquals([$test_client, $test_client2], $result);
        //
        //
        // }
        //
        // function test_updateStylist()
        // {
        //     //Arrange
        //     $employee = "Bob";
        //     $id = 1;
        //     $test_stylist = new Stylist($employee, $id);
        //     $test_stylist->save();
        //
        //     $new_name = "Billy";
        //
        //     //Act
        //     $test_stylist->update($new_name);
        //
        //     //Assert
        //     $this->assertEquals($test_stylist, $result);
        //
        // }
    }//closes the StylistTest

?>
