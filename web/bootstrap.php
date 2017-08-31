<?php

namespace library\web
{
    session_start();

    use library\Configuration;
    use library\requests\GetRequest;
    use library\requests\PostRequest;
    use library\responder\HtmlResponse;
    use library\factories\Factory;
    use library\session\Session;

    include '../src/autoload.php';

    $configuration = new Configuration(__DIR__ . '/../conf.ini');
    $session = new Session($_SESSION);

    $factory = new Factory($configuration, $session);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = new PostRequest($_POST, $_SERVER);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $request = new GetRequest($_GET, $_SERVER);
    } else {
        throw new \RuntimeException('Unexpected Request Method');
    }

    $response = new HtmlResponse();
    $router = $factory->createRouter();
    $processor = $router->route($request);

    $processor->execute($response, $request);

    if ($response->hasRedirect()) {
        header('Location: ' . $response->getRedirect());
    }

    $_SESSION = $session->getSessionValues();
    echo $response->getBody();
}

