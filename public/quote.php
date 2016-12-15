<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("stock.php", ["title" => "Get Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
            if ($stock === false)
            {
                apologize("Symbol not found.");
            }
            else
            {
                render("display_stock.php", ["title" => "Quote", "name" => $stock["name"], 
                "symbol" => $stock["symbol"], "price" => number_format($stock["price"], 2)]);
            }
        }
    }

?>
