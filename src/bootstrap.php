<?php

namespace library
{
    session_start();

    use library\requests\GetRequest;
    use library\requests\PostRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;
    use library\setup\Configuration;
    use library\setup\Factory;

    include 'autoload.php';

    $configuration = new Configuration(__DIR__ . '/conf.ini');
    $session = new Session($_SESSION);
    $_SESSION = $session->getSessionValues();

    $factory = new Factory($configuration);

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

    $processor->execute($response, $request, $session);

    if ($response->hasRedirect()) {
        header('Location: ' . $response->getRedirect());
    }

    $_SESSION = $session->getSessionValues();
    echo $response->getBody();
}

