<?php


namespace library\routing
{

    use library\requests\AbstractRequest;
    use library\setup\Factory;

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
                    return $this->factory->createLibraryProcessor();
                case '/add':
                    return $this->factory->createDisplayBookProcessor();
                case '/validate':
                    return $this->factory->createAddBookProcessor();
                default:
                    return $this->factory->createErrorPageProcessor();
            }

        }
    }
}
