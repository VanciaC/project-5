<?php

namespace App\Model;

require "vendor/autoload.php";

use App\Model\Model;

class Events extends Model{
    public function getEvents(){
        $sql = "SELECT * FROM events ORDER BY date_event DESC";
        $events = $this->execReq($sql);
        return $events;
    }

    public function getEvent($idEvent){
        $sql= "SELECT * FROM events WHERE id = ?";
        $event = $this->execReq($sql, array($idEvent));
		if($event->rowCount() == 1){
			return $event->fetch();
		}
		else{
			throw new \Exception("Aucun évènement ne correspond à l'identifiant '$idPost'");
		}
    }

}