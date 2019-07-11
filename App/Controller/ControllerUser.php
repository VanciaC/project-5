<?php

namespace App\Controller;

require "vendor/autoload.php";

use App\Model\User;
use App\Model\News;
use App\Model\Admin;
use App\Model\Events;
use App\View\View;

class ControllerUser{

	private $user;
	private $news;
	private $admin;
	private $events;

	public function __construct(){
		$this->user = new User();
		$this->news = new News();
		$this->admin = new Admin();
		$this->events = new Events();
    }

    public function pageMember($pseudo){
		$user = $this->user->getPseudo($pseudo);
		$postsUpdate = $this->news->getPosts();
		$postsDelete = $this->news->getPosts();
		$reports = $this->admin->getReports();
		$eventsUpdate = $this->events->getEvents();
		$eventsDelete = $this->events->getEvents();
		$view = new View("MemberPage");
		$view->generate(array('user' => $user, 'postsUpdate' => $postsUpdate, 'postsDelete' => $postsDelete, "reports" => $reports, "eventsUpdate" => $eventsUpdate, "eventsDelete" => $eventsDelete));
	}

	public function user($pseudo){
		return $this->user->getUser($pseudo);
	}
}
    
