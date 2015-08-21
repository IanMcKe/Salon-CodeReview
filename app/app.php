<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app){
        $stylist = new Stylist($_POST['name'], $_POST['phone'], $_POST['email']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients(), 'unassigned' => $stylist->getUnassigned()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        $stylist->update($_POST['name'], $_POST['phone'], $_POST['email']);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients(), 'unassigned' => $stylist->getUnassigned()));
    });

    $app->delete("/stylists/{id}", function($id) use($app){
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/clients", function() use ($app){
        $client = new Client($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['stylist_id']);
        $client->save();
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });

    // $app->get("/clients/{id}", function($id) use ($app){
    //     $client = Client::find($id);
    //     return $app['twig']->render('client.html.twig', array('client' => $client));
    // });

    $app->get("/clients/{id}/edit", function($id) use ($app){
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('client_edit.html.twig', array('client' => $client, 'stylist' => $stylist));
    });

    $app->patch("/clients/{id}", function($id) use ($app){
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        $client->update($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['stylist_id']);
        return $app['twig']->render('stylist.html.twig', array('clients' => Client::getAll(), 'stylist' => $stylist));
    });


    //Started to try and make a prototype "Assign to me" feature.  Got lazy and stopped
    //In the future it would be better to make a line in the sql database that is Unassigned instead of trying to map all of the id's to zero.  

    // $app->get("/stylist/{id}/assign", function($id) use ($app){
    //     $stylist = Stylist::find($id);
    //     $unassigned_array = $stylist->getUnassigned();
    //     $unassigned_client = $unassigned_array[0]
    //     return $app['twig']->render('stylist_assign.html.twig', array('client' => $unassigned_client, 'stylist' => $stylist));
    // });
    //
    // $app->patch("/stylist/{id}", function($id) use ($app){
    //     $stylist = Stylist::find($id);
    //     $unassigned_array = $stylist->getUnassigned();
    //     $unassigned_array[0]->updateStylistId($stylist->getId());
    //     return $app['twig']->render('stylist.html.twig', array('clients' => Client::getAll(), 'stylist' => $stylist));
    // });

    $app->delete("/clients/{id}", function($id) use ($app){
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        $client->delete();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'stylists' => Stylist::getAll(), 'client' => $client, 'clients' => $stylist->getClients()));
    });

    return $app;
?>
