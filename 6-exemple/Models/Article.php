<?php


abstract class Article implements Displayable
{
    private $title;

    public function __construct($title=null)
    {
        $this->title = $title;
    }

    public function getTitle() {

    }

    public function setTitle($title) {

    }
}