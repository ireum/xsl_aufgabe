<?php


namespace library
{

    class Router
    {
        /** @var Factory */
        private $factory;

        public function __construct(Factory $factory)
        {
            $this->factory = $factory;
        }

        public function route(AbstractRequest $request)
        {
            switch($request->getUri()->getPath()){
                case '/library':
                    return $this->factory->createLibraryProcessor($request);
                case '/add':
                    return $this->factory->createAddBookProcessor($request);
                default:
                    return $this->factory->createErrorPageProcessor();
            }

        }
    }
}
