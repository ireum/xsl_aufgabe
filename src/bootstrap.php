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
    $router = new Router($factory);
    $processor = $router->route($request);

    $processor->execute($response);
    echo $response->getBody();
}

