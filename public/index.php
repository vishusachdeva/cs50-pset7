<?php

    // configuration
    require("../includes/config.php"); 
    
    // query for selecting symbols and their respective shares own by that user
    $rows = CS50::query(
        "SELECT symbol, shares
        FROM portfolios
        WHERE user_id={$_SESSION["id"]}
        ORDER BY symbol"
    );
    
    // query for selecting user's main account cash balance
    $cash = CS50::query(
        "SELECT cash
        FROM users
        WHERE id={$_SESSION["id"]}"
    );
    
    // declaring an associative array for sending data
    $positions = [];
    
    // if that user own something
    if ($rows)
    {
        // preparing positions array
        foreach ($rows as $row)
        {
            // checking cuurent price of that symbol
            $stock = lookup($row["symbol"]);
            
            // sanity check
            if ($stock !== false)
            {
                // total share amount
                $total = $row["shares"] * $stock["price"];
                
                // making positions array
                $positions[] = [
                    "name" => $stock["name"],
                    "price" => number_format($stock["price"], 2),
                    "shares" => $row["shares"],
                    "symbol" => $row["symbol"],
                    "total" => number_format($total, 2)
                ];
            }
        }
    }

    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => number_format($cash[0]["cash"], 2)]);

?>
