<?php
// articleController.php

require_once('Model/Article.php');
function article(int $id) {
    $categories=getCategories();    
    $article = getArticle($id);
    require('View/home.php');
}
