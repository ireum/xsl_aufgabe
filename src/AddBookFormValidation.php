<?php


namespace library {



//class AddBookFormValidation
//{
//
//    /** @var bool */
//    private $isValid = true;
//
//    public function __construct()
//    {
//    }
//
//    private function validateStringFields(string $key, AbstractRequest $request)
//    {
//        if (!$request->has($key) || $request->get($key) === '') {
//            $this->isValid = false;
//            throw new \InvalidArgumentException(sprintf('Invalid Input: %s', $key));
//        }
//    }
//
//    private function validateDate(string $date)
//    {
//        $vDate = \DateTime::createFromFormat('Y-m-d', $date);
//        if (!($vDate && $vDate->format('Y-m-d') === $date)) {
//            $this->isValid = false;
//            throw new \InvalidArgumentException(sprintf('Invalid date: %s', $date));
//        }
//    }
//
//    private function validatePrice(AbstractRequest $request)
//    {
//        if (!is_numeric($request->get('price')) ||
//            $request->get('price') <= 0) {
//            $this->isValid = false;
//            throw new \InvalidArgumentException(sprintf('Invalid number: %01.2f', $request->get('price')));
//        }
//    }
//
//    public function isValid(AbstractRequest $request): bool
//    {
//        $this->validateStringFields('author', $request);
//        $this->validateStringFields('title', $request);
//        $this->validateStringFields('genre', $request);
//        $this->validatePrice($request);
//        $this->validateDate($request->get('releaseDate'));
//        $this->validateStringFields('description', $request);
//        return $this->isValid;
//    }}

}
