<?php


class Menu implements Displayable
{
    private $tabs;

    public function getTabs() {

    }

    public function setTabs($tabs) {
        $this->tabs = $tabs;
    }

    public function render() {
        echo "<ul>";

        foreach ($this->tabs as $tab) {
            echo "<li>".$tab."</li>";
        }

        echo "</ul>";
    }
}