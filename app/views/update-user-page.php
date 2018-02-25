<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);
?>

<div class="container">
    <form action="" method="post">
        <table>
            <tr>
                <td>Username:&nbsp;</td>
                <td><?php echo $_SESSION['username'] ?></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>First Name:&nbsp;</td>
                <td><input type="text" name="firstname" value="<?php echo $_SESSION['firstname'] ?>"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Last Name:&nbsp;</td>
                <td><input type="text" name="lastname" value="<?php echo $_SESSION['lastname'] ?>"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Email:&nbsp;</td>
                <td><input type="text" name="email" value="<?php echo $_SESSION['email'] ?>"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Password:&nbsp;</td>
                <td><input type="text" name="password" value="<?php echo preg_replace("|.|","*",$_SESSION['password']);?>"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userid'];
    $user->updateUser($userID);
}