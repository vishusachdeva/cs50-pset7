<?php

    // configuration
    require("../includes/config.php"); 

    $rows = CS50::query(
        "SELECT symbol, shares
        FROM portfolios
        WHERE user_id={$_SESSION["id"]}
        ORDER BY symbol"
    );
    $cash = CS50::query(
        "SELECT cash
        FROM users
        WHERE id={$_SESSION["id"]}"
    );
    $positions = [];
    if ($rows)
    {
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $total = $row["shares"] * $stock["price"];
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
