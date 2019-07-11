<?php

namespace App\Controller;

require "vendor/autoload.php";

use App\Model\News;
use App\View\View;

class ControllerHome{
    private $news;

    public function __construct(){
        $this->news = new News;
    }

    public function home(){
        $posts = $this->news->getPosts();
        $view = new View("Home");
        $view->generate(array("posts" => $posts));
    }
}