<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttribute disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_getClient()
        {
            //Arrange
            $name = "Jimmy";
            $employee = "Phil";
            $id = 1;
            $stylist_id = 1;
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
            }

        function test_getId()
        {
            //Arrange
            $employee = "Phil";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);
            $test_get_employee->save();

            $name = "Jimmy";
            $stylist_id = $test_get_employee->getId();
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();


            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_saveId()
        {
            //Arrange
            $employee = "Phil";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);
            $test_get_employee->save();

            $name = "Jimmy";
            $stylist_id = $test_get_employee->getId();
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $employee = "Phil";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);

            $name = "Jim";
            $name2 = "Bob";
            $id2 = 2;
            $stylist_id = $test_get_employee->getId();
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($name2, $id2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $employee = "Phil";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);

            $name = "Jim";
            $name2 = "Bob";
            $id2 = 2;
            $stylist_id = $test_get_employee->getId();
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($name2, $id2, $stylist_id);
            $test_client2->save();


            //Act
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function test_findClient()
        {
            //Arrange
            $name = "Jojo";
            $employee = "Phil";
            $id = 1;
            $test_get_employee = new Stylist($employee, $id);

            $name2 = "Booboo";
            $id2 = 2;
            $stylist_id = $test_get_employee->getId();
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($name2, $id2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::findClient($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);

        }

    }
?>
