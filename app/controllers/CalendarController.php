<?php

/**
 * Class CalendarController
 */
class CalendarController extends Controller {
    /**
     * Parameters are month and year that is on the file path.
     * Example: www.example.com/calendarcontroller/04/2018
     * Calls view method from Controller class, that displays calendar page.
     * @param null $monthNum
     * @param null $yearNum
     */
    public function index($monthNum = null, $yearNum = null) {
        if (!isset($monthNum)) {
            $monthNum = date("m");
        }
        if (!isset($yearNum)) {
            $yearNum = date("Y");
        }

        date_default_timezone_set("US/Central");
        $dayNum = date("d");

        $cal = $this->model->getCalendar();
        $this->notSignedIn();

        $_SESSION['outputCotent'] = $cal->displayCalendar($monthNum, $yearNum, $dayNum);
        $this->view("calendar-page", ["mNum" => $monthNum, "yNum" => $yearNum]);
    }
}