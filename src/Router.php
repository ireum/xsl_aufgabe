<?php


namespace library
{

    class Router
    {
        public function __construct()
        {
        }

        public function route(AbstractRequest $request)
        {
            switch($request->getPath()){
                case '/book/add':
                    return $factory->createAddBookProcessor();
                case '/':
                    return $factory->createShowBooksProcessor();
                default:
                    return $factory->create404Processor();
            }

        }
    }
}
