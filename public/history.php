<?php

    // configuration
    require("../includes/config.php"); 

    $rows = CS50::query(
        "SELECT *
        FROM history
        WHERE user_id={$_SESSION["id"]}
        ORDER BY time"
    );

    // render portfolio
    render("display-history.php", ["title" => "Portfolio", "rows" => $rows]);

?>
