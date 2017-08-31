<?php


namespace library\handler
{

    use library\requests\AbstractRequest;

    class LibraryFilter
    {
        /** @var  \DOMDocument */
        private $dom;
        /** @var BooksQuery */
        private $xmlQuery;

        public function __construct(string $path, BooksQuery $xmlQuery)
        {
            $this->setDom($path);
            $this->xmlQuery = $xmlQuery;
        }

        private function setDom(string $path)
        {
            $domDoc = new \DOMDocument();
            $domDoc->load($path);
            $this->dom = $domDoc;
        }

        private function getRootNode(): \DOMElement
        {
            return $this->dom->getElementsByTagName('catalog')->item(0);
        }

        public function processForm(AbstractRequest $request): \DOMDocument
        {
            if ($request->has('submit')) {
                $this->setSearchedValues($request);
            } else {
                $this->setDefaultValues();
            }
            return $this->dom;
        }

        private function getDataType(AbstractRequest $request): string
        {
            if ($request->get('sort') == 'price') {
                return 'number';
            } else {
                return 'text';
            }
        }

        private function setDefaultValues()
        {
            $root = $this->getRootNode();
            $root->setAttribute('sortby', 'author');
            $root->setAttribute('sortdatatype', 'text');
            $root->setAttribute('author', '');
            $root->setAttribute('title', '');
            $root->setAttribute('minprice', $this->xmlQuery->getMinPrice());
            $root->setAttribute('maxprice', $this->xmlQuery->getMaxPrice());
        }


        private function setSearchedValues(AbstractRequest $request)
        {
            $root = $this->getRootNode();
            $root->setAttribute('sortby', $request->get('sort'));
            $root->setAttribute('sortdatatype', $this->getDataType($request));
            $root->setAttribute('author', $request->get('author'));
            $root->setAttribute('title', $request->get('title'));
            $root->setAttribute('minprice', $request->get('minPrice'));
            $root->setAttribute('maxprice', $request->get('maxPrice'));
        }

    }
}
