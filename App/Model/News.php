<?php

namespace App\Model;

require "vendor/autoload.php";

use App\Model\Model;

class News extends Model{
	
	private $postPerPage = 5;
	private $commentPerPage =  10;

	public function getPosts(){
		$sql = 'SELECT id, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%i\') as date_post, title, details, content, author FROM posts ORDER BY date_post DESC';
		$posts = $this->execReq($sql);
		return $posts;
	}

	public function getPostsLimit($currentPage){
		$startPage = ($currentPage - 1)*$this->postPerPage;
		$sql = 'SELECT id, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%i\') as date_post, title, details, content, author FROM posts ORDER BY date_post DESC LIMIT '.$startPage.','.$this->postPerPage.'';
		$posts = $this->execReq($sql);
		return $posts;
	}

	public function totalPages(){
		$sql ='SELECT id FROM posts'; 
		$req = $this->execReq($sql);
		$totalPosts = $req->rowCount();
		$totalPages = ceil($totalPosts/$this->postPerPage);
		return $totalPages;
	}

    public function getPost($idPost){
		$sql = 'SELECT id, title, details, content, author, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%i\') as date_post FROM posts WHERE id=?';
		$post = $this->execReq($sql, array($idPost));
		if($post->rowCount() == 1){
			return $post->fetch();
		}
		else{
			throw new \Exception("Aucun billet ne correspond à l'identifiant '$idPost'");
		}
	}

	public function getComments($idPost, $currentPage){
		$startPage = ($currentPage - 1)*$this->commentPerPage;
		$sql = 'SELECT id, comment, author, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%s\') AS date_comment FROM comments WHERE id_post=? ORDER BY date_comment DESC LIMIT '.$startPage.','.$this->commentPerPage.'';
		$comments = $this->execReq($sql, array($idPost));
		return $comments;
	}

	public function totalPagesComments($idPost){
		$sql ='SELECT id FROM comments WHERE id_post = ?'; 
		$req = $this->execReq($sql, array($idPost));
		$totalComments = $req->rowCount();
		$totalPagesComments = ceil($totalComments/$this->commentPerPage);
		return $totalPagesComments;
	}

	public function addComments($author, $comment, $idPost){
		$sql = 'INSERT INTO comments(date_comment, comment, author, id_post) VALUES (?, ?, ?, ?)';
		date_default_timezone_set('Europe/Paris');
		$date = date("Y-m-d H:i:s");
		$addComments = $this->execReq($sql, array($date, $comment, $author, $idPost));
	}

	public function addReport($idPost, $idComment, $author, $comment){
		$sql = 'INSERT INTO reports(id_post, id_comment, author, comment) VALUES (?, ?, ?, ?)';
		$req = $this->execReq($sql, array($idPost, $idComment, $author, $comment));
	}
}