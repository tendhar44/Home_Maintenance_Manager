<?php

/**
 * Name:
 * Date:
 */
class CalendarController extends Controller {
    public function index($monthNum = 3, $yearNum = 2018) {
        $user =  $this->model->getCalendar();
        $this->notSignedIn();

        $_SESSION['outputCotent'] = $user->displayCalendar($monthNum, $yearNum);
        $this->view("calendar-page", ["mNum" => $monthNum, "yNum" => $yearNum]);
    }
}