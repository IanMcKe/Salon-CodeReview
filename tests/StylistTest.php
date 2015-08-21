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

    class StylistTest extends PHPUnit_Framework_TestCase
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

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);

            $result = $test_stylist->getPhone();

            $this->assertEquals($phone, $result);
        }

        function test_getEmail()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);

            $result = $test_stylist->getEmail();

            $this->assertEquals($email, $result);
        }

        function test_getId()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $id = 1;
            $test_stylist = new Stylist($name, $phone, $email, $id);

            $result = $test_stylist->getId();

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
            $test_stylist2 = new Stylist($name2, $phone2, $email2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_save()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
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
            $test_stylist2 = new Stylist($name2, $phone2, $email2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([],$result);
        }

        function test_update()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $test_stylist->update($name2, $phone2, $email2);

            $result = array($test_stylist->getName(), $test_stylist->getPhone(), $test_stylist->getEmail());

            $this->assertEquals(array("Rick Sanchez", "971-301-2344", "rickandmorty100years@rickandmortyforever.forever"), $result);
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
            $test_stylist2 = new Stylist($name2, $phone2, $email2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
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
            $test_stylist2 = new Stylist($name2, $phone2, $email2);
            $test_stylist2->save();

            $test_stylist->delete();
            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist2], $result);
        }

        function test_delete2()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $test_stylist2 = new Stylist($name2, $phone2, $email2);
            $test_stylist2->save();

            $name3 = "Rick Sanchez";
            $phone3 = "971-301-2344";
            $email3 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name3, $phone3, $email3, $stylist_id);
            $test_client->save();

            $name4 = "Morty Smith";
            $phone4 = "029-423-0918";
            $email4 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name4, $phone4, $email4, $stylist_id);
            $test_client2->save();

            $test_stylist->delete();
            $clients = Client::getAll();
            $result = array($clients[0]->getStylistId(),$clients[1]->getStylistId());

            $this->assertEquals([0,0], $result);
        }

        function test_getClients()
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

            $result = $test_stylist->getClients();

            $this->assertEquals([$test_client2, $test_client], $result);
        }

        function test_getUnassigned()
        {
            $name = "Jaina";
            $phone = "456-323-9811";
            $email = "jproudmoore@gmail.net";
            $test_stylist = new Stylist($name, $phone, $email);
            $test_stylist->save();

            $name2 = "Rick Sanchez";
            $phone2 = "971-301-2344";
            $email2 = "rickandmorty100years@rickandmortyforever.forever";
            $stylist_id = 0;
            $test_client = new Client($name2, $phone2, $email2, $stylist_id);
            $test_client->save();

            $name3 = "Morty Smith";
            $phone3 = "029-423-0918";
            $email3 = "ohjeez@rick.com";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name3, $phone3, $email3, $stylist_id);
            $test_client2->save();

            $result = $test_stylist->getUnassigned();

            $this->assertEquals([$test_client], $result);
        }
    }
?>
