<?php

require_once('Model/Article.php');
function home() {
    if (isset($_GET['cat'])) {
        # code...
        $cat=$_GET["cat"];
        $articles = getArticles($cat);
        $categories = getCategories();
    }
    else {
        $cat="";
        $articles = getArticles($cat);
        $categories = getCategories();
        # code...
    }
    
    require('View/home.php');
    }