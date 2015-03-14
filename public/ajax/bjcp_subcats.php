<?php

/**
 * Looks up all the subcategories for a BJCP category
 */
 
    // configuration
    require("../../includes/config.php");
    
    // get all subcategory letters and names
    $rows = query("SELECT cat_letter, style 
                   FROM BJCP
                   WHERE cat_num = ?", $_POST["category"]);
    
    echo json_encode($rows);
    
    die();

?>