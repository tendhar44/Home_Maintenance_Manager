<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);
?>

<div class="container" id="info">
    <h3>Property Owner Information</h3>
    <br>
    <a href="/home_maintenance_manager/public/usercontroller/update/<?php echo $data['uId']; ?>">+Update Profile</a>
    <br><br>
    <table class="table table-hover">
        <tbody>
        <tr>
            <th scope="row">User ID</th>
            <td><?php echo $_SESSION['userid']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">Username</th>
            <td><?php echo $_SESSION['username']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">First Name</th>
            <td><?php echo $_SESSION['firstname']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">Last Name</th>
            <td><?php echo $_SESSION['lastname']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?php echo $_SESSION['email']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">Password</th>
            <td><?php echo preg_replace("|.|","*",$_SESSION['password']);?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
