<?php

namespace library
{
//    include 'autoload.php';
//    $path = __DIR__ . '/books.xml';
//    $factory = new Factory($path);
//
//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//        $request = new PostRequest($_POST);
//    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
//        $request = new GetRequest($_GET);
//    } else {
//        throw new \RuntimeException('Unexpected Request Method');
//    }
//
//
//    // TODO: move to abp
//    if ($request->has('submit') &&
//        $request->get('author') &&
//        $request->get('title') &&
//        $request->get('genre') &&
//        $request->get('price') &&
//        $request->get('releaseDate') &&
//        $request->get('description')
//    ) {
//        try {
//
//            $formValidation = $factory->createAddBookFormValidation($request);
//            if ($formValidation->isValid()) {
//                $xmlE = $factory->createXmlEditor($request);
//                $xmlE->addBook();
//                header('Location: index.php');
//            }
//        } catch (\InvalidArgumentException $e) {
//            echo $e->getMessage();
//        }
//    }
//    $add = simplexml_load_file('add.xml');
//    echo $add->saveXML();
}

