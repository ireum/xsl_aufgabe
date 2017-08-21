<?php


namespace library
{

    class SearchFormProcessor
    {
        /**
         * @var AbstractRequest
         */
        private $request;

        public function __construct(AbstractRequest $request)
        {
            $this->request = $request;
        }

        public function getDataType(): string
        {
            if ($this->request->get('sort') == 'price') {
                return 'number';
            } else {
               return 'text';
            }
        }
    }
}
