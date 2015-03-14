<div id="middle" class="col-sm-12">

<h3>Recipe for <?= $calc_input["recipe"]["name"] ?></h3> 

<h4>OG: <?= $specs["og"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&deg;Lovibond: <?= $specs["lovibond"] ?>&nbsp;&nbsp;&nbsp;&nbsp;IBU: <?= $specs["ibu"] ?></h4>

<dl class="dl-horizontal">

    <?php
    
    $grain_state = false;

    while( $i = current($calc_input) ) {
        $type = rtrim( key($calc_input), "0..9" );
        if ( $type == "extract" ) {
            if ( key($calc_input) == "extract1" ) {
                print("<dt>Malt Extracts</dt>");
            }
            print("<dd>{$i['amount']} lb {$i['name']}</dd>");
        }
        else if ( $type == "grain" && $i['name'] != NULL ) {
            if ( key($calc_input) == "grain1" ) {
                print("<dt>Specialty Grains</dt>");
                $grain_state = true;
            }
            print("<dd>{$i['amount']} lb {$i['name']}</dd>");
        }
        else if ( $type == "hop" ) {
            if ( key($calc_input) == "hop1" ) {
                print("<dt>Hops</dt>");
            }
            print("<dd>{$i['amount']} oz {$i['name']}</dd>");
        }
        else if ( $type == "yeast" ){
            print("<dt>Yeast</dt>");
            print("<dd>{$yeast_name} - {$i['number']} from {$i['company']}</dd>");
        }
        next( $calc_input );
    }

    if ( $calc_input["yeast"]["company"] == "White Labs" ) {
        $prepare_yeast = "Take the <strong>".$yeast_name." - ".$calc_input["yeast"]["number"]."</strong> tube out of the refridgerator and let the yeast slowly come to room temperature.";
    }
    else {
        $prepare_yeast = "Take the <strong>".$yeast_name." - ".$calc_input["yeast"]["number"]."</strong> envelope out of the refridgerator and smack it between the palms of your hands to burst the sealed nutrient packet within. The yeast will wake up; after several hours the envelope will be fully inflated and the yeast will be ready to pitch.";
    }
    ?>

</dl>

<ol>
    <li><?= $prepare_yeast ?></li>
    <?php
        $adjust_volume = round( $calc_input["recipe"]["volTotal"] - $calc_input["recipe"]["volBoil"] +
                               ( $calc_input["recipe"]["volTotal"] / 5 ), 2 );
    ?>
    <li>Boil <strong><?= $adjust_volume ?> gal of water</strong> for 10-15 min, and then set aside to cool. Leave the lid on the pot to keep the water from getting contaminated. This water will be used to adjust the volume prior to pitching the yeast.</li>
<?php
    if( $grain_state ) {
        $steep_vol = $calc_input["recipe"]["volBoil"] / 3;
        $rinse_vol = $calc_input["recipe"]["volBoil"] - $steep_vol;
        print( "<li>Heat <strong>".$steep_vol."</strong> and <strong>".$rinse_vol." gal of water</strong></li>" );
    }
?>
    <li>bring boil vol to boil, add extract, then return to boil for boil time</li>
    <li>add hops according to hop schedule</li>
    <li>add knockout extract</li>
    <li>chill wort</li>
    <li>adjust gravity; transfer to carboy</li>
</ol>

<?php echo json_encode($calc_input); ?>