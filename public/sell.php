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
            apologize("You must select a stock to sell.");
        }
        else
        {
            $rows = CS50::query(
                "SELECT shares
                FROM portfolios
                where user_id={$_SESSION["id"]} AND symbol='{$_POST["symbol"]}'"
            );
            
            if (count($rows) !== 1)
            {
                apologize("Server Error!! Please Try Later.");
            }
            else
            {
                $stock = lookup($_POST["symbol"]);
                $cash_to_add = $stock["price"] * $rows[0]["shares"];
                $time = time();
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
                if (count($del_upd) !== 1)
                {
                    apologize("Server Error!! Please Try Later.");
                }
                
                redirect("/");
            }
        }
    }

?>
