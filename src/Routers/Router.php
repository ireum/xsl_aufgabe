<?php


namespace library\routers
{

    use library\processor\Processor;
    use library\requests\AbstractRequest;
    use library\factories\Factory;

    class Router
    {
        /** @var Factory */
        private $factory;

        public function __construct(Factory $factory)
        {
            $this->factory = $factory;
        }

        public function route(AbstractRequest $request): Processor
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
