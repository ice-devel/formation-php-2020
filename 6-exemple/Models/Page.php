<?php


class Page
{
    private $elements;

    public function addElement(Displayable $el) {
        $this->elements[] = $el;
    }

    public function getElements() {
        return $this->elements;
    }
}