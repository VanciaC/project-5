<?php

namespace App\Model;

abstract class Model{

	private $db;

	protected function execReq($sql, $param = null){
		if ($param == null){
			$res = $this->getDb()->query($sql);
		}
		else{
			$res = $this->getDb()->prepare($sql);
			$res->execute($param);
		}
		return $res;
	}

	private function getDb(){
		if($this->db == null){
			$this->db = new \PDO();
		}
		return $this->db;
	}
}