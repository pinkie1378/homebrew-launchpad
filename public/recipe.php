<?php

    // configuration
    require("../includes/config.php");

    // get category names
    $categories = query("SELECT * FROM BJCP_Categories");
    if ($categories === false) {
        apologize("Unable to retreive beer style categories.");
    }

    // render recipe form
    render("recipe_form.php", ["categories" => $categories, "title" => "Recipe Calculator"]);

?>