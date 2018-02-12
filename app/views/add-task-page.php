<?php
/**
 * Name:
 * Date:
 */

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

?>

<div class="container">
    Testing Add Task Page:

    <form action="/Home_Maintenance_Manager/public/confirmationcontroller/thankyou" method="post">
        Task Name:<br> <input type="text" name="taskName"><br><br>
        Description:<br> <input type="text" name="taskDes"><br><br>
        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br><br><br>
        * = required
    </div>
</div>