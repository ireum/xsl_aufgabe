<?php


namespace library;


class AddBookFormValidation
{
    /**
     * @var AbstractRequest
     */
    private $request;

    /** @var bool */
    private $isValid = true;

    public function __construct(AbstractRequest $request)
    {
        $this->request = $request;
    }

    private function validateDate(string $date)
    {
        $vDate = \DateTime::createFromFormat('Y-m-d', $date);
        if (!($vDate && $vDate->format('Y-m-d') == $date)) {
            $this->isValid = false;
            throw new \InvalidArgumentException(sprintf('Invalid date: %s', $date));
        }
    }

    private function validatePrice()
    {
        if (!is_numeric($this->request->get('price')) ||
            $this->request->get('price') <= 0) {
            $this->isValid = false;
            throw new \InvalidArgumentException(sprintf('Invalid number: %01.2f', $this->request->get('price')));
        }
    }

    public function isValid() : bool
    {
        $this->validateDate($this->request->get('releaseDate'));
        $this->validatePrice();
        return $this->isValid;
    }

}
