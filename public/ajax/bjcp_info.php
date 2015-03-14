<?php

/**
 * Looks up the ingredients and vital statistics entries for posted style in
 * the BJCP database.
 */

    // configuration
    require("../../includes/config.php");

    // get ingredients and vital statistics
    $rows = query("SELECT ingredients, ibu_min, ibu_max, srm_min, srm_max,
                          og_min, og_max, fg_min, fg_max, abv_min, abv_max,
                          vital_stat_note
                   FROM BJCP
                   WHERE cat_num = ? AND cat_letter = ?",

                   $_POST["cat_num"], $_POST["cat_letter"]);

    echo json_encode($rows[0]);

    die();

?>