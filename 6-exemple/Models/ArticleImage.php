<?php


class ArticleImage extends Article
{
    private $description;
    private $image;

    public function getDescription() {

    }

    public function setDescription($desc) {

    }

    public function getImage() {

    }

    public function setImage($image) {

    }

    public function render() {
        echo "<article>
                <p>".$this->getTitle()."</p>
                <p>".$this->getDescription()."</p>
                <img src='".$this->getImage()."'/>
            </article>";
    }
}