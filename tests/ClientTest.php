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
            $id = 1;
            $test_client = new Client($name, $id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
            }

        function test_getId()
        {
            //Arrange
            $name = "Jimmy";
            $id = 1;
            $test_client = new Client($name, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_saveId()
        {
            //Arrange
            $name = "Tommy";
            $id = 1;
            $test_client = new Client($name, $id);
            $test_client->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }
    }
?>
