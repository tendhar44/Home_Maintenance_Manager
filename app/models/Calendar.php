<?php

/**
 * Represents a calendar.
 */
class Calendar {

    protected $toDay = 0;
    protected $currDay = 0;
    protected $todayMonth = 0;
    protected $todayYear = 0;
    protected $todayDate = null;
    protected $numOfDayInMonth = 0;
    protected $weekString = array("M", "Tu", "W", "Th", "F", "Sa", "Su");

    private $conn;
    private $valid;

    /**
     * Creates calendar with database connection and validation object.
     * @param $db_con
     * @param $valid
     */
    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
    }

    /**
     * Displays the calendar with given month, year, and day.
     * @param $theMonth
     * @param $theYear
     * @param $theDay
     * @return string
     */
    public function displayCalendar($theMonth, $theYear, $theDay) {


        $year = $theYear;
        $month = $theMonth;
        $day = $theDay;

        $this->todayYear = $year;
        $this->todayMonth = $month;
        $this->currDay = $day;
        $this->numOfDayInMonth = $this->numOfDayInMonth($month, $year);

        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->createNavigation() .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->createWeekString() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';

        $weeksInMonth = $this->numOfWeekInMonth($month, $year);
        // Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {

            //Create days in a week
            for ($j = 1; $j <= 7; $j++) {
                $content .= $this->displayDay($i * 7 + $j, $theDay, $theMonth, $theYear);
            }
        }

        $content .= '</ul>';

        $content .= '<div class="clear"></div>';

        $content .= '</div>';

        $content .= '</div>';
        $content .= '<br><br><br>';
        return $content;
    }

    /**
     * Retrieves task from database, that is due on date that is passed in.
     * @param $dueDate
     * @return mixed
     */
    public function getTask($dueDate) {
        //attempt select query execution
        $sql_data = "SELECT * FROM tasks WHERE dueDate = '$dueDate'";
        $userData = $this->conn->query($sql_data);

        return $userData->fetch_assoc();
    }

    /**
     * Returns number of days in a month, with given parameter.
     * @param null $month
     * @param null $year
     * @return false|string
     */
    private function numOfDayInMonth($month = null, $year = null) {
        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // format t = number of days in given month
        return date('t', strtotime($year . '-' . $month . '-01'));
    }

    /**
     * Returns HTML code that displays calendar's navigation.
     * @return string
     */
    private function createNavigation() {
        $nextMonth = $this->todayMonth == 12 ? 1 : intval($this->todayMonth) + 1;
        $nextYear = $this->todayMonth == 12 ? intval($this->todayYear) + 1 : $this->todayYear;
        $preMonth = $this->todayMonth == 1 ? 12 : intval($this->todayMonth) - 1;
        $preYear = $this->todayMonth == 1 ? intval($this->todayYear) - 1 : $this->todayYear;

        return
            '<div class="header">' .
            '<a class="prev" href="/home_maintenance_manager/public/calendarcontroller/0' . $preMonth . '/' . $preYear . '"><</a>' .
            '<span class="title">' . date('Y M', strtotime($this->todayYear . '-' . $this->todayMonth . '-1')) . '</span>' .
            '<a class="next" href="/home_maintenance_manager/public/calendarcontroller/0' . $nextMonth . '/' . $nextYear . '">></a>' .
            '</div>';
    }

    /**
     * Returns all 7 weekdays and weekends label.
     * @return string
     */
    private function createWeekString() {
        $calendarGui = '';

        foreach ($this->weekString as $index => $wString) {
            $calendarGui .= '<li class="' . ($wString == 6 ? 'end title' : 'start title') . ' title">' . $wString . '</li>';
        }

        return $calendarGui;
    }

    /**
     * Returns number of weeks in a month, with given parameters.
     * @param null $month
     * @param null $year
     * @return int
     */
    private function numOfWeekInMonth($month = null, $year = null) {
        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->numOfDayInMonth($month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {
            $numOfweeks++;
        }

        return $numOfweeks;
    }

    /**
     * Displays each days in a container for the month.
     * @param $dayBox
     * @param $currDay
     * @param $currMonth
     * @param $currYear
     * @return string
     */
    private function displayDay($dayBox, $currDay, $currMonth, $currYear) {
        $taskNameArray = array();
        $taskIdArray = array();
        $taskLogDeleteArray = array();
        $taskUserIdArray = array();

        $this->toDay = str_pad($this->toDay, 2, 0, STR_PAD_LEFT);

        if ($this->toDay == 0) {
            $firstDayOfTheWeek = date('N', strtotime($this->todayYear . '-' . $this->todayMonth . '-01'));

            if (intval($dayBox) == intval($firstDayOfTheWeek)) {
                $this->toDay = "01";
            }
        }

        if (($this->toDay != 0) && ($this->toDay <= $this->numOfDayInMonth)) {
            $this->todayDate = date('Y-m-d', strtotime($this->todayYear . '-' . $this->todayMonth . '-' . ($this->toDay)));
            $boxContent = $this->toDay;
            $this->toDay;
            $this->toDay++;

        } else {
            $this->todayDate = null;
            $boxContent = null;
        }

        date_default_timezone_set("US/Central");
        $thisMonth = date("m");
        $thisYear = date("Y");

        $dueDate = $currYear . $currMonth . $boxContent;

        //attempt select query execution
        $sql_data = "SELECT * FROM tasks WHERE dueDate = '$dueDate'";
        $userData = $this->conn->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $row['taskName'] = substr($row['taskName'], 0, 12);
            $taskNameArray[] = $row['taskName'];
            $taskIdArray[] = $row['taskId'];
            $taskLogDeleteArray[] = $row['logDelete'];
            $taskUserIdArray[] = $row['userId'];
        }

        for ($i = 0; $i < sizeof($taskNameArray); $i++) {
            $taskNameArray[$i];
            $taskIdArray[$i];
            $taskLogDeleteArray[$i];
            $taskUserIdArray[$i];
        }

        if ($boxContent == $currDay && $currMonth == $thisMonth && $currYear == $thisYear) {
            if ($taskNameArray != null) {
                return '<li id="li-' . $this->todayDate . '" class="' . ($dayBox % 7 == 1 ? ' start ' : ($dayBox % 7 == 0 ? ' end ' : ' ')) .
                    ($boxContent == null ? 'mask' : '') . '">' . '<span style="font-weight: 900;">' . $boxContent . '</span>'
                    . (isset($taskNameArray[0]) && $taskLogDeleteArray[0] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[0] . '" style="background-color:yellow;">' . $taskNameArray[0] . '..</a>' : '</li>')
                    . (isset($taskNameArray[1]) && $taskLogDeleteArray[1] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[1] . '" style="background-color:yellow;">' . $taskNameArray[1] . '..</a>' : '</li>')
                    . (isset($taskNameArray[2]) && $taskLogDeleteArray[2] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[2] . '" style="background-color:yellow;">' . $taskNameArray[2] . '..</a>' : '</li>');
            } else {
                return '<li id="li-' . $this->todayDate . '" class="' . ($dayBox % 7 == 1 ? ' start ' : ($dayBox % 7 == 0 ? ' end ' : ' ')) .
                    ($boxContent == null ? 'mask' : '') . '">' . '<span style="font-weight: 900;">' . $boxContent . '</span></li>';
            }
        } else {
            if ($taskNameArray != null) {
                return '<li id="li-' . $this->todayDate . '" class="' . ($dayBox % 7 == 1 ? ' start ' : ($dayBox % 7 == 0 ? ' end ' : ' ')) .
                    ($boxContent == null ? 'mask' : '') . '">' . $boxContent . '</span>'
                    . (isset($taskNameArray[0]) && $taskLogDeleteArray[0] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[0] . '" style="background-color:yellow;">' . $taskNameArray[0] . '..</a>' : '</li>')
                    . (isset($taskNameArray[1]) && $taskLogDeleteArray[1] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[1] . '" style="background-color:yellow;">' . $taskNameArray[1] . '..</a>' : '</li>')
                    . (isset($taskNameArray[2]) && $taskLogDeleteArray[2] == 0 && $taskUserIdArray[0] == 1 ? '<br><a href="/home_maintenance_manager/public/taskcontroller/task/' . $taskIdArray[2] . '" style="background-color:yellow;">' . $taskNameArray[2] . '..</a>' : '</li>');
            } else {
                return '<li id="li-' . $this->todayDate . '" class="' . ($dayBox % 7 == 1 ? ' start ' : ($dayBox % 7 == 0 ? ' end ' : ' ')) .
                    ($boxContent == null ? 'mask' : '') . '">' . $boxContent . '</span></li>';
            }
        }

    }
}