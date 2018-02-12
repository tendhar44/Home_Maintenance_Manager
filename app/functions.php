<?php

    function ifNotLoggedIn($linkPath, $userSignedIn) {

        //if not logged in redirect to login page
        if (!$userSignedIn) {
            header('Location: ' . $linkPath);
            exit();
        }
    }


    function ifLoggedIn($linkPath, $userSignedIn) {
    //if logged in, redirect to home
        if ($userSignedIn) {
            header('Location: ' . $linkPath);
            exit();
        }
    }
