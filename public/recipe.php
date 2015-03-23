<?php

    // configuration
    require("../includes/config.php");

    // get category names
    $categories = query("SELECT * FROM BJCP_Categories");
    if ($categories === false) {
        apologize("Unable to retreive beer style categories.");
    }

    // render recipe form
    if ( isset($_POST["calc_input"]) && isset( $_POST["bjcp"] ) ) {
        render("recipe_form.php", [
            "categories" => $categories,
            "calc_input_json" => $_POST["calc_input"],
            "bjcp_json" => $_POST["bjcp"],
            "title" => "Recipe Calculator"
        ]);
    }
    else if ( isset($_POST["calc_input"]) ) {
        render("recipe_form.php", [
            "categories" => $categories,
            "calc_input_json" => $_POST["calc_input"],
            "title" => "Recipe Calculator"
        ]);
    }
    else {
        render("recipe_form.php", ["categories" => $categories, "title" => "Recipe Calculator"]);
    }

?>