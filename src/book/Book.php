<?php


namespace library\book
{

    use library\requests\AbstractRequest;

    class Book
    {
        /** @var string */
        private $author;
        /** @var string */
        private $title;
        /** @var string */
        private $genre;
        /** @var float */
        private $price;
        /** @var \DateTime */
        private $releaseDate;
        /** @var string */
        private $description;
        /** @var array */
        private $errorFields;

        public function __construct(AbstractRequest $request)
        {
            $this->isValid($request);

            $this->author = $request->get('author');
            $this->title = $request->get('title');
            $this->genre = $request->get('genre');
            $this->price = $request->get('price');
            $this->releaseDate = $this->setReleaseDate($request->get('releaseDate'));
            $this->description = $request->get('description');
        }

        private function setReleaseDate(string $releaseDate)
        {
            return \DateTime::createFromFormat('Y-m-d', $releaseDate);
        }

        private function isValid(AbstractRequest $request)
        {
            $this->validateStringFields('author', $request);
            $this->validateStringFields('title', $request);
            $this->validateStringFields('genre', $request);
            $this->validatePrice($request);
            $this->validateDate($request->get('releaseDate'));
            $this->validateStringFields('description', $request);
        }

        private function validateStringFields(string $key, AbstractRequest $request)
        {
            if (!$request->has($key) || $request->get($key) === '') {
                $this->isValid = false;

                if (!$request->has($key)) {
                    $this->errorFields[$key] = " ";
                } else {
                    $this->errorFields[$key] = $request->get($key);
                }
            }
        }


        private
        function validateDate(string $date)
        {
            $vDate = \DateTime::createFromFormat('Y-m-d', $date);
            if (!($vDate && $vDate->format('Y-m-d') === $date)) {
                $this->isValid = false;


                $this->errorFields['releaseDate'] = $date;
//                throw new \InvalidArgumentException('releaseDate');
//                throw new \InvalidArgumentException(sprintf('Invalid date: %s', $date));
            }
        }

        private
        function validatePrice(AbstractRequest $request)
        {
            if (!is_numeric($request->get('price')) ||
                $request->get('price') <= 0) {
                $this->isValid = false;

                $this->errorFields['price'] = $request->get('price');

//                throw new \InvalidArgumentException('price');
//                throw new \InvalidArgumentException(sprintf('Invalid number: %01.2f', $request->get('price')), 4);
            }
        }

        public
        function getAuthor(): string
        {
            return $this->author;
        }

        public
        function getTitle(): string
        {
            return $this->title;
        }

        public
        function getGenre(): string
        {
            return $this->genre;
        }

        public
        function getPrice(): float
        {
            return $this->price;
        }

        public
        function getReleaseDate(): \DateTime
        {
            return $this->releaseDate;
        }

        public
        function getDescription(): string
        {
            return $this->description;
        }

        public
        function hasErrorFields(): bool
        {
            if (!is_null($this->errorFields)) {
                return true;
            } else {
                return false;
            }
        }

        public
        function getErrorFields(): array
        {
            return $this->errorFields;
        }
    }
}
