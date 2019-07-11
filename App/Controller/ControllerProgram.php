<?php

namespace App\Controller;

require "vendor/autoload.php";

use App\Model\Events;
use App\Model\Month;
use App\View\View;

class ControllerProgram{
    private $events;
    private $month;

    public function __construct(){
        $this->events = new Events;
        $this->month = new Month;
    }

    public function program($month, $year){
        $months = $this->month->getMonth($month, $year);
        $weeks = $this->month->getWeeks($month, $year);
        $firstMonday = $this->month->getFirstMonday($month, $year);
        $firstDay = $this->month->getFirstDay($month, $year);
        $days = $this->month->days;
        $nextMonth = $this->month->nextMonth($month);
        $nextYear = $this->month->nextYear($month, $year);
        $previousMonth = $this->month->previousMonth($month);
        $previousYear = $this->month->previousYear($month, $year);
        $events = $this->month->getEventsByDay($month, $year);
        $eventsModal = $this->month->getEventsByDay($month, $year);
        $view = new View("Program");
        $view->generate(array("months" => $months, "weeks" => $weeks, "firstMonday" => $firstMonday, "firstDay" => $firstDay, "days" => $days,
        "nextMonth" => $nextMonth, "nextYear" => $nextYear, "previousMonth" => $previousMonth, "previousYear" => $previousYear, "events" => $events, "eventsModal" => $eventsModal));
    }

    public function eventPage($idEvent){
        $event = $this->events->getEvent($idEvent);
        $view = new View("EventPage");
        $view->generate(array("event" => $event));
    }
}