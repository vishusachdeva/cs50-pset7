<?php

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else redirect to quote.php
        redirect("quote.php");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        echo("<p>A share of {$name} ({$symbol}) costs <strong>\${$price}</strong>.</p>");
    }

?>
