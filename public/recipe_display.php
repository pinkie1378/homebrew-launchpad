<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        foreach ( $_GET as $i ) {
            // organize into CALC_INPUT, recipe specs, and bjcp categories
            if ( !empty($i) ) {
                $index = strtok( key($_GET), "_" );
                $subindex = strtok( "_" );
                if ( !$subindex ) {
                    if ( $index == "cat" ) {
                        $bjcp_category = $i;
                    }
                    else if ( $index == "subcat" ) {
                        $bjcp_subcat = $i;
                    }
                    else if ( $index == "og" ) {
                        $specs[$index] = floatval($i);
                    }
                    else if ( $index == "lovibond" || $index == "ibu" ) {
                        $specs[$index] = intval($i);
                    }
                    else {
                        $calc_input["recipe"][$index] = $i;
                    }
                }
                else {
                    $calc_input[$index][$subindex] = $i;
                }
            }
            next( $_GET );
        }
        // make sure grain1 is present in CALC_INPUT
        if ( !isset( $calc_input["grain1"] ) ) {
            $calc_input["grain1"] = [
                "type" => NULL,
                "name" => NULL,
                "amount" => NULL
            ];
        }
        // give the recipe a title if one wasn't entered
        if ( !isset( $calc_input["recipe"]["name"] ) ) {
            $calc_input["recipe"]["name"] = "No Name Beer";
        }
        // pass on user selected BJCP category, if one was selected
        if ( isset( $bjcp_category ) && isset( $bjcp_subcat ) ) {
            $bjcp = $bjcp_category . $bjcp_subcat;
        }
        else {
            $bjcp = "";
        }
        // look up yeast name
        $row = query("SELECT name FROM Yeast WHERE number = ?", $calc_input["yeast"]["number"]);
        $yeast_name = $row[0]["name"];
        unset($row);

        render("recipe_display_template.php", [
            "calc_input" => $calc_input,
            "bjcp"       => $bjcp,
            "specs"      => $specs,
            "yeast_name" => $yeast_name,
            "title"      => $calc_input["recipe"]["name"]
        ]);
    }

    else {
        redirect("recipe.php");
    }

?>