<?php


namespace library
{

    class FormBuilder
    {
        public function __construct()
        {
        }

        public function buildValueSelectFromArray(array $arr, string $name)
        {
            $returnString = '<select name="' . $name . '">';
            $returnString .= '<option value="">All</option>';
            foreach ($arr as $item) {
                $returnString .= '<option value="' . $item . '">' . $item . '<br></option>';
            }
            return $returnString .= '</select>';
        }

        public function buildNameSelectFromArray(array $arr, string $name)
        {
            $returnString = '<select name="' . $name . '">';
            foreach ($arr as $item) {
                $returnString .= '<option value="' . $item->getName() . '">' . $item->getName() . '<br></option>';
            }
            return $returnString .= '</select>';
        }
    }
}
