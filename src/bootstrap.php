<?php

namespace library
{

    include 'autoload.php';

    $configuration = new Configuration(__DIR__ . '/conf.ini');
    $factory = new Factory($configuration);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = new PostRequest($_POST);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $request = new GetRequest($_GET);
    } else {
        throw new \RuntimeException('Unexpected Request Method');
    }

    try {

        $response = new HtmlResponse();
        //TODO: X   Aus Factory
//    $router = new Router($factory);
        $router = $factory->createRouter();
        $processor = $router->route($request);

        //TODO: X   Interface für Processor Klassen, sodass execute() zugesichert ist
        //TODO: X   Request an execute Methode übergeben ($request, $reqponse)
        //TODO: X   Kein Request Objekt via Konstruktor übergeben, sondern via public Methode
        $processor->execute($response, $request);

        //TODO: X   Hier Header ausgeben (header()) falls welche gesetzt sind
        if ($response->hasRedirect()) {
            $response->getRedirect();
        }

        echo $response->getBody();
    } catch (\InvalidArgumentException $e) {
        echo $e->getMessage();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

}

