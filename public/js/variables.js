/**
 * variables.js
 * 
 * Global variables used in the recipe calculator.  
 */

/**
 * Array containing hexadecimal color codes for different colors on the Lovibond
 * scale.  array index number is respective Lovibond scale color. 
 */
var LOVIBOND = [ "#FFFFFF",
    "#FEE799", "#FDD978", "#FDC953", "#FCC143", "#F7B324",
    "#F7B324", "#EE9E01", "#E69100", "#E38901", "#DA7E01",
    "#D37400", "#CB6C00", "#C66401", "#BF5C01", "#B65300",
    "#B04F00", "#AC4701", "#A24001", "#9C3900", "#963500",
    "#912F00", "#8C2D01", "#832501", "#7E1F01", "#771C01",
    "#721B00", "#6C1501", "#670F01", "#620F01", "#5B0D01",
    "#560C03", "#520B05", "#500A08", "#4A0605", "#440706",
    "#420807", "#3C0908", "#390708", "#39080B", "#35090A",
    "#30090A", "#2A0809", "#260808", "#230706", "#1E0606",
    "#190506", "#140404", "#0F0303", "#060203", "#000000"
];

// make ajax call to get the entire beer ingredients database into a json object
var INGREDIENTS = [];

$.ajax({
    type:     'GET',
    url:      'ajax/ingredients_to_json.php',
    dataType: 'json',
    async:    false, 
    success:  function(data) {
        INGREDIENTS = data;
    }
});

/**
 * Takes an ingredient type from the DOM id values and returns the index of that 
 * ingredient category in the INGREDIENTS object.
 */
function setIndex( ingredient ) {
    if ( ingredient == "yeast" ) {
        return ingredient;
    }
    else {
        return removeLastChar( ingredient );
    }
}

/**
 * Template for global variable for input fields in the recipe calculator.
 * As ingredient fields are added, more indexes will be added to CALC_INPUT.
 * NOTE: State of visibilty/hidden or enabled/disabled is determined by the
 * following variables:
 *   - recipe.volTotal:
 *      null - recipeSpecs hidden
 *      else - recipeSpecs visible
 *   - {extract,grain,hop}.type:
 *      null - {extract,grain,hop}_name selects disabled
 *      else - {extract,grain,hop}_name selects enabled
 *   - {extract,grain,hop}.name:
 *      null - {extract,grain,hop}_state fields hidden
 *             {extract,grain,hop}+1 add button hidden
 *      else - {extract,grain,hop}_state fields visible
 *             {extract,grain,hop}+1 add button visible
 *   - yeast.type:
 *      null - yeast_company radios disabled
 *      else - yeast_company radios enabled
 *   - yeast.company:
 *      null - yeast_number select hidden
 *      else - yeast_number select visible
 *   - extract1.name || hop1.name || yeast.number:
 *      null - submit button hidden
 *      else - submit button visible
 */
var CALC_INPUTtemplate = {
    recipe: {
        name:     null, 
        volTotal: null, // gallons
        volBoil:  null, // gallons
        timeBoil: null  // minutes
    },
    extract1: {
        type:   null,
        name:   null,
        amount: null,   // pounds
        end:    false
    },
    grain1: {
        type:   null,
        name:   null,
        amount: null    // pounds
    },
    hop1: {
        type:   null,
        name:   null,
        amount: null,   // ounces
        time:   null    // minutes
    },
    yeast: {
        type:    null,
        company: null,
        number:  null
    }
};

var CALC_INPUT = {};

// initialize global for all calculated values in recipe calculator
var CALC_OUTPUTtemplate = {
    recipe: {
        points:     null,
        og:         null,
        boilPts:    null,
        bg:         null,
        mcu:        null,
        lovibond:   null,
        ibu:        null
    },
    extract1: { points: null, og: null, boilPts: null, mcu: null },
    grain1:   { points: null, og: null, boilPts: null, mcu: null },
    hop1:     { ibu: null },
};

var CALC_OUTPUT = {};

function initGlobals() {
    CALC_INPUT = CALC_INPUTtemplate;
    CALC_OUTPUT = CALC_OUTPUTtemplate;
}

/**
 * Initializes global variables when a new extract is added to a recipe.
 */
function addExtract( num, loadRecipe ) {
    var index = "extract" + num;
    if ( !loadRecipe ) {
        CALC_INPUT[index] = { type: null, name: null, amount: null, end: false };
    }
    CALC_OUTPUT[index] = { points: null, og: null, boilPts: null, mcu: null };
}

function addGrain( num, loadRecipe ) {
    var index = "grain" + num;
    if ( !loadRecipe ) {
        CALC_INPUT[index] = { type: null, name: null, amount: null };
    }
    CALC_OUTPUT[index] = { points: null, og: null, boilPts: null, mcu: null };
}

function addHop( num, loadRecipe ) {
    var index = "hop" + num;
    if ( !loadRecipe ) {
        CALC_INPUT[index] = { type: null, name: null, amount: null, time: null };
    }
    CALC_OUTPUT[index] = { ibu: null };
}
