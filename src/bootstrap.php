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
        $router = $factory->createRouter();
        $processor = $router->route($request);

        $processor->execute($response, $request);

        $response->getRedirect();

        echo $response->getBody();
    } catch (\InvalidArgumentException $e) {
        echo $e->getMessage();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

}

