<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("pswd-form.php", ["title" => "Change Password"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["password"]))
        {
            apologize("You must provide a Password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Password field must be same as Confirm Password field.");
        }
        else
        {
            // preparing pass key
            $pswd = password_hash($_POST["password"], PASSWORD_DEFAULT);
            
            // query to update password
            $row = CS50::query("UPDATE `users` SET `hash`='{$pswd}' WHERE id={$_SESSION["id"]}");
            
            // sanity check
            if ($row !== 1)
            {
                apologize("Server Error!! Please Try Later.");
            }
            else
            {
                // redirect to index.php
                redirect("/");
            }
        }
    }

?>
