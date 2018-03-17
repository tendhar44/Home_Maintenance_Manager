<?php

?>

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Sign In</h2>
                <p>Not a member? <a class="hmm-links" href='/home_maintenance_manager/public/usercontroller/signup'>Sign Up</a></p>
                <hr>
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2" required>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Sign In" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>
    <br><br>
</div>
