<?php
namespace library
{
    include 'autoload.php';
    echo 'HELLO WORLD';
    $path = __DIR__ . '/books.xml';
    $factory = new Factory($path);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = new PostRequest($_POST);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $request = new GetRequest($_GET);
    } else {
        throw new \RuntimeException('Unexpected Request Method');
    }


    $response = new HtmlResponse();
    //$response->setRedirect('/zu-dem-pfad');

    $response = 0;
    $router = new Router();

    $processor = $router->route($request);

    $processor->execute($response);

    $response->sendHeaders();
    echo $response->getBody();
}

