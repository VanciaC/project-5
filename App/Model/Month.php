<?php

namespace App\Model;

require "vendor/autoload.php";

use App\Model\Model;

class Month extends Model{
    public $days = ['L', 'M', 'M', 'J', 'V', 'S', 'D'];

    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    //Récupère le premier jour du mois
    public function getFirstDay($month, $year){
        return $startMonth = new \DateTime("{$year}-{$month}-01");
    }
    
    //Récupère le premier lundi du mois
    public function getFirstMonday($month, $year){
        $monday = ($this->getFirstDay($month, $year)->modify('monday'))->format('d');
        if ($monday === '01'){
            return $this->getFirstDay($month, $year)->modify('monday');
        }
        else{
            return $this->getFirstDay($month, $year)->modify('last monday');
        }
    }

    //Récupère le mois correspondant
    public function getMonth($month, $year){
        return $this->months[$month - 1] . ' ' . $year;
    }

    //Recupère le nombre de semaine
    public function getWeeks($month, $year){
        $start = $this->getFirstDay($month, $year);
        $end = (clone $start)->modify('+1 month -1 day');
        $startWeek = intval($start->format('W'));
        $endWeek = intval($end->format('W'));
        if ($endWeek === 1){
            $endWeek = intval((clone $end)->modify('- 7 days')->format('W')) + 1;
        }
        if ($startWeek === 53){
            $startWeek = intval(($start)->modify('+ 7 days')->format('W')) - 1;
        }

        $weeks = $endWeek - $startWeek + 1;
        if($weeks < 0){
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }

    public function nextMonth($month){
        $nextMonth = $month + 1;
        if ($nextMonth > 12) {
            $nextMonth = 1;
        }
        return $nextMonth;
    }

    public function nextYear($month, $year){
        $nextMonth = $month + 1;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $year += 1;
        }
        return $year;
    }

    public function previousMonth($month){
        $previousMonth = $month - 1;
        if ($previousMonth < 1) {
            $previousMonth = 12;
        }
        return $previousMonth;
    }

    public function previousYear($month, $year){
        $previousMonth = $month - 1;
        if ($previousMonth < 1) {
            $previousMonth = 12;
            $year -= 1;
        }
        return $year;
    }
    
    //Récupère des évènements entre deux dates (pour un mois)
    public function getEvents($month, $year){
        $start = $this->getFirstMonday($month, $year);
        $weeks = $this->getWeeks($month, $year);
        $end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');
		$sql = "SELECT * FROM events WHERE date_event BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY date_event";
		$req = $this->execReq($sql);
		$events = $req->fetchAll();
		return $events;
    }
    
    //Récupère des évènement entre deux dates par jour
    public function getEventsByDay($month, $year){
        $events = $this->getEvents($month, $year);
        $days = [];
        foreach ($events as $event){
            //Recupere la premiere partie de la date 
            $date = explode(' ', $event['date_event'])[0];
            //Si pas d'évènement, on rajoute l'évènement dans le tableau
            if(!isset($days[$date])){
                $days[$date] = [$event];
            }
            //Sinon on ajoute juste l'évènement en plus dans le tableau existant
            else{
                $days[$date][]= $event;
            }
        }
        return $days;
    }
}