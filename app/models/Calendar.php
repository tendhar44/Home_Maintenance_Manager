<?php

/**
 * Class Calendar
 */
class Calendar {
    protected $toDay = 0;
    protected $todayMonth = 0;
    protected $todayYear = 0;
    protected $todayDate = null;
    protected $numOfDayInMonth = 0;
    protected $weekString = array("M", "Tu", "W", "Th", "F", "Sa", "Su");

    public function __construct() {

    }


    /**
     * Takes in month and year, then displays the calendar.
     *
     * @param $theMonth
     * @param $theYear
     * @return string
     */
    public function displayCalendar($theMonth, $theYear) {
        $year  = $theYear;
        $month = $theMonth;

        $this->todayYear=$year;
        $this->todayMonth=$month;
        $this->numOfDayInMonth=$this->numOfDayInMonth($month,$year);

        $content='<div id="calendar">'.
            '<div class="box">'.
            $this->createNavigation().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->createWeekString().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->numOfWeekInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                $content.=$this->displayDay($i*7+$j);
            }
        }

        $content.='</ul>';

        $content.='<div class="clear"></div>';

        $content.='</div>';

        $content.='</div>';
        $content.='<br><br><br>';
        return $content;
    }

    private function numOfDayInMonth($month = null, $year = null) {
        if(null == ($year)) {
            $year = date("Y", time());
        }

        if(null == ($month)) {
            $month = date("m", time());
        }

        return date('t',strtotime($year.'-'.$month.'-01'));
    }

    private function createNavigation() {
        $nextMonth = $this->todayMonth == 12 ? 1 : intval($this->todayMonth) + 1;
        $nextYear = $this->todayMonth == 12 ? intval($this->todayYear) + 1 : $this->todayYear;
        $preMonth = $this->todayMonth == 1 ? 12 : intval($this->todayMonth) - 1;
        $preYear = $this->todayMonth == 1 ? intval($this->todayYear) - 1 : $this->todayYear;

        return
            '<div class="header">'.
            '<a class="prev" href="/home_maintenance_manager/public/calendarcontroller/' . $preMonth . '/' . $preYear . '"><</a>'.
            '<span class="title">'.date('Y M',strtotime($this->todayYear.'-'.$this->todayMonth.'-1')).'</span>'.
            '<a class="next" href="/home_maintenance_manager/public/calendarcontroller/' . $nextMonth . '/' . $nextYear . '">></a>'.
            '</div>';
    }

    private function createWeekString() {
        $calendarGui = '';

        foreach($this->weekString as $index=>$wString){
            $calendarGui .= '<li class="'.($wString==6?'end title':'start title').' title">'.$wString.'</li>';
        }

        return $calendarGui;
    }

    private function numOfWeekInMonth($month = null, $year = null) {
        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->numOfDayInMonth($month, $year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay){
            $numOfweeks++;
        }

        return $numOfweeks;
    }

    //create box or container for each days in month
    private function displayDay($dayBox) {
        if($this->toDay == 0){
            $firstDayOfTheWeek = date('N',strtotime($this->todayYear.'-'.$this->todayMonth.'-01'));

            if(intval($dayBox) == intval($firstDayOfTheWeek)){
                $this->toDay = 1;
            }
        }

        if(($this->toDay != 0)&&($this->toDay <= $this->numOfDayInMonth)){
            $this->todayDate = date('Y-m-d',strtotime($this->todayYear.'-'.$this->todayMonth.'-'.($this->toDay)));
            $boxContent = $this->toDay;
            $this->toDay++;
        }else{
            $this->todayDate = null;
            $boxContent = null;
        }


        return '<li id="li-'. $this->todayDate .'" class="'.($dayBox % 7 == 1 ?' start ':($dayBox % 7 == 0 ?' end ':' ')).
            ($boxContent == null ? 'mask':'').'">'.$boxContent.'</li>';
    }
}