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
    
        if ($rows === 0)
        {
            apologize("Nothing to sell.");
        }
        
        // else render form
        render("sell-form.php", ["title" => "Sell"]);
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
            render("display_stock.php", ["title" => "Quote", "name" => $stock["name"], 
            "symbol" => $stock["symbol"], "price" => number_format($stock["price"], 2)]);
        }
    }

?>
