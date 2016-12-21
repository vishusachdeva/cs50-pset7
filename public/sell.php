<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $rows = CS50::query(
            "SELECT symbol
            FROM portfolios
            WHERE user_id={$_SESSION["id"]}"
        );
    
        if (count($rows) === 0)
        {
            apologize("Nothing to sell.");
        }
        
        // else render form
        render("sell-form.php", ["title" => "Sell", "rows" => $rows]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            // if symbol field is empty
            apologize("You must select a stock to sell.");
        }
        else
        {
            // query to select number of shares of the specific symbol
            $rows = CS50::query(
                "SELECT shares
                FROM portfolios
                where user_id={$_SESSION["id"]} AND symbol='{$_POST["symbol"]}'"
            );
            
            // sanity check
            if (count($rows) !== 1)
            {
                apologize("Server Error!! Please Try Later.");
            }
            else
            {
                // looking up for the symbol for the current price
                $stock = lookup($_POST["symbol"]);
                
                // cash to be added to user's main cah balance
                $cash_to_add = $stock["price"] * $rows[0]["shares"];
                
                // creating date object
                $time = date("m/d/y, h:ia");
                
                // query to update portfolio's and user's table
                $del_upd = CS50::query(
                    "START TRANSACTION;
                    DELETE FROM portfolios
                    WHERE user_id = {$_SESSION["id"]} AND symbol = '{$_POST["symbol"]}';
                    UPDATE users
                    SET cash = cash + {$cash_to_add}
                    WHERE id = {$_SESSION["id"]};
                    INSERT INTO history (user_id, transaction, time, symbol, shares, price)
                    VALUES({$_SESSION["id"]}, 'SELL', '{$time}', '{$_POST["symbol"]}', '{$rows[0]["shares"]}', '{$stock["price"]}');
                    COMMIT;"
                );
                
                // sanity check
                if (count($del_upd) !== 1)
                {
                    apologize("Server Error!! Please Try Later.");
                }
                
                // sanity check
                redirect("/");
            }
        }
    }

?>
