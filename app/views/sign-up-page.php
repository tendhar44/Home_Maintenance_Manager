<?php


?>


<script type="text/javascript">

function validatePassword(){
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirmPassword");

    if(password.value != confirm_password.value) {
        document.getElementById('check').style.color = 'red';
        document.getElementById('check').innerHTML = 'Password does not match';
        return false;
    } else {
        document.getElementById('check').style.color = 'green';
        document.getElementById('check').innerHTML = 'match';
        return true;
    }
}

</script>


<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" id="myform" autocomplete="off">
                <h2>Sign Up to Create a <br>Property Manager Account</h2>
                <p>Already a member? <a class="hmm-links" href='/home_maintenance_manager/public/usercontroller/signin'>Sign In</a></p>
                <hr>
                <div class="form-group">
                    <input type="text" name="userName" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1" required>
                </div>
                <div class="form-group">
                    <input type="text" name="firstName" id="firstname" class="form-control input-lg" placeholder="First Name" tabindex="2" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lastName" id="lastname" class="form-control input-lg" placeholder="Last Name" tabindex="3" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" onchange="validatePassword()" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" required>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="confirmPassword" onkeyup="validatePassword()" id="confirmPassword" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <span id="check"></span>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><button value="Register" name="submit" value="submit" class="btn btn-dark btn-block btn-lg" tabindex="8">Register</button></div>
                </div>
            </form>
        </div>
    </div>
    <br><br>
</div>

<script>
$(function(){
    $("#myform").submit(function(e){
        debugger;
        if(!validatePassword()){
            e.preventDefault();
        }
    });
});
</script>


