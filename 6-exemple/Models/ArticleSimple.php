<?php


class ArticleSimple extends Article
{
    private $description;

    public function __construct($title = null, $description = null)
    {
        parent::__construct($title);
        $this->description = $description;
    }

    public function getDescription() {}
    public function setDescription($description) {}

    public function render() {
        echo "<article>
                <p>".$this->getTitle()."</p>
                <p>".$this->getDescription()."</p>
            </article>";
    }
}