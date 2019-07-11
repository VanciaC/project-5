<?php

namespace App\Model;

require "vendor/autoload.php";

use App\Model\Model;

class Admin extends Model{

    public function addPost($title, $details, $content, $author){
		$sql = 'INSERT INTO posts(date_post, title, details, content, author) VALUES (?, ?,?,  ?, ?)';
		date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d H:i:s");
		$req = $this->execReq($sql, array($date, $title, $details, $content, $author));
	}

	public function updatePost($idPost, $title, $details, $content, $author){
		$sql ='UPDATE posts SET title = :title, details = :details, content = :content, author = :author WHERE id = :id';
		$req = $this->execReq($sql, array('title' => $title, 'details' => $details, 'content' => $content, 'author' => $author, 'id' => $idPost));
	}

	public function deletePost($idPost){
		$sql = 'DELETE FROM posts WHERE id = ?';
		$req = $this->execReq($sql, array($idPost));
	}

	public function deleteComment($idComment){
		$sql = 'DELETE FROM comments WHERE id = ?';
		$req = $this->execReq($sql, array($idComment));
	}

	public function deleteReport($idComment){
		$sql = 'DELETE FROM reports WHERE id_comment = ?';
		$req = $this->execReq($sql, array($idComment));
	}

	public function deleteReports($idPost){
		$sql ='DELETE FROM reports WHERE id_post = ?';
		$req = $this->execReq($sql, array($idPost));
	}

	public function getReports(){
		$sql = 'SELECT DISTINCT id_comment, author, comment FROM reports ORDER BY id';
		$req = $this->execReq($sql);
		return $req;
	}

	public function addEvent($name_event, $description, $date_format, $animator){
		$sql = 'INSERT INTO events(name_event, description, date_event, animator) VALUES (?, ?, ?, ?)';
		$req = $this->execReq($sql, array($name_event, $description, $date_format, $animator));
	}

	public function updateEvent($idEvent, $name_event, $description, $date_format, $animator){
		$sql ='UPDATE events SET name_event = :name_event, description = :description, date_event = :date_event,  animator = :animator WHERE id = :id';
		$req = $this->execReq($sql, array('name_event' => $name_event, 'description' => $description, 'date_event' => $date_format, 'animator' => $animator, 'id' => $idEvent));
	}
	
	public function deleteEvent($idEvent){
		$sql = 'DELETE FROM events WHERE id = ?';
		$req = $this->execReq($sql, array($idEvent));
	}
}