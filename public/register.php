<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            // if password field is not same as confirm password field
            apologize("Password field must be same as Confirm Password field.");
        }
        else
        {
            // query for inserting a new user in users table
            $row = CS50::query("INSERT IGNORE into `users`(username, hash, cash)
            VALUES(?, ?, 10000.0000)", $_POST["username"], 
            password_hash($_POST["password"], PASSWORD_DEFAULT));
            
            // sanity check
            if ($row !== 1)
            {
                // if that username already exist
                apologize("User with username {$_POST["username"]} already exists.");
            }
            else
            {
                // query to get id of the current user
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                
                // starting the session for the current user
                $_SESSION["id"] = $rows[0]["id"];
                
                // redirect user to index.php
                redirect("/");
            }
        }
    }

?>
