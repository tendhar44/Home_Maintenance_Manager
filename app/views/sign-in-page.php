<?php
if(isset($_POST['submit1'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($this->model->getAccountManagement()->signInUser($username, $password)) {
        header('Location: /home_maintenance_manager/public/homecontroller/home');
    }else {
        echo '<span class="errorText">' . $_SESSION['signInError'] . "</span>";
    }
} elseif(isset($_POST['submit2'])) {
    $username = $_POST["usernamemanager"];
    $password = $_POST["passwordmanager"];
    if($this->model->getAccountManagement()->signInManager($username, $password)) {
        header('Location: /home_maintenance_manager/public/homecontroller/managerhome');
    }else {
        echo '<span class="errorText">' . $_SESSION['signInError'] . "</span>";
    }
} elseif(isset($_POST['submit3'])) {
    $username = $_POST["usernamelimited"];
    $password = $_POST["passwordlimited"];
    if($this->model->getAccountManagement()->signInLimited($username, $password)) {
        header('Location: /home_maintenance_manager/public/homecontroller/limitedhome');
    }else {
        echo '<span class="errorText">' . $_SESSION['signInError'] . "</span>";
    }
}
?>

<script>
    function showDiv(userTypeId) {
        if(userTypeId == "1") {
            div1.style.display='inline-block';
            div2.style.display='none';
            div3.style.display='none';
        }
        if (userTypeId == "2") {
            div2.style.display='inline-block';
            div1.style.display='none';
            div3.style.display='none';
        }
        if(userTypeId == "3") {
            div3.style.display='inline-block';
            div2.style.display='none';
            div1.style.display='none';
        }
        else {

        }
    }
</script>

<div class="container">
    <label>Pick Type of User</label>
    <select name="typeofuser" onchange="showDiv(this.options[this.selectedIndex].value)">
        <option value="">Select one</option>
        <option value="1">Property Owner</option>
        <option value="2">Manager</option>
        <option value="3">Limited User</option>
    </select>

    <br><br>

<div class="container" id="div1" style="display:none;">
    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Sign in as Property Owner</h2>
                <p>Not a member? <a class="hmm-links" href="/home_maintenance_manager/public/usercontroller/ signup">Sign Up</a></p>
                <hr>
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2" required>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit1" value="Sign In" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>
    <br><br>
</div>

    <div class="container" id="div2" style="display:none;">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="post" action="" autocomplete="off">
                    <h2>Sign in as Manager</h2>
                    <p>Not a member? <a class="hmm-links" href="/home_maintenance_manager/public/usercontroller/signup">Sign Up</a></p>
                    <hr>
                    <div class="form-group">
                        <input type="text" name="usernamemanager" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordmanager" id="password" class="form-control input-lg" placeholder="Password" tabindex="2" required>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-6"><input type="submit" name="submit2" value="Sign In" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
    </div>

    <div class="container" id="div3" style="display:none;">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="post" action="" autocomplete="off">
                    <h2>Sign in as Limited User</h2>
                    <p>Not a member? <a class="hmm-links" href="/home_maintenance_manager/public/usercontroller/signup">Sign Up</a></p>
                    <hr>
                    <div class="form-group">
                        <input type="text" name="usernamelimited" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordlimited" id="password" class="form-control input-lg" placeholder="Password" tabindex="2" required>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-6"><input type="submit" name="submit3" value="Sign In" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
    </div>

</div>