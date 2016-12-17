<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("deposit-form.php", ["title" => "Change Password"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["deposit"]))
        {
            apologize("You must provide an amount to deposit.");
        }
        else if (is_numeric($_POST["deposit"]) == false)
        {
            apologize("Deposited amount is not valid.");
        }
        else
        {
            $row = CS50::query("UPDATE `users` SET `cash`=`cash`+'{$_POST["deposit"]}' WHERE id={$_SESSION["id"]}");
            if ($row !== 1)
            {
                apologize("Server Error!! Please Try Later.");
            }
            else
            {
                redirect("/");
            }
        }
    }

?>
