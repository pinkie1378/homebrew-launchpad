<div id="middle" class="col-sm-12">

<h3>Recipe for <?= $calc_input["recipe"]["name"] ?></h3> 

<h4>OG: <?= $specs["og"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&deg;Lovibond: <?= $specs["lovibond"] ?>&nbsp;&nbsp;&nbsp;&nbsp;IBU: <?= $specs["ibu"] ?></h4>

<?php

    // set yeast instructions based on manufacturer
    if ( $calc_input["yeast"]["company"] == "White Labs" ) {
        $prepare_yeast = "Take the <strong>".$yeast_name." - ".$calc_input["yeast"]["number"]."</strong> tube out of the refrigerator and let the yeast slowly come to room temperature.";
    }
    else {
        $prepare_yeast = "Take the <strong>".$yeast_name." - ".$calc_input["yeast"]["number"]."</strong> envelope out of the refrigerator and smack it to burst the sealed nutrient packet within. After several hours the envelope will be fully inflated and the yeast will be ready to pitch.";
    }
    
    $adjust_final_volume = round( $calc_input["recipe"]["volTotal"] 
                                  - $calc_input["recipe"]["volBoil"]
                                  + ( $calc_input["recipe"]["volTotal"] / 5 ), 2 );

?>

<!--Ingredients listing-->

<dl class="dl-horizontal">

    <?php
    
        $grain_state = false;
        $grain_output = array();
        $extract_start_output = array();
        $extract_end_output = array();
        $hops_output = "";

        while( $i = current($calc_input) ) {
            $type = rtrim( key($calc_input), "0..9" );
            if ( $type == "extract" ) {
                if ( key($calc_input) == "extract1" ) {
                    print("<dt>Malt Extracts</dt>");
                }
                $extract_display = $i['amount']." lb ".$i['name'];
                print("<dd>$extract_display");
                if ( isset($i['end']) && $i['end'] == "true" ) {
                    print(" (added at end of boil)</dd>");
                    array_push( $extract_end_output, $extract_display );
                }
                else {
                    print("</dd>");
                    array_push( $extract_start_output, $extract_display );
                }
            }
            else if ( $type == "grain" && $i['name'] != NULL ) {
                if ( key($calc_input) == "grain1" ) {
                    print("<dt>Specialty Grains</dt>");
                    $grain_state = true;
                }
                $grain_display = $i['amount']." lb ".$i['name'];
                print("<dd>$grain_display</dd>");
                array_push( $grain_output, $grain_display );
            }
            else if ( $type == "hop" ) {
                if ( key($calc_input) == "hop1" ) {
                    print("<dt>Hops</dt>");
                }
                print("<dd>{$i['amount']} oz {$i['name']}</dd>");
                $hops_output .= "<dt>" . $i['time'] . " min</dt><dd><strong>" . $i['amount'] . " oz " . $i['name'] . "</strong></dd>";
            }
            else if ( $type == "yeast" ){
                print("<dt>Yeast</dt>");
                print("<dd>{$yeast_name} - {$i['number']} from {$i['company']}</dd>");
            }
            next( $calc_input );
        }

    ?>
    
    <dt>Boil Volume</dt><dd><?= $calc_input['recipe']['volBoil'] ?> gallons</dd>
    <dt>Total Volume</dt><dd><?= $calc_input['recipe']['volTotal'] ?> gallons</dd>
    
</dl>

<ol>
    <li><?= $prepare_yeast ?></li>
    <li>Boil <strong><?= $adjust_final_volume ?> gal of water</strong> for 10-15 min, and then set aside to cool. Leave the lid on the pot to keep the water from getting contaminated. This water will be used to adjust the final volume of the wort prior to pitching the yeast.</li>

    <?php
    
        if( $grain_state ) {
            print( "<li>Heat <strong>{$calc_input["recipe"]["volBoil"]} gal of water</strong> to 165 &deg;F.</li>" );
            printf( "<li>Add %s to the 160 &deg;F water. Steep grains for 30 min, keeping water temperature between 155 and 165 &deg;F.</li>", formatted_string_list($grain_output) );
            print( "<li>Remove grains, then bring water to a boil.</li>" );
        }
        else {
            print( "<li>Bring <strong>{$calc_input["recipe"]["volBoil"]} gal of water</strong> to a boil.</li>" );
        }
        printf( "<li>Remove pot from heat to prevent scorching of malt, add %s, then stir until dissolved.</li>",
                formatted_string_list($extract_start_output) );
        print ( "<li>Return pot to heat and bring wort to a boil. Once wort reaches boil, set a countdown timer for <strong>{$calc_input['recipe']['timeBoil']} min</strong>.</li>" );
    ?>
    
    <li>Add hops to wort when timer reaches the following time(s):
        <dl class="dl-horizontal" style="margin-bottom:0px"><?= $hops_output ?></dl>
    </li>
    
    <?php
    
        if ( count($extract_end_output) > 0 ) {
            printf ( "<li>Upon completion of boil, add %s, then stir until dissolved.</li>",
                     formatted_string_list($extract_end_output) )
        }
    
    ?>
    <li>Rapidly chill wort down to fermentation temperature. This is most easily accomplished with an immersion chiller; can also be done by putting pot in an ice bath.</li>
    <li>Transfer chilled wort to fermentation vessel, and add boiled water from step 2 to a total volume of <strong><?= $calc_input["recipe"]["volTotal"] ?> gal</strong>.
        <ul>
            <li>The final volume can be set by taking specific gravity measurements with a hydrometer or a refractomoeter. While finalizing the volume, take periodic measurements. Final volume is achieved when the wort specific gravity is <strong>$specs["og"]</strong>.</li>
        </ul>
    </li>
    <li>Pitch the <strong><?= $yeast_name ?></strong>, close the fermentation chamber, and fit an airlock. Move the fermentation chamber to a dark area.</li>
    
</ol>

<?php echo json_encode($calc_input); ?>