<?php

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="/Home_Maintenance_Manager/public/css/styles.css" rel="stylesheet">

    <title>Home Maintenance Manager</title>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #343a40;">

    <div class="container" id="info">

    <a class="navbar-brand" href="/home_maintenance_manager/public/homecontroller/home">HMM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid']; ?>">View Properties</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/home_maintenance_manager/public/propertycontroller/add/<?php echo $_SESSION['userid']; ?>">+Add Property</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/home_maintenance_manager/public/taskcontroller/listAll/<?php echo $_SESSION['userid']; ?>">View All Task</a>
            </li>
        </ul>
        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/home_maintenance_manager/public/calendarcontroller">Calendar</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="">
                    <img id="wrenchPic" src="/home_maintenance_manager/public/img/wrench.png" alt="wrench icon"><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a style="font-size:14px; color:#586069;"> &nbsp; Signed in as <span style="font-weight:600;"><?php echo $_SESSION['username']; ?></span></a></li>
                    <li><hr></li>
                    <li><a href="/home_maintenance_manager/public/usercontroller/<?php echo $_SESSION['userid']; ?>">&nbsp; Your Profile</a></li>
                    <!--<li><a href="#">&nbsp; Setting</a></li>-->
                    <li><a href="/home_maintenance_manager/public/usercontroller/signout">&nbsp; Sign Out</a></li>
                </ul>
            </li>
        </ul>
    </div>

    </div>

</nav>
<br>
<br>