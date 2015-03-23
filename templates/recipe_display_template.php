<div id="middle" class="col-xs-12">
<div class="row">
    <div class="col-xs-8">
        <h3 style="margin-top:0px"><strong>Recipe for <?= $calc_input["recipe"]["name"] ?></strong></h3> 

        <h4><strong>OG: <?= number_format($specs["og"], 3); ?>&nbsp;&nbsp;&nbsp;&nbsp;&deg;Lovibond: <?= $specs["lovibond"] ?>&nbsp;&nbsp;&nbsp;&nbsp;IBU: <?= $specs["ibu"] ?></strong></h4>
    </div>

    <div class="col-xs-4">
        <form id="back_to_calculator" action="recipe.php" method="POST">
            <input type="submit" value="View in Recipe Calculator" class="btn btn-custom btn-lg">
        </form>
        <textarea name="calc_input" form="back_to_calculator" hidden><?php echo json_encode( $calc_input ); ?></textarea>
        <textarea name="bjcp" form="back_to_calculator" hidden><?= $bjcp ?></textarea>
    </div>
</div>

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
        if ( $calc_input["yeast"]["type"] == "Ale" ) {
            $fermentation_temp = 65;
        }
        else {
            $fermentation_temp = 50;
        }

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

<h4><strong>Brewing Day</strong></h4>

<ol>
    <li><?= $prepare_yeast ?></li>
    <li>Boil <strong><?= $adjust_final_volume ?> gal of water</strong> for <strong>10-15 minutes</strong>, and then set aside to cool. Leave the lid on the pot to keep the water from getting contaminated. This water will be used to adjust the final volume of the wort prior to pitching the yeast.</li>

    <?php
    
        if( $grain_state ) {
            print( "<li>Heat <strong>{$calc_input["recipe"]["volBoil"]} gal of water</strong> to <strong>165 &deg;F</strong>.</li>" );
            printf( "<li>Add %s to the 165 &deg;F water. Steep grains for <strong>30 minutes</strong>, keeping the water temperature between <strong>155 and 165 &deg;F</strong>.</li>", formatted_string_list($grain_output) );
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
        <dl class="dl-horizontal" style="margin-top:20px"><?= $hops_output ?></dl>
    </li>
    
    <?php
    
        if ( count($extract_end_output) > 0 ) {
            printf ( "<li>Upon completion of boil, add %s, then stir until dissolved.</li>",
                     formatted_string_list($extract_end_output) );
        }
    
    ?>
    <li>Rapidly chill wort down to about <strong><?= $fermentation_temp + 15 ?> &deg;F</strong>. This is most easily accomplished with an immersion chiller; it can also be done by putting the pot in an ice bath.</li>
    <li>Transfer chilled wort to fermentation vessel, and add boiled water from step 2 to a total volume of <strong><?= $calc_input["recipe"]["volTotal"] ?> gal</strong>.<br />The final volume can be set by taking specific gravity measurements with a hydrometer or a refractomoeter. While finalizing the volume, take periodic measurements. Final volume is achieved when the wort specific gravity is <strong><?= number_format($specs["og"], 3); ?></strong>.</li>
    <li>Aerate the wort. This can be done by sloshing the wort in the fermenter or using a pump hooked up to a diffusion stone.</li>
    <li>Pitch the <strong><?= $yeast_name ?> - <?= $calc_input["yeast"]["number"] ?></strong> yeast, close the fermentation vessel, and fit an airlock. Move the fermentation vessel to a dark area with an ambient temperature of about <strong><?= $fermentation_temp ?> &deg;F</strong>.</li>
    
</ol>

<h4><strong>Primary Fermentation</strong></h4>
<ol>
    <li>Within <strong>12-24 hours</strong>, the airlock should begin to bubble, and a foamy head should appear.</li>
    <?php
    
        if ( $calc_input["yeast"]["type"] == "Ale" ) {
            print "
                <li>For the next <strong>2-5 days</strong>, the airlock should bubble vigorously, and a creamy kr&auml;usen layer should be present at the top of the beer.</li>
                <li>Next, airlock activity will slow down and the kr&auml;usen will sink to the bottom of the fermenter. At this point the beer is ready to be racked to secondary fermentation: transferring the beer to another fermentation vessel and leaving behind all the sediment (trub) from primary fermentation. There are 2 main reasons for doing so:
                    <ul>
                        <li>The final beer will have less sediment and appear brighter and clearer.</li>
                        <li>Eliminates the possibility of the beer picking up off flavors from the trub. This can happen if dead yeast cells in the trub lyse.</li>
                    </ul>
                Racking to secondary is optional; if not racking, allow the beer to condition for another <strong>2-3 weeks</strong>.
                </li>
            ";
        }
        else {
            print "
                <li>For the next <strong>1-3 weeks</strong>, the airlock should bubble several times per minute, and the activity from the yeast cake at the bottom of the fermenter will make the beer look like it's being continuously stirred.</li>
                <li>Once the fermentation activity has slowed down (airlock bubbling 1 or 2 times per minute and beer looks static) a diacetyl rest can be performed. Raise the fermentation temperature to <strong>60 &deg;F</strong> for <strong>24-48 hours</strong>. This allows the yeast to metabolize any diaceytl that formed during primary fermentation (diacetyl is considered an off flavor in most lager styles).</li>
                <li>Rack the beer for lagering: transfer the beer to another fermentation vessel, leaving behind all the sediment (trub) from primary fermentation.</li>
            ";
        }
    
    ?>
</ol>

<?php

    if( $calc_input["yeast"]["type"] == "Ale" ) {
        print "
            <h4><strong>Secondary Fermentation</strong></h4>
            <ol>
                <li>Siphon the beer into an empty fermentation vessel. Minimize exposure to oxygen by placing the end of the siphon at the bottom of the empty fermentation vessel; this minimizes the sloshing and splashing during transfer.</li>
                <li>Put the fermentation vessel back in a dark area with an ambient temperature of about <strong>{$fermentation_temp} &deg;F</strong> for <strong>2-3 weeks</strong>. There will be very little to no airlock activity.</li>
            </ol>
        ";
    }
    else {
        print "
            <h4><strong>Lagering</strong></h4>
            <ol>
                <li>Siphon the beer into an empty fermentation vessel. Minimize exposure to oxygen by placing the end of the siphon at the bottom of the empty fermentation vessel; this minimizes the sloshing and splashing during transfer.</li>
                <li>Put the fermentation vessel in a dark area with an ambient temperature <strong>10-15 &degF</strong> lower than the primary fermentation (usually <strong>35-45 &deg;F</strong>).</li>
                <li>Leave to condition for <strong>4-6 weeks</strong> for warmer lagering conditions, and <strong>6-8 weeks</strong> for colder lagering conditions.</li>
            </ol>
        ";
    }

?>

<h4><strong>Bottling</strong></h4>
<ol>
    <li>Clean and sanitize bottles. Bottles can be sterilized after cleaning by covering the opening with aluminium foil and baking at <strong>350 &deg;F</strong> for <strong>1 hour</strong>. As long as aluminium foil covers aren't disturbed, the sterile bottles can be stored indefinitely.</li>
    <li>Sanitize caps. This can be done by placing caps in a steamer basket and steaming them for <strong>10 minutes</strong>.</li>
    <li>Prepare priming syrup by dissolving appropriate amount of sugar in a small quantity of water and simmering for several minutes. Use a <a href="http://www.northernbrewer.com/priming-sugar-calculator/" target="_blank">priming sugar calculator</a> to determine the appropriate amount of sugar to use.</li>
    <li>Put priming syrup in a large vessel (bottling bucket, pot, carboy, etc.) that can hold all the beer, and siphon the beer into the vessel. This evenly mixes the priming sugar in the beer.</li>
    <li>Dispense the beer into the bottles, leaving about <strong>1 inch</strong> of headspace.</li>
    <li>Crimp the caps onto the bottles.</li>
    <li>Store the beer at room temperature for about <strong>2 weeks</strong>. During this time the residual yeast will convert the priming sugar into CO<sub>2</sub>, carbonating the beer. Once the beer is carbonated, it can be moved to the refrigerator or basement for storage.
</ol>
