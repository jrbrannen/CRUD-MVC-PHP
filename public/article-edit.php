<?php

require_once('../inc/NewsArticles.class.php');

// create object
$newsArticle = new NewsArticles();

$dataArray = array();
$errorsArray = array();

$requestArray = $newsArticle->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST

// checks to see if there is a record to load
if (isset($requestArray['article_id']) && !empty($requestArray['article_id'])){
    $newsArticle->load($requestArray['article_id']);
    $dataArray = $newsArticle->dataArray;
}

// checks to see if the save button was pushed
if (isset($requestArray["Save"])){
    
    // sanitize the data
    $requestArray = $newsArticle->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
    
    // pass new data to the instance
    // set data array to the object array property
    $newsArticle->set($requestArray);

    // validate the data
    if ($newsArticle->validate()){
        //save
        if ($newsArticle->save()){
            header("location: ../tpl/article-save-success.tpl.php"); // prevents double posting
            exit;   // ends server processing
        }else{
            
        }
    }else{
        //errors
        $errorsArray = $newsArticle->errors;
        $dataArray = $newsArticle->dataArray;
    }
}
// go back to article list view page
if (isset($_POST['Cancel'])) {
	header("location: article-list.php");
	exit;
}
// include the view
require_once('../tpl/article-edit.tpl.php');
?>
