/**
 * calculator.js
 *
 * Manages gathering input and setting output for extract recipe calcuator.
 * Also controls which recipe fields are enabled and disabled, based on inputs.
 */

/**
 * Initializes the recipe calculator
 */
function init() {
    // initialize recipe selection list and CALC_INPUT
    writeRecipes();
    initGlobals();
    
    // display previous BJCP specs, if there were any
    var prevBJCP = $( "#previous_bjcp" ).text().trim();
    console.log( prevBJCP );
    if ( prevBJCP != "" ) {
        selectBJCP( prevBJCP );
        console.log( "selected " + prevBJCP );
    }
    // populate calculator with previous recipe, if there is one
    var prevCalcInput = $( "#previous_calc_input" ).text().trim();
    if ( prevCalcInput != "" ) {
        CALC_INPUT = JSON.parse( prevCalcInput );
        // populate form with CALC_INPUT and calculate CALC_OUTPUT
        CALC_INPUTtoForm();
        firstSelection( false );
        renderForm();
        calculate();
        displayCALC_OUTPUT();
    }
}

$( document ).ready( function() {

    init();

    // event handler for radios
    $( "#calculator" ).on( "change", "input:radio", function () {
        parseRadio( this.id, this.value );
        renderForm();
        calculate();
        displayCALC_OUTPUT();
    });

    // event handlers for selection lists
    $( "#calculator" ).on( "change", "select", function () {
        parseSelect( this.id );
        renderForm();
        calculate();
        displayCALC_OUTPUT();
    });
    $( "#recipes, #cat, #subcat" ).change( function() {
        parseSelect( this.id );
    });

    // event handler for checkboxes
    $( "#calculator" ).on( "change", "input:checkbox", function () { 
        parseCheckbox( this.id );
        calculate();
        displayCALC_OUTPUT();
    });

    // event handler for buttons
    $( "#calculator" ).on( "click", "button[type='button']", function() { 
        parseButton( this.value );
    });

    /**
     * turn Enter into Tab.  Source:
     * http://stackoverflow.com/questions/2335553/jquery-how-to-catch-enter-key-and-change-event-to-tab
     */
    $( "#calculator" ).on( "keypress", "input", function( event ) {
        if ( event.key == "Enter" ) {
            event.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });

    // event handlers for number input fields
    $( "#calculator" ).on( "keypress", ".inputInteger, .time", function( event ) {
        restrictInteger( event.currentTarget.id, event, event.charCode );
    });
    $( "#calculator" ).on( "keypress", ".inputDecimal, .volume", function( event ) {
        restrictDecimal( event.currentTarget.id, event, event.charCode );
    });
    $( "#calculator" ).on( "keyup", "#volTotal", function() {
        setTimeout( function() {
            setVolumes( false );
            adjustAmounts();
            displayCALC_OUTPUT();
        }, 250 );
    });
    $( "#calculator" ).on( "change", "#volTotal", function() {
        setVolumes( true );
        adjustAmounts();
        displayCALC_OUTPUT();
    });
    $( "#calculator" ).on( "keyup", "#volBoil", function() {
        if ( setVolBoil( false ) ) {
            adjustAmounts();
        }
        else {
            calculate();
        }
        displayCALC_OUTPUT();
    });
    $( "#calculator" ).on( "change", "#volBoil", function() {
        if ( setVolBoil( true ) ) {
            adjustAmounts();
        }
        else {
            calculate();
        }
        displayCALC_OUTPUT();
    });
    $( "#calculator" ).on( "keyup", ".inputDecimal, .inputInteger", function() {
        assignNumber( this.id, ( 1 / this.step ), false );
        calculate();
        displayCALC_OUTPUT();
    });
    $( "#calculator" ).on( "change", ".inputDecimal, .inputInteger", function() {
        assignNumber( this.id, ( 1 / this.step ), true );
        calculate();
        displayCALC_OUTPUT();
    });
});

/*******************************************************************************
 * RADIO BUTTON LOGIC                                                          *
 ******************************************************************************/

/**
 * Calls functions to write select option lists for ingredient types.
 * Also causes ingredient type to be set in CALC_INPUT.
 */
function parseRadio( id, type ) {
    var ingredient = id.split("_")[0];
    var index = setIndex( ingredient );
    if ( index == "yeast" ) {
        yeastRadio( type );
    }
    else {
        CALC_INPUT[ingredient].type = type;
        ingredientNullify( ingredient );
        $( "#" + ingredient + "_name" ).html( writeOptions( index, type ) );
    }
}

function yeastRadio( typeOrCompany ) {
    CALC_INPUT.yeast.number = null;
    switch ( typeOrCompany ) {
        case "Ale": case "Lager":
            CALC_INPUT.yeast.type = typeOrCompany;
            CALC_INPUT.yeast.company = null;
            $( ".yeast_company" ).prop( "checked", false );
            break;
        default:
            CALC_INPUT.yeast.company = typeOrCompany;
            $( "#yeast_number" ).html( writeYeastOptions() );
    }
}

/**
 * Nullifies other CALC_INPUT entries when the type of ingredient is changed
 * by selecting a radio button.
 */
function ingredientNullify( ingredient ) {
    var ingType = removeLastChar( ingredient );
    switch ( ingType ) {
        case "extract":
            CALC_INPUT[ingredient].name = null;
            CALC_INPUT[ingredient].amount = null;
            CALC_INPUT[ingredient].end = false;
            break;
        case "grain":
            CALC_INPUT[ingredient].name = null;
            CALC_INPUT[ingredient].amount = null;
            break;
        case "hop":
            CALC_INPUT[ingredient].name = null;
            CALC_INPUT[ingredient].amount = null;
            CALC_INPUT[ingredient].time = null;
            break;
    }
}

/*******************************************************************************
 * END RADIO BUTTON LOGIC                                                      *
 ******************************************************************************/

/*******************************************************************************
 * SELECTION LIST LOGIC                                                        *
 ******************************************************************************/

/**
 * Parses the type of selection made and calls the proper functions.
 */
function parseSelect( id ) {
    switch ( id ) {
        case "recipes": chooseRecipe( $( "#recipes" ).val() );          break;
        case "cat":     writeBJCPsubcats( $( "#cat" ).val() );          break;
        case "subcat":  writeBJCPinfo( $( "#subcat" ).val() );          break;
        case "yeast_number": 
            CALC_INPUT.yeast.number = $( "#yeast_number" ).val();        break;
        default:
            var ingredient = id.split("_")[0];
            var value = $( "#" + id ).val();
            ingredientSelect( ingredient, value );
    }
}

/**
 * Sets CALC_INPUT[ingredient].name, then initializes .amount (and .time for hops)
 */
function ingredientSelect( ingredient, value ) {
    if ( ingredient == "extract1" && CALC_INPUT.recipe.volTotal == null ) {
        firstSelection( true );
    }
    CALC_INPUT[ingredient].name = value;
    if ( CALC_INPUT[ingredient].amount == null ) {
        var ingType = removeLastChar( ingredient );
        switch ( ingType ) {
            case "extract": initializeExtract( ingredient );            break;
            case "grain":   initializeGrain( ingredient );              break;
            case "hop":     initializeHop( ingredient );                break;
        }
    }
}

/**
 * Gets called when extract1 is selected AND volTotal is null.  The only time
 * this happens is the FIRST time extract1 is selected after the page loads.
 * It makes the grain1, hop1, and yeast fields visible. It also initializes
 * volTotal, volBoil, and timeBoil if told to do so.
 */
function firstSelection( setCALC_INPUT ) {
    if ( setCALC_INPUT ) {
        CALC_INPUT.recipe.volTotal = 5.0;
        CALC_INPUT.recipe.volBoil  = 3.0;
        CALC_INPUT.recipe.timeBoil = 60;
        $( "#volTotal" ).val( CALC_INPUT.recipe.volTotal );
        $( "#volBoil"  ).val( CALC_INPUT.recipe.volBoil );
        $( "#timeBoil" ).val( CALC_INPUT.recipe.timeBoil );
    }

    //make grain1, hop1, and yeast containers visible
    $( "#grain1" ).fadeTo( 0, 0 ).css( "display","table" ).fadeTo( 500, 1 );
    $( "#hop1"   ).fadeTo( 0, 0 ).css( "display","table" ).fadeTo( 500, 1 );
    $( "#yeast"  ).fadeTo( 0, 0 ).css( "display","table" ).fadeTo( 500, 1 );
}

/**
 * Sets initial value for extract amount in CALC_INPUT
 */
function initializeExtract( ingredient ) {
    var index = CALC_INPUT[ingredient].name;
    switch ( INGREDIENTS.extract[index].type ) {
        case "Liquid":
            CALC_INPUT[ingredient].amount =
            Math.round( (6 * (CALC_INPUT.recipe.volTotal / 5)) * 10 ) / 10;
            break;
        case "Powder":
            CALC_INPUT[ingredient].amount =
            Math.round( (1 * (CALC_INPUT.recipe.volTotal / 5)) * 10 ) / 10;
            break;
    }
    $( "#" + ingredient + "_amount" ).val( CALC_INPUT[ingredient].amount );
}

/**
 * Sets initial value for grain amount in CALC_INPUT
 */
function initializeGrain( ingredient ) {
    var index = CALC_INPUT[ingredient].name;
    switch ( INGREDIENTS.grain[index].type ) {
        case "Kilned": case "Caramel":
            CALC_INPUT[ingredient].amount =
            Math.round( (0.5 * (CALC_INPUT.recipe.volTotal / 5)) * 100 ) / 100;
            break;
        case "Roasted":
            CALC_INPUT[ingredient].amount =
            Math.round( (0.25 * (CALC_INPUT.recipe.volTotal / 5)) * 100 ) / 100;
            break;
    }
    $( "#" + ingredient + "_amount" ).val( CALC_INPUT[ingredient].amount );
}

/**
 * Sets initial value for hop amount and time in CALC_INPUT
 */
function initializeHop( ingredient ) {
    var index = CALC_INPUT[ingredient].name;
    switch ( INGREDIENTS.hop[index].type ) {
        case "Bittering":
            CALC_INPUT[ingredient].amount =
            Math.round( (1.0 * (CALC_INPUT.recipe.volTotal / 5)) * 100 ) / 100;
            CALC_INPUT[ingredient].time = 60;
            break;
        case "Dual":
            CALC_INPUT[ingredient].amount =
            Math.round( (1.0 * (CALC_INPUT.recipe.volTotal / 5)) * 100 ) / 100;
            CALC_INPUT[ingredient].time = 30;
            break;
        case "Aroma":
            CALC_INPUT[ingredient].amount =
            Math.round( (1.0 * (CALC_INPUT.recipe.volTotal / 5)) * 100 ) / 100;
            CALC_INPUT[ingredient].time = 10;
            break;
    }
    $( "#" + ingredient + "_amount" ).val( CALC_INPUT[ingredient].amount );
    $( "#" + ingredient + "_time" ).val( CALC_INPUT[ingredient].time );
}

/*******************************************************************************
 * END SELECTION LIST LOGIC                                                    *
 ******************************************************************************/

/*******************************************************************************
 * RECIPE SELECTION LOGIC                                                      *
 ******************************************************************************/

/**
 * Handles recipe selection picklist.  Populates CALC_INPUT with chosen recipe
 * specifications, uses those to determine CALC_OUTPUT, and also selects the
 * appropriate BJCP category/subcategory.
 */
function chooseRecipe( recipe ) {
    // display BJCP info for recipe
    selectBJCP( recipe );

    // reset CALC_INPUT and CALC_OUTPUT
    initGlobals();
    CALC_INPUT = JSON.parse( JSON.stringify( RECIPES["cat" + recipe] ) );

    // reset HTML in recipe calculator
    writeBlankCalc();

    // populate form with CALC_INPUT and calculate CALC_OUTPUT
    CALC_INPUTtoForm();
    firstSelection( false );
    renderForm();
    calculate();
    displayCALC_OUTPUT();
}

/**
 * Selects correct BJCP category and subcategory for chosen recipe.
 */
function selectBJCP( recipe ) {
    var bjcpCat = recipe.substr( 0, recipe.length - 1 );
    writeBJCPsubcats( bjcpCat );
    $( "#cat" ).val( bjcpCat );

    var bjcpSubcat = recipe.substr( recipe.length - 1, 1 );
    writeBJCPinfo( bjcpSubcat );
    $( "#subcat" ).val( bjcpSubcat );
}

/**
 * Assigns CALC_INPUT values to the recipe form.  Writes new HTML for
 * additional ingredients as necessary.
 */
function CALC_INPUTtoForm() {
    for ( i in CALC_INPUT ) {
        if ( i == "recipe" ){
            recipeSpecsToForm();
        }
        else if ( i == "yeast" ) {
            yeastToForm();
        }
        else {
            var ingType = removeLastChar( i );
            var ingNum = Number( i.substr( i.length - 1, 1 ) );

            // add html for each additional ingredient
            if ( ingNum > 1 ) {
                addIngredient( ingType, ingNum, true );
            }

            ingredientToForm( i, ingType );
        }
    }
}

/**
 * Sets values in the recipe specs section of the calculator.
 */
function recipeSpecsToForm() {
    $( "#name"     ).val( $.parseHTML( CALC_INPUT.recipe.name )[0].textContent );
    $( "#volTotal" ).val( CALC_INPUT.recipe.volTotal );
    $( "#volBoil"  ).val( CALC_INPUT.recipe.volBoil );
    $( "#timeBoil" ).val( CALC_INPUT.recipe.timeBoil );
}

/**
 * Sets values in the yeast fields of the calculator.
 */
function yeastToForm() {
    switch ( CALC_INPUT.yeast.type ) {
        case "Ale":   $( "#yeast_ale"   ).prop( "checked", true );      break;
        case "Lager": $( "#yeast_lager" ).prop( "checked", true );      break;
    }
    switch ( CALC_INPUT.yeast.company ) {
        case "Wyeast Laboratories":
            $( "#yeast_wyeast" ).prop( "checked", true );
            break;
        case "White Labs":
            $( "#yeast_white"  ).prop( "checked", true ); 
            break;
    }
    $( "#yeast_number" ).html( writeYeastOptions() )
                        .val( CALC_INPUT.yeast.number );
}

function ingredientToForm( ingredient, ingType ) {
    // set values unique to each ingredient type
    switch ( ingType ) {
        case "extract":
            // set radio button
            if ( CALC_INPUT[ingredient].type == "Liquid" ) {
                $( "#" + ingredient + "_liquid" ).prop( "checked", true );
            }
            else {
                $( "#" + ingredient + "_powder" ).prop( "checked", true );
            }
            // set add at end of boil checkbox
            if ( CALC_INPUT[ingredient].end ) {
                $( "#" + ingredient + "_end" ).prop( "checked", true );
            }
            break;
        case "grain":
            // set radio button
            if ( CALC_INPUT[ingredient].type == "Kilned" ) {
                $( "#" + ingredient + "_kilned" ).prop( "checked", true );
            }
            else if ( CALC_INPUT[ingredient].type == "Caramel" ) {
                $( "#" + ingredient + "_caramel" ).prop( "checked", true );
            }
            else if ( CALC_INPUT[ingredient].type == "Roasted" ) {
                $( "#" + ingredient + "_roasted" ).prop( "checked", true );
            }
            break;
        case "hop":
            // set radio button
            if ( CALC_INPUT[ingredient].type == "Bittering" ) {
                $( "#" + ingredient + "_bittering" ).prop( "checked", true );
            }
            else if ( CALC_INPUT[ingredient].type == "Dual" ) {
                $( "#" + ingredient + "_dual" ).prop( "checked", true );
            }
            else {
                $( "#" + ingredient + "_aroma" ).prop( "checked", true );
            }
            // set boiling time
            $( "#" + ingredient + "_time" ).val( CALC_INPUT[ingredient].time );
            break;
    }
    // set values common to each ingredient type
    $( "#" + ingredient + "_name" )
        .html( writeOptions( ingType, CALC_INPUT[ingredient].type ) )
        .val( CALC_INPUT[ingredient].name );
    $( "#" + ingredient + "_amount" ).val( CALC_INPUT[ingredient].amount );
}

/*******************************************************************************
 * END RECIPE SELECTION LOGIC                                                  *
 ******************************************************************************/

/*******************************************************************************
 * CHECKBOX LOGIC                                                              *
 ******************************************************************************/

/**
 * TODO
 */
function parseCheckbox( box ) {
    var ingredient = box.split("_")[0];
    CALC_INPUT[ingredient].end = $( "#" + box )[0].checked;
}

/*******************************************************************************
 * END CHECKBOX LOGIC                                                          *
 ******************************************************************************/

/*******************************************************************************
 * ADD/REMOVE BUTTON LOGIC                                                     *
 ******************************************************************************/

/**
 * Calls functions to add or remove an ingredient from the recipe form.
 */
function parseButton( value ) {
    var str = value.split("_");
    switch ( str[2] ) {
        case "add":
            addIngredient( str[0], Number( str[1] ), false );
            break;
        case "remove":
            removeIngredient( str[0], Number( str[1] ) );
            renderForm();
            calculate();
            displayCALC_OUTPUT();
            break;
    }
}

/**
 * Calls functions which insert new CALC_INPUT/OUTPUT indexes for a new
 * ingredient, and which write html in the form for that ingredient.
 */
function addIngredient( ingType, num, loadRecipe ) {
    switch ( ingType ) {
        case "extract":
            addExtract( num, loadRecipe );
            $( "#extract" + num ).html( writeExtract( num ) )
                                 .after( writeButton( "extract", num ) );
            break;
        case "grain":
            addGrain( num, loadRecipe );
            $( "#grain" + num ).html( writeGrain( num ) )
                               .after( writeButton( "grain", num ) );
            break;
        case "hop":
            addHop( num, loadRecipe );
            $( "#hop" + num ).html( writeHop( num ) )
                             .after( writeButton( "hop", num ) );
            break;
    }
}

function removeIngredient( ingType, num ) {
    var ingredient = ingType + num;
    var dom = ingType + (num + 1);
    delete CALC_INPUT[ingredient];
    delete CALC_OUTPUT[ingredient];
    $( "#" + dom ).remove();
    $( "#" + ingredient ).replaceWith( writeButton( ingType, num - 1 ) );
}

/*******************************************************************************
 * FORM FIELD VISIBILITY FUNCTIONS                                             *
 ******************************************************************************/

/**
 * Loops through CALC_INPUT.  Depending on the state of selected variables, it
 * makes elements of the calculator visible/hidden or enabled/disabled.
 */
function renderForm() {
    for ( i in CALC_INPUT ) {
        switch ( i ) {
            case "recipe":
                renderRecipeSpecs();
                break;
            case "yeast":
                renderYeast();
                break;
            default:
                renderIngredient( i );
        }
    }
    if ( CALC_INPUT.extract1.name == null || 
         CALC_INPUT.hop1.name     == null ||
         CALC_INPUT.yeast.number  == null    ) {
        hideSubmit();
    }
    else {
        showSubmit();
    }
}

function renderRecipeSpecs() {
    if ( CALC_INPUT.recipe.volTotal == null ) {
        //recipe specs hidden
        if ( $( "#recipeSpecs" ).css( "display" ) == "table" ) {
            $( "#recipeSpecs" ).fadeTo( 500, 0, function() {
                $( this ).css( "display","none" );
            });
        }
    }
    else {
        //recipe specs shown
        if ( $( "#recipeSpecs" ).css( "display" ) == "none" ) {
            $( "#recipeSpecs" ).fadeTo( 0, 0 )
                               .css( "display","table" )
                               .fadeTo( 500, 1 );
        }
    }
}

function renderYeast() {
    if ( CALC_INPUT.yeast.type == null ) {
        //yeast_company radios disabled
        $( ".yeast_company:enabled" ).prop( "disabled", true );
        $( ".yeast_company_text" ).css( "color", "gray" );
    }
    else {
        //yeast_company radios enabled
        $( ".yeast_company:disabled" ).prop( "disabled", false );
        $( ".yeast_company_text" ).css( "color", "#333" );
    }
    if ( CALC_INPUT.yeast.company == null ) {
        //yeast_number hidden
        if ( $( "#yeast_number" ).css( "visibility" ) == "visible" ) {
            $( "#yeast_number" ).fadeTo( 500, 0, function() {
                $( this ).css( "visibility","hidden" );
            });
        }
    }
    else {
        //yeast_number visible
        if ( $( "#yeast_number" ).css( "visibility" ) == "hidden" ) {
            $( "#yeast_number" ).fadeTo( 0, 0 )
                                .css( "visibility","visible" )
                                .fadeTo( 500, 1 );
        }
    }
}

function renderIngredient( ingredient ) {
    if ( CALC_INPUT[ingredient].type == null ) {
        //ingredient_name disabled
        $( "#" + ingredient + "_name:enabled" ).prop( "disabled", true );
    }
    else {
        //ingredient_name enabled
        $( "#" + ingredient + "_name:disabled" ).prop( "disabled", false );
    }

    var nextIng = setIndex( ingredient ) + ( Number( ingredient.slice( -1 ) ) + 1 );

    if ( CALC_INPUT[ingredient].name == null ) {
        //ingredient_state hidden
        if ( $( "#" + ingredient + "_state" ).css( "visibility" ) == "visible" ) {
            $( "#" + ingredient + "_state" ).fadeTo( 500, 0, function () {
                $( this ).css( "visibility", "hidden" );
            });
        }
        //next ingredient add button hidden
        if ( $( "#" + nextIng + "_add" ).css( "display" ) == "inline-block" ) {
            $( "#" + nextIng + "_add" ).fadeTo( 500, 0, function () {
                $( this ).css( "display", "none" );
            });
        }
    }
    else {
        //ingredient_state visible
        if ( $( "#" + ingredient + "_state" ).css( "visibility" ) == "hidden" ) {
            $( "#" + ingredient + "_state" ).fadeTo( 0, 0 )
                                            .css( "visibility", "visible" )
                                            .fadeTo( 500, 1 );
        }
        //next ingredient add button visible
        if ( $( "#" + nextIng + "_add" ).css( "display" ) == "none" ) {
            $( "#" + nextIng + "_add" ).fadeTo( 0, 0 )
                                       .css( "display", "inline-block" )
                                       .fadeTo( 500, 1 );
        }
    }
}

function hideSubmit() {
    if ( $( "#submit" ).css( "visibility" ) == "visible" ) {
        $( "#submit" ).fadeTo( 500, 0, function() {
            $( this ).css( "visibility", "hidden" );
        });
    }
}

function showSubmit() {
    if ( $( "#submit" ).css( "visibility" ) == "hidden" ) {
        $( "#submit" ).fadeTo( 0, 0 ).css( "visibility", "visible" ).fadeTo( 500, 1 );
    }
}

/*******************************************************************************
 * END FORM FIELD VISIBILITY FUNCTIONS                                         *
 ******************************************************************************/

/*******************************************************************************
 * NUMBER FIELDS HANDLING FUNCTIONS                                            *
 ******************************************************************************/

/**
 * Logic for setting values of CALC_INPUT from number fields. 
 *  id - id of field in recipe form
 *  round - inverse rounding factor (1 for x, 10 for 0.x, 100 for 0.0x)
 */
function assignNumber( id, round, write ) {
    var previous = CALC_INPUTnumLookup( id );
    var current = Math.round( Number( $( "#" + id ).val() * round )) / round;
    if ( previous != current && current > 0 ) {
        CALC_INPUTnumSet( id, current, false );
    }
    else if ( previous != current && id.split("_")[1] == "time" ) {
        CALC_INPUTnumSet( id, current, false );
    }
    if ( write ) {
        $( "#" + id ).val( CALC_INPUTnumLookup( id ) );
        console.log("writing value");
    }
}

/**
 * Takes the id of a form field number input and returns the value 
 * for that field stored in CALC_INPUT.
 */
function CALC_INPUTnumLookup( numId ) {
    var id = numId.split("_");
    if ( id.length == 1 ) {
        return CALC_INPUT.recipe[numId];
    }
    else {
        return CALC_INPUT[ id[0] ][ id[1] ];
    }
}

/**
 * Assigns the number entered in a form field to the appropriate index
 * in CALC_INPUT.
 */
function CALC_INPUTnumSet( numId, value, write ) {
    var id = numId.split("_");
    if ( id.length == 1 ) {
        CALC_INPUT.recipe[numId] = value;
    }
    else {
        CALC_INPUT[ id[0] ][ id[1] ] = value;
    }
    if ( write ) {
        $( "#" + numId ).val( value );
        console.log("writing value");
    }
}

/**
 * Sets total volume and boil volume. When total volume goes up, boil volume
 * goes up proportionally.  When total volume goes down, boil volume doesn't
 * change unless it's greater than total.
 */
function setVolumes( write ) {
    var prevVolTotal = CALC_INPUTnumLookup( "volTotal" );
    var prevVolBoil  = CALC_INPUTnumLookup( "volBoil" );
    assignNumber( "volTotal", 10, write );
    var volTotal = CALC_INPUTnumLookup( "volTotal" );

    if ( volTotal > prevVolTotal ) {
        // proportionally increase boil volume
        var volBoil = Math.round( prevVolBoil * (volTotal / prevVolTotal) * 10 ) / 10;
        CALC_INPUTnumSet( "volBoil", volBoil, true );
    }
    else if ( volTotal < prevVolBoil ) {
        CALC_INPUTnumSet( "volBoil", volTotal, true );
    }
}

/**
 * Makes sure volBoil is never greater than volTotal.  If volBoil is set higher
 * than volTotal, volTotal is adjusted.
 */
function setVolBoil( write ) {
    var changeVolTotal = false;
    assignNumber( "volBoil", 10, write );
    var volBoil  = CALC_INPUTnumLookup( "volBoil" );
    var prevVolTotal = CALC_INPUTnumLookup( "volTotal" );

    if ( volBoil > prevVolTotal ) {
        CALC_INPUTnumSet( "volTotal", volBoil, true );
        changeVolTotal = true;
    }
    return changeVolTotal;
}

/*******************************************************************************
 * END NUMBER FIELDS HANDLING FUNCTIONS                                        *
 ******************************************************************************/

/*******************************************************************************
 * CALC_OUTPUT HANDLING FUNCTIONS                                              *
 ******************************************************************************/

/**
 * Loops through CALC_INPUT, and uses CALC_INPUT values to set CALC_OUTPUT values.
 */
function calculate() {
    // nullify values in CALC_OUTPUT.recipe, as new ones will be calculated
    resetTotals();

    // first calculate gravity and malt color units
    calcGravityMCU();

    // next calculate recipe totals
    calcTotals();

    // finally calculate ibu
    calcIBU();
}

/**
 * When the total volume is changed, the amounts of all the ingredients are
 * adjusted so the overall recipe gravity and ibus are unchanged.
 */
function adjustAmounts() {
    adjustMaltAmounts();
    resetTotals();
    calcGravityMCU();
    calcTotals();
    adjustHopAmounts();
    calcIBU();
}

/**
 * When total volume changes, adjust amounts of each malt ingredient to maintain
 * each ingredient's specific gravity.
 */
function adjustMaltAmounts() {
    for ( i in CALC_INPUT ) {
        var ingType = removeLastChar( i );
        var index = CALC_INPUT[i].name;
        if ( ingType == "extract" && index != null ) {
            var ppg = INGREDIENTS.extract[index].ppg;
            var amount = CALC_INPUT[i].amount;
            var target = Math.round( CALC_OUTPUT[i].points * 1000 ) / 1000;
            CALC_INPUT[i].amount = adjustExtract( ppg, amount, target );
            $( "#" + i + "_amount" ).val( CALC_INPUT[i].amount );
        }
        else if ( ingType == "grain" && index != null ) {
            var fgdb = INGREDIENTS.grain[index].fgdb;
            var mc = INGREDIENTS.grain[index].mc;
            var amount = CALC_INPUT[i].amount;
            var target = Math.round( CALC_OUTPUT[i].points * 2000 ) / 2000;
            CALC_INPUT[i].amount = adjustGrain( fgdb, mc, amount, target );
            $( "#" + i + "_amount" ).val( CALC_INPUT[i].amount );
        }
    }
}

/**
 * When total volume changes, recursively adjusts extract amount to target
 * specific gravity.
 */
function adjustExtract( ppg, amount, target ) {
    var pts = Math.round( points( ppg, amount, CALC_INPUT.recipe.volTotal ) * 1000 ) / 1000;
    if ( pts == target ) {
        return Math.round( amount * 100 ) / 100;
    }
    else {
        var newAmount = amount * (target / pts);
        return adjustExtract( ppg, newAmount, target );
    }
}

/**
 * When total volume changes, recursively adjusts grain amount to target
 * specific gravity.
 */
function adjustGrain( fgdb, mc, amount, target ) {
    var ppg = fgdbToPPG( fgdb, mc );
    var pts = Math.round( points( ppg, amount, CALC_INPUT.recipe.volTotal ) * 2000 ) / 2000;
    if ( pts == target ) {
        return Math.round( amount * 200 ) / 200;
    }
    else {
        var newAmount = amount * (target / pts);
        return adjustGrain( fgdb, mc, newAmount, target );
    }
}

/**
 * When total volume changes, adjust the amount of each hop ingredient to
 * maintain that ingredient's bitterness.
 */
function adjustHopAmounts() {
    for ( i in CALC_INPUT ) {
        var ingType = removeLastChar( i );
        var index = CALC_INPUT[i].name;
        if ( ingType == "hop" && index != null ) {
            var alpha = INGREDIENTS.hop[index].meanAlpha;
            var time = CALC_INPUT[i].time
            var amount = CALC_INPUT[i].amount;
            var target = CALC_OUTPUT[i].ibu;
            CALC_INPUT[i].amount = adjustHop( alpha, time, amount, target );
            $( "#" + i + "_amount" ).val( CALC_INPUT[i].amount );
        }
    }
}

/**
 * When total volume changes, recursively adjusts hop amount to target ibu.
 */
function adjustHop( alpha, time, amount, target ) {
    var util = utilization( CALC_OUTPUT.recipe.bg, time );
    var bitter = ibu( amount, alpha, CALC_INPUT.recipe.volTotal, util );
    if ( bitter == target ) {
        return Math.round( amount * 200 ) / 200;
    }
    else {
        var newAmount = amount * (target / bitter);
        return adjustHop( alpha, time, newAmount, target );
    }
}

/**
 * Calculates original gravity, boil gravity, and mcu for the recipe.
 */
function calcGravityMCU() {
    for ( i in CALC_INPUT ) {
        var ingType = removeLastChar( i );
        var index = CALC_INPUT[i].name;
        if ( ingType == "extract" && index != null ) {
            calcExtract( INGREDIENTS.extract[index].ppg,
                         INGREDIENTS.extract[index].lovibond,
                         i                                    );
        }
        else if ( ingType == "grain" && index != null ) {
            calcGrain( INGREDIENTS.grain[index].fgdb,
                       INGREDIENTS.grain[index].mc,
                       INGREDIENTS.grain[index].lovibond,
                       i                                  );
        }
    }
}

/**
 * Calculates total recipe original gravity, boil gravity, and lovibond from
 * total recipe points, boil points, and mcu respectively.
 * 
 * NOTE: Total ibu is the simple sum of individual ingredient ibus.  Boil gravity
 * needs to be established before hop utilization can be calculated.
 */
function calcTotals() {
    if ( CALC_OUTPUT.recipe.points != null ) {
        CALC_OUTPUT.recipe.og = pointsToSG( CALC_OUTPUT.recipe.points );
    }
    if ( CALC_OUTPUT.recipe.boilPts != null ) {
        CALC_OUTPUT.recipe.bg = pointsToSG( CALC_OUTPUT.recipe.boilPts );
    }
    if ( CALC_OUTPUT.recipe.mcu != null ) {
        CALC_OUTPUT.recipe.lovibond = morey( CALC_OUTPUT.recipe.mcu );
    }
}

/**
 * Calculates IBUs for the recipe.
 */
function calcIBU() {
    for ( i in CALC_INPUT ) {
        var ingType = removeLastChar( i );
        var index = CALC_INPUT[i].name;
        if ( ingType == "hop" && index != null ) {
            calcHop( INGREDIENTS.hop[index].meanAlpha, i );
        }
    }
}

/**
 * Reset total recipe values in CALC_OUTPUT.
 */
function resetTotals() {
    for ( i in CALC_OUTPUT.recipe ) {
        CALC_OUTPUT.recipe[i] = null;
    }
}

/**
 * Calculates points, original gravity, boil points, and malt color units (mcu) 
 * for a malt extract.  Counts points, boil points, and mcu for total recipe.
 */
function calcExtract( ppg, lovibond, index ) {
    // calculate ingredient values
    CALC_OUTPUT[index].points = points( ppg,
                                        CALC_INPUT[index].amount,
                                        CALC_INPUT.recipe.volTotal );
    CALC_OUTPUT[index].og = pointsToSG( CALC_OUTPUT[index].points );
    if ( !CALC_INPUT[index].end ) {
        CALC_OUTPUT[index].boilPts = points( ppg,
                                             CALC_INPUT[index].amount,
                                             CALC_INPUT.recipe.volBoil );
    }
    CALC_OUTPUT[index].mcu = mcu( lovibond,
                                  CALC_INPUT[index].amount,
                                  CALC_INPUT.recipe.volTotal );
    // tabulate total recipe values
    CALC_OUTPUT.recipe.points += CALC_OUTPUT[index].points;
    if ( !CALC_INPUT[index].end ) {
        CALC_OUTPUT.recipe.boilPts += CALC_OUTPUT[index].boilPts;
    }
    CALC_OUTPUT.recipe.mcu += CALC_OUTPUT[index].mcu;
}

/**
 * Calculates points, original gravity, boil points, and malt color units (mcu) 
 * for a specialty grain.  Counts points, boil points, and mcu for total recipe.
 */
function calcGrain( fgdb, mc, lovibond, index ) {
    var ppg = fgdbToPPG( fgdb, mc );

    // calculate ingredient values
    CALC_OUTPUT[index].points = points( ppg,
                                        CALC_INPUT[index].amount,
                                        CALC_INPUT.recipe.volTotal );
    CALC_OUTPUT[index].og = pointsToSG( CALC_OUTPUT[index].points );
    CALC_OUTPUT[index].boilPts = points( ppg,
                                         CALC_INPUT[index].amount,
                                         CALC_INPUT.recipe.volBoil );
    CALC_OUTPUT[index].mcu = mcu( lovibond,
                                  CALC_INPUT[index].amount,
                                  CALC_INPUT.recipe.volTotal );

    // tabulate total recipe values
    CALC_OUTPUT.recipe.points += CALC_OUTPUT[index].points;
    CALC_OUTPUT.recipe.boilPts += CALC_OUTPUT[index].boilPts;
    CALC_OUTPUT.recipe.mcu += CALC_OUTPUT[index].mcu;
}

/**
 * Calculates the international bitterness units (ibu) for each hop, and
 * counts total ibu for the recipe.
 */
function calcHop( alpha, index ) {
    // calculate ingredient values
    var util = utilization( CALC_OUTPUT.recipe.bg, CALC_INPUT[index].time );
    CALC_OUTPUT[index].ibu = ibu( CALC_INPUT[index].amount,
                                  alpha,
                                  CALC_INPUT.recipe.volTotal,
                                  util                       );
    // tabulate total recipe value
    CALC_OUTPUT.recipe.ibu += CALC_OUTPUT[index].ibu;
}

/**
 * Loops through CALC_OUTPUT and displays the values on recipe form.
 */
function displayCALC_OUTPUT() {
    for ( i in CALC_OUTPUT ) {
        var ingType = removeLastChar(i);
        if ( i == "recipe" ) {
            $( "#og" ).val( CALC_OUTPUT[i].og );
            $( "#ibu" ).val( CALC_OUTPUT[i].ibu );
            if ( CALC_OUTPUT[i].mcu != null ) {
                $( "#lovibond" ).val( CALC_OUTPUT[i].lovibond )
                                .css({
                                    "background-color":LOVIBOND[CALC_OUTPUT[i].lovibond],
                                    "color":"white"
                                });
            }
            else {
                $( "#lovibond" ).val( "" )
                                .css({
                                    "background-color":"#EEE",
                                    "color":"#555"
                                });
            }
        }
        else if ( ingType == "extract" || ingType == "grain" ) {
            $( "#" + i + "_mcu" ).val( CALC_OUTPUT[i].mcu );
            $( "#" + i + "_og" ).val( CALC_OUTPUT[i].og );
        }
        else if ( ingType == "hop" ) {
            $( "#" + i + "_ibu" ).val( CALC_OUTPUT[i].ibu );
        }
    }
}

/*******************************************************************************
 * END CALC_OUTPUT HANDLING FUNCTIONS                                          *
 ******************************************************************************/
