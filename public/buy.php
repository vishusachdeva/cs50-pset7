<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy-form.php", ["title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            // if symbol field is empty
            apologize("You must specify a stock to buy.");
        }
        else if (empty($_POST["shares"]))
        {
            // if shares field is empty
            apologize("You must specify a number of shares.");
        }
        else
        {
            // validating number of shares
            if (preg_match("/^\d+$/", $_POST["shares"]) == false)
            {
                apologize("Invalid number of shares.");
            }
            else
            {
                // looking up for cuurent price of symbol
                $stock = lookup($_POST["symbol"]);
                
                // if that symbol doesn't exist
                if ($stock === false)
                {
                    apologize("Symbol not found.");
                }
                
                // cash to deduct from users main account
                $cash_to_deduct = $stock["price"] * $_POST["shares"];
                
                $check = CS50::query("SELECT cash FROM users
                WHERE id={$_SESSION["id"]}");
                
                $symbol = strtoupper($_POST["symbol"]);
                
                // creating date object
                $time = date("m/d/y, h:ia");
                
                // checking that user has enough amount to buy shares or not
                if ($cash_to_deduct > $check[0]["cash"])
                {
                    apologize("You can't afford that.");
                }
                
                // query for updating user's action
                $del_upd = CS50::query(
                    "START TRANSACTION;
                    INSERT INTO portfolios (user_id, symbol, shares)
                    VALUES({$_SESSION["id"]}, '{$symbol}', {$_POST["shares"]})
                    ON DUPLICATE KEY UPDATE shares = shares + {$_POST["shares"]};
                    UPDATE users
                    SET cash = cash - {$cash_to_deduct}
                    WHERE id = {$_SESSION["id"]};
                    INSERT INTO history (user_id, transaction, time, symbol, shares, price)
                    VALUES({$_SESSION["id"]}, 'BUY', '{$time}', '{$symbol}', '{$_POST["shares"]}', '{$stock["price"]}');
                    COMMIT;"
                );
                
                // sanity check
                if (count($del_upd) !== 1)
                {
                    apologize("Server Error!! Please Try Later.");
                }
                
                // redirect to index.php
                redirect("/");
            }
        }
    }

?>
