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

        function test_getAll()
        {
            //Arrange
            $name = "Jim";
            $id = 1;
            $name2 = "Bob";
            $id2 = 2;
            $test_client = new Client($name, $id);
            $test_client->save();
            $test_client2 = new Client($name2, $id2);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bob";
            $id = 1;
            $name2 = "Sally";
            $id = 2;
            $test_client = new Client($name, $id);
            $test_client->save();
            $test_client2 = new Client($name2, $id);
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
            $id = 1;
            $name2 = "Booboo";
            $id = 2;
            $test_client = new Client($name, $id);
            $test_client->save();
            $test_client2 = new Client($name2, $id);
            $test_client2->save();

            //Act
            $result = Client::findClient($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);

        }

    }
?>
