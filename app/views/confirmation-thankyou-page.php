<?php
/**
 * Name:
 * Date:
 */

require_once("../app/models/Validation.php");
require_once("../app/models/Task.php");

$task = new Task();
$task->addTask();

$valid = new Validation();

//define variable and set to empty
$tname = "";
$tdes = "";

//validates the inputs
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $tname = $valid->checkInput($_POST["taskName"]);
    $tdes = $valid->checkInput($_POST["taskDes"]);
}
?>

<div>
    <p>Thank you for contacting us</p>
</div>

<?php
echo "<h4>Your Input:</h4>";
echo $tname;
$_POST["taskDes"];
echo "<br>";
echo $tdes;
echo "<br>";
?>
