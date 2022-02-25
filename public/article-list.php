<?php
require_once('../inc/NewsArticles.class.php');

// create object to call getList() function
$newsArticle = new NewsArticles();

// get all articles and store in an array to display on the view
$dataList = $newsArticle->getList();

// include the view
require_once('../tpl/article-list.tpl.php');
?>
