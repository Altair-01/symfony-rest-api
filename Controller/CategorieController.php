<?php
    require_once('Model/Article.php');
    function categorie(int $id) {
        $cat=$_GET["cat"];
        $categories=getCategories();
        $categorie = getCategorie($id);
        $articles = getArticles($cat);
        require('View/home.php');
    }
?>