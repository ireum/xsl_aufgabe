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

    $response = new HtmlResponse();
    $router = new Router($factory); //TODO: Aus Factory
    $processor = $router->route($request);

    //TODO: Interface für Processor Klassen, sodass execute() zugesichert ist
    //TODO: Request an execute Methode übergeben ($request, $reqponse)
    // TODO: Kein Request Objekt via Konstruktor übergeben, sondern via public Methode
    $processor->execute($response);

    //TODO: Hier Header ausgeben (header()) falls welche gesetzt sind
    echo $response->getBody();
}

