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
        // TODO
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
            apologize("Password field must be same as Confirm Password field.");
        }
        else
        {
            $row = CS50::query("INSERT IGNORE into `users` (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], 
            password_hash($_POST["password"], PASSWORD_DEFAULT));
            if ($row !== 1)
            {
                apologize("User with username {$_POST["username"]} already exists.");
            }
            else
            {
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $_SESSION["id"] = $rows[0]["id"];
                redirect("/");
            }
        }
    }

?>
