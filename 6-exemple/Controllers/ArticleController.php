<?php


class ArticleController
{
    public function list() {
        $articleSimple = new ArticleSimple();
        $articleSimple->setTitle("Titre1");
        $articleSimple->setDescription("Description1");
        $articleImage = new ArticleImage();
        $article3 = new Article3();

        $menu = new Menu();
        $tabs = ['page1', 'page2', 'page3'];
        $menu->setTabs($tabs);

        $page = new Page();
        $page->addElement($menu);
        $page->addElement($articleSimple);
        $page->addElement($articleImage);
        $page->addElement($article3);

        /*
         * Impossible de faire ça : DateTime n'implémente pas Displayable
         */
        // $datetime = new DateTime();
        // $page->addElement($datetime);

        include 'Views/articles/list.php';
    }

    public function insert() {

    }
}