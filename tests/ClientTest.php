<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_getName()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);

            $result = $test_client->getName();

            $this->assertEquals($name2, $result);
        }

        function test_getPhone()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);

            $result = $test_client->getPhone();

            $this->assertEquals($phone2, $result);
        }

        function test_getEmail()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);

            $result = $test_client->getEmail();

            $this->assertEquals($email2, $result);
        }

        function test_getStylistId()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);

            $result = $test_client->getStylistId();

            $this->assertEquals($stylist_id, $result);
        }

        function test_getId()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $id = 1;
            $test_client = new Client($name2, $phone2, $email2, $stylist_id, $id);

            $result = $test_client->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_save()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $result = Client::getAll();

            $this->assertEquals($test_client, $result[0]);
        }

        function test_deleteAll()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name3, $phone3, $email3, $stylist_id);
            $test_client2->save();

            Client::deleteAll();
            $result = Client::getAll();

            $this->assertEquals([], $result);
        }

        function test_update()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name3, $phone3, $email3, $stylist_id);
            $test_client->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id2 = $test_stylist->getId();
            $test_client->update($name2, $phone2, $email2, $stylist_id2);

            $result = array($test_client->getName(), $test_client->getPhone(), $test_client->getEmail(), $test_client->getStylistId());

            $this->assertEquals(array("Rick Sanchez", "971-301-2344", "rickandmorty100years@rickandmortyforever.forever", $test_stylist->getId()), $result);
        }

        function test_find()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client2->save();

            $result = Client::find($test_client->getId());

            $this->assertEquals($test_client, $result);
        }

        function test_delete()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client2->save();

            $test_client->delete();
            $result = Client::getAll();

            $this->assertEquals($test_client2, $result[0]);
        }
    }
?>
