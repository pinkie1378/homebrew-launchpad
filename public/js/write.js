/**
 * write.js
 * 
 * Functions that generate HTML for the recipe calculator.
 */

/**
 * Inserts the recipe selection HTML consisting of all the recipe names from recipes.js.
 */
function writeRecipes() {
    var html = '<option value="" disabled selected style="display:none">Select recipe</option>';
    for ( i in RECIPES ) {
        html += '<option value="' + stringBetween( "(", ")", RECIPES[i].recipe.name ) 
        + '">' + RECIPES[i].recipe.name + '</option>';
    }
    $( "#recipes" ).html( html ).prop( "disabled", false );
}

/**
 * Resets recipe calculator HTML to what is originally loaded onto page.
 */
function writeBlankCalc() {
    $.ajax({
        type:     'GET',
        url:      'ajax/blank_calculator.php',
        dataType: 'text',
        async:    false,
        success:  function( html ) {
            $( "#calculator" ).html( html );
        }
    });
}

/**
 * Writes BJCP subcategory HTML for chosen BJCP category. Makes an AJAX call to bjcp_subcats.php.
 */
function writeBJCPsubcats( cat ) {
    // clear ingredients and vital stats output
    $( "#bjcp" ).hide( 500, function(){
        $( "#bjcp" ).html( "" );
    });
    // write new subcategory selection list
    $.ajax({
        type:       'POST',
        url:        'ajax/bjcp_subcats.php', 
        data:       {category: cat},
        dataType:   'json',
        async:      false,
        success:    function(subcat) {
            var html = '<option value="" disabled selected style="display:none">Select subcategory</option>';
            for (i in subcat) {
                html += '<option value="' + subcat[i].cat_letter + '">'
                + subcat[i].cat_letter + '. ' + subcat[i].style + '</option>';
            }
            $( "#subcat" ).html( html ).prop( "disabled", false );
        }
    });
}

/**
 * Writes chosen style's ingredients and vital statistics. Makes an AJAX call to bjcp_info.php
 */
function writeBJCPinfo( subcat ) {
    var cat = $( "#cat" ).val();
    $.ajax({
        type:       'POST',
        url:        'ajax/bjcp_info.php',
        data:       {cat_num: cat, cat_letter: subcat},
        dataType:   'json',
        async:      false,
        success:    function(info) {
            var html = '<dl class="dl-horizontal">';
            if ( info.ingredients != null ) {
                html += '<dt>Ingredients</dt><dd>' + info.ingredients + '</dt>';
            }
            html += '<dt>Vital Statistics</dt>';
            if ( info.vital_stat_note == null ) {
                html += '<dd><table><thead><tr>'
                + '<th style="padding-right:20px">IBUs</th>'
                + '<th style="padding-right:20px">&deg;Lovibond</th>'
                + '<th style="padding-right:20px">Original Gravity</th>'
                + '<th style="padding-right:20px">Final Gravity</th>'
                + '<th style="padding-right:20px">% Alcohol</th>'
                + '</tr></thead><tbody><tr>'
                + '<td>' + info.ibu_min + ' - ' + info.ibu_max + '</td>'
                + '<td>' + info.srm_min + ' - ' + info.srm_max + '</td>'
                + '<td>' + info.og_min + ' - ' + info.og_max + '</td>'
                + '<td>' + info.fg_min + ' - ' + info.fg_max + '</td>'
                + '<td>' + info.abv_min + ' - ' + info.abv_max + '</td>'
                + '</tr></tbody></table></dd>'
                + '</dl>';
            }
            else {
                html += '<dd>' + info.vital_stat_note + '</dd></dl>';
            }
            $( "#bjcp" ).hide( 500, function() {
                $( "#bjcp" ).html( html ).show( 500 );
            });
        }
    });
}

/**
 * Loops through the INGREDIENTS object and returns the names of those objects
 * that match value in option tagged html.
 */
function writeOptions( index, type ) {
    var html = "";
    switch ( index ) {
        case "extract":
            html = '<option value="" disabled selected style="display:none">Select extract</option>';
            break;
        case "grain":
            html = '<option value="" disabled selected style="display:none">Select specialty grain</option>';
            break;
        case "hop":
            html = '<option value="" disabled selected style="display:none">Select hop</option>';
            break;
    }
    for ( i in INGREDIENTS[index] ) {
        if ( INGREDIENTS[index][i].type == type ) {
            html += '<option value="' + i + '">' + INGREDIENTS[index][i].name + '</option>';
        }
    }
    return html;
}

/**
 * Loops through the INGREDIENTS.yeast object and returns the names of those
 * objects that are of the desired type (Ale, Lager) and company (Wyeast, White Labs).
 */
function writeYeastOptions() {
    var html = '<option value="" disabled selected style="display:none">Select yeast</option>';
    for ( i in INGREDIENTS.yeast ) {
        if ( INGREDIENTS.yeast[i].type == CALC_INPUT.yeast.type && 
             INGREDIENTS.yeast[i].company == CALC_INPUT.yeast.company ) {
            html += '<option value="' + i + '">' + INGREDIENTS.yeast[i].name + '</option>';
        }
    }
    return html;
}

/**
 * Adds an extract ingredient row to the calculator.
 */
function writeExtract( num ) {
    var extractHTML = '<div class="row row-xs-height"> \
        <div class="col-xs-6 col-xs-height col-bottom"> \
            <div class="input-group"> \
                <span class="input-group-addon">Extract ' + num + '</span> \
                <label class="radio-inline"> \
                    <input type="radio" id="extract' + num + '_liquid" name="extract' + num + '_type" class="extract' + num + '_type" value="Liquid"> \
                    Liquid \
                </label> \
                <label class="radio-inline"> \
                    <input type="radio" id="extract' + num + '_powder" name="extract' + num + '_type" class="extract' + num + '_type" value="Powder"> \
                    Powder \
                </label> \
                <label class="checkbox-inline" style="margin-left:10px"> \
                    <input type="checkbox" id="extract' + num + '_end" name="extract' + num + '_end" class="extract' + num + '_type" value="true"> \
                    End of boil \
                </label> \
                <select class="form-control" id="extract' + num + '_name" name="extract' + num + '_name" disabled> \
                    <option value="">Select extract type...</option> \
                </select> \
            </div> \
        </div> \
        <div id="extract' + num + '_state" class="state col-xs-6 col-xs-height col-bottom"> \
            <!-- Extract amount --> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <input type="number" min="0" step="0.01" class="form-control inputDecimal" id="extract' + num + '_amount" name="extract' + num + '_amount"> \
                    <span class="input-group-addon">lb</span> \
                </div> \
            </div> \
            <!-- Extract Malt Color Units (MCU) --> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <span class="input-group-addon">MCU</span> \
                    <input type="text" class="form-control" id="extract' + num + '_mcu" readonly> \
                </div> \
            </div> \
            <!-- Extract O.G. --> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <span class="input-group-addon">O.G.</span> \
                    <input type="text" class="form-control" id="extract' + num + '_og" readonly> \
                </div> \
            </div> \
        </div></div>';
    return extractHTML;
}

function writeButton( ingType, num ) {
    var next = num + 1;
    var html = '<div class="container container-xs-height" id="' + ingType + next + '">';
    html += '<div class="row row-xs-height"><div class="col-xs-12 col-xs-height col-bottom">';
    if ( num > 1 ) {
        html += '<button type="button" class="btn btn-custom btn-sm" value="' + ingType + '_' + num + '_remove"> \
                &ndash; ' + strCap( ingType ) + ' ' + num + '</button> ';
    }
    if ( next < 10 ) {
        html += '<button type="button" class="btn btn-custom btn-sm" value="' + ingType + '_' + next + '_add" \
                id="' + ingType + next + '_add" style="display:none">+ ' + strCap( ingType ) + ' ' + next + '</button>';
    }
    html += '</div></div></div>';
    return html;
}

/**
 * Adds a specialty grain ingredient row to the calculator.
 */
function writeGrain( num ) {
    var grainHTML = '<div class="row row-xs-height"> \
        <!--Grain selection list--> \
        <div class="col-xs-6 col-xs-height col-bottom"> \
            <div class="input-group"> \
            <span class="input-group-addon">Grain ' + num + '</span> \
                <label class="radio-inline"> \
                    <input type="radio" class="grain' + num + '_type" id="grain' + num + '_kilned" name="grain' + num + '_type" value="Kilned"> \
                    Kilned \
                </label> \
                <label class="radio-inline"> \
                    <input type="radio" class="grain' + num + '_type" id="grain' + num + '_caramel" name="grain' + num + '_type" value="Caramel"> \
                    Caramel \
                </label> \
                <label class="radio-inline"> \
                    <input type="radio" class="grain' + num + '_type" id="grain' + num + '_roasted" name="grain' + num + '_type" value="Roasted"> \
                    Roasted \
                </label> \
                <select class="form-control" id="grain' + num + '_name" name="grain' + num + '_name" disabled> \
                    <option value="">Select grain type...</option> \
                </select> \
            </div> \
        </div> <!-- close column --> \
        <div id="grain' + num + '_state" class="state col-xs-6 col-xs-height col-bottom"> \
            <!--Grain amount--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <input type="number" min="0" step="0.005" class="form-control inputDecimal" id="grain' + num + '_amount" name="grain' + num + '_amount"> \
                    <span class="input-group-addon">lb</span> \
                </div> \
            </div> <!-- close column --> \
            <!--Grain Malt Color Units (MCU)--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <span class="input-group-addon">MCU</span> \
                    <input type="text" class="form-control" id="grain' + num + '_mcu" readonly> \
                </div> \
            </div> <!-- close column --> \
            <!--Grain 1 O.G.--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <span class="input-group-addon">O.G.</span> \
                    <input type="text" class="form-control" id="grain' + num + '_og" readonly> \
                </div> \
            </div> <!-- close column --> \
        </div></div>';
    return grainHTML;
}

function writeHop( num ) {
    var hopHTML = '<div class="row row-xs-height"> \
        <div class="col-xs-6 col-xs-height col-bottom"> \
            <div class="input-group"> \
                <span class="input-group-addon">Hop ' + num + '</span> \
                <label class="radio-inline"> \
                    <input type="radio" class="hop' + num + '_type" id="hop' + num + '_bittering" name="hop' + num + '_type" value="Bittering"> \
                    Bittering \
                </label> \
                <label class="radio-inline"> \
                    <input type="radio" class="hop' + num + '_type" id="hop' + num + '_dual" name="hop' + num + '_type" value="Dual"> \
                    Dual \
                </label> \
                <label class="radio-inline"> \
                    <input type="radio" class="hop' + num + '_type" id="hop' + num + '_aroma" name="hop' + num + '_type" value="Aroma"> \
                    Aroma \
                </label> \
                <select class="form-control" id="hop' + num + '_name" name="hop' + num + '_name" disabled> \
                    <option value="">Select hop type...</option> \
                </select> \
            </div> \
        </div> <!-- close column --> \
        <div id="hop' + num + '_state" class="state col-xs-6 col-xs-height col-bottom"> \
            <!--Hop amount--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <input type="number" min="0" step="0.005" class="form-control inputDecimal" id="hop' + num + '_amount" name="hop' + num + '_amount"> \
                    <span class="input-group-addon">oz</span> \
                </div> \
            </div> <!-- close column --> \
            <!--Hop 1 boiling time--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <input type="number" min="0" step="5" class="form-control inputInteger" id="hop' + num + '_time" name="hop' + num + '_time"> \
                    <span class="input-group-addon">min</span> \
                </div> \
            </div> <!-- close column --> \
            <!--Hop IBUs--> \
            <div class="col-xs-4 col-xs-height col-bottom"> \
                <div class="input-group"> \
                    <span class="input-group-addon">IBU</span> \
                    <input type="text" class="form-control" id="hop' + num + '_ibu" readonly> \
                </div> \
            </div> <!-- close column --> \
        </div></div>';
    return hopHTML;
}
