<?php


class Article3 extends Article
{
    private $desc1;
    private $desc2;
    private $desc3;

    public function getDesc1() {}
    public function setDesc1($desc1) {}

    public function getDesc2() {}
    public function setDesc2($desc1) {}

    public function getDesc3() {}
    public function setDesc3($desc1) {}

    public function render() {
        echo "<article class='display:flex'>
                <div>".$this->getDesc1()."</div>
                <div>".$this->getDesc2()."</div>
                <div>".$this->getDesc3()."</div>
            </article>";
    }
}