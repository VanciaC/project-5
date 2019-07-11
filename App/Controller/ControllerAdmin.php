<?php

namespace App\Controller;

require "vendor/autoload.php";

use App\Model\Admin;
use App\Model\News;
use App\Model\Events;
use App\View\View;

class ControllerAdmin{

    private $admin;
    private $news;
    private $events;

    public function __construct(){
        $this->admin = new Admin();
        $this->news = new News();
        $this->events = new Events();
    }

    public function getPosts($currentPage){
        $posts = $this->news->getPosts($currentPage);
        $totalPages = $this->news->totalPages();
        $view = new View("MemberPage");
        $view->generate(array("posts" => $posts, 'totalPages' => $totalPages));
    }

    public function post($title, $details, $content, $author){
        $this->admin->addPost($title, $details, $content, $author);
    }

    public function updatePage($idPost){
        $post = $this->news->getPost($idPost);
		$view = new View("Update");
		$view->generate(array('post' => $post));
    }

    public function updatePost($idPost, $title, $details, $content, $author){
        $this->admin->updatePost($idPost, $title, $details, $content, $author);
        $this->updatePage($idPost);
    }

    public function deletePost($idPost){
        $this->admin->deletePost($idPost);
        $this->admin->deleteReports($idPost);
    }

    public function deleteComment($idComment){
		$this->admin->deleteComment($idComment);
    }
    
    public function deleteReport($idComment){
		$this->admin->deleteReport($idComment);
    }
    
    public function addEvent($name_event, $description, $date_format, $animator){
        $this->admin->addEvent($name_event, $description, $date_format, $animator);
    }

    public function updateEventPage($idEvent){
        $event = $this->events->getEvent($idEvent);
		$view = new View("UpdateEvent");
		$view->generate(array('event' => $event));
    }

    public function updateEvent($idEvent, $name_event, $description, $date_format, $animator){
        $this->admin->updateEvent($idEvent, $name_event, $description, $date_format, $animator);
        $this->updateEventPage($idEvent);
    }

    public function deleteEvent($idEvent){
        $this->admin->deleteEvent($idEvent);
    }

}