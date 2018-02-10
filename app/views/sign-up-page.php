<?php

?>

<!--<form action="/Home_Maintenance_Manager/public/confirmationcontroller/thankyou" method="post">
    <table>
        <tr><td>First Name</td><td><input type="text" name="signupFirstName"></td></tr>
        <tr><td>Last Name</td><td><input type="text" name="signupLastName"></td></tr>
        <tr><td>Username</td><td><input type="text" name="signupUserName"></td></tr>
        <tr><td>Password</td><td><input type="text" name="signupPassWord"></td></tr>
        <tr><td>Email</td><td><input type="text" name="signupEmail"></td></tr>
        <tr><td>User Type</td>
            <td>
                <select name="signupUserType">
                    <option value="PropertyManager">Property Manager</option>
                </select>
            </td>
        </tr>
        <tr><td><input type="submit" value="Sign In"></td></tr>
    </table>
</form>-->

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Sign Up to Create a <br>Property Manager Account</h2>
                <p>Already a member? <a class="hmm-links" href='/home_maintenance_manager/public/usercontroller/signin'>Sign In</a></p>
                <hr>

                <?php
                //check for any errors
                if(isset($error)){
                    foreach($error as $error){
                        echo '<p class="bg-danger">'.$error.'</p>';
                    }
                }
                //if action is joined show success message
                if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                    echo "<h2 class='bg-success'>Successfully signed up! Check email to activate your account.</h2>";
                }
                ?>

                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['firstname'], ENT_QUOTES); } ?>" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['lastname'], ENT_QUOTES); } ?>" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2">
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>

</div>


