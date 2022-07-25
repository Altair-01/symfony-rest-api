<?php

require_once('Controller/ArticleController.php');
require_once('Controller/HomeController.php');
require_once('Controller/CategorieController.php');

if (isset($_GET['id'])) {
    article($_GET['id']);
} elseif (isset($_GET['cat'])) {
    categorie($_GET['cat']);
} else {
    home();
}
