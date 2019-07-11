<?php

namespace App\Controller;

require "vendor/autoload.php";

use App\Model\News;
use App\View\View;

class ControllerNews{
    private $news;

    public function __construct(){
        $this->news = new News;
    }

    public function news($currentPage){
        $posts = $this->news->getPostsLimit($currentPage);
        $totalPages = $this->news->totalPages();
        $view = new View("News");
        $view->generate(array("posts" => $posts, "totalPages" => $totalPages));
    }

    public function getNews($idPost, $currentPage){
        $post = $this->news->getPost($idPost);
        $comments = $this->news->getComments($idPost, $currentPage);
        $totalPagesComments = $this->news->totalPagesComments($idPost);
        $view = new View("NewsPage");
        $view->generate(array("post" => $post, "comments" => $comments, "totalPagesComments" => $totalPagesComments));
    }

    public function comment($author, $comment, $idPost, $currentPage){
        $this->news->addComments($author, $comment, $idPost);
        $this->getNews($idPost, $currentPage);
    }

    public function report($idPost, $idComment, $author, $comment, $currentPage){
		$this->news->addReport($idPost, $idComment, $author, $comment);
		$this->getNews($idPost, $currentPage);
	}
}