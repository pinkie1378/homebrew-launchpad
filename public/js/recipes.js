/**
 * recipes.js
 * 
 * beer recipes stored in json array format.  The structure of each element 
 * matches the CALC_INPUT global variable in variables.js.
 */

var RECIPES = {
    cat2B: {
        recipe: {
            name: "Bohemian Pilsener (2B)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Pilsen Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Pilsen Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:    null,
            name:    null,
            amount:  null
        },
        hop1: {
            type:   "Dual",
            name:   "Perle",
            amount:  1,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Saaz",
            amount:  0.75,  // ounces
            time:    30   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Saaz",
            amount:  0.75,  // ounces
            time:    15   // minutes
        },
        yeast: {
            type:    "Lager",
            company: "Wyeast Laboratories",
            number:  "2001" 
        }
    },
    cat3A: {
        recipe: {
            name:    "Vienna Lager (3A)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Vienne 20L",
            amount:  0.25   // pounds
        },
        grain2: {
            type:   "Caramel",
            name:   "Caramel Malt 90L",
            amount:  0.5   // pounds
        },
        grain3: {
            type:   "Roasted",
            name:   "Black Malt",
            amount:  0.2   // pounds
        },
        hop1: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  1,  // ounces
            time:    40   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  1,  // ounces
            time:    20   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  1,  // ounces
            time:    10   // minutes
        },
        yeast: {
            type:    "Lager",
            company: "White Labs",
            number:  "WLP820"
        }
    },
    cat3B: {
        recipe: {
            name:    "Oktoberfest/M&auml;rzen (3B)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Munich",
            name:   "Bonlander Munich Malt 10L",
            amount:  1   // pounds
        },
        grain2: {
            type:   "Caramel",
            name:   "Caramel Munich 60L",
            amount:  0.5   // pounds
        },
        grain3: {
            type:   "Caramel",
            name:   "Caramel Malt 80L",
            amount:  0.5   // pounds
        },
        hop1: {
            type:   "Aroma",
            name:   "Tettnang",
            amount:  1,  // ounces
            time:    40   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  1,  // ounces
            time:    20   // minutes
        },
        yeast: {
            type:    "Lager",
            company: "White Labs",
            number:  "WLP820"
        }
    },
    cat5B: {
        recipe: {
            name:    "Traditional Bock (5B)", 
            volTotal: 5,     // gallons
            volBoil:  3,     // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Powder",
            name:   "Golden Light DME",
            amount: 3,    // pounds
            end:    false
        },
        extract2: {
            type:   "Powder",
            name:   "Golden Light DME",
            amount: 4,   // pounds
            end:    true
        },
        grain1: {
            type:   "Munich",
            name:   "Aromatic Munich Malt 20L",
            amount:  1.5   // pounds
        },
        grain2: {
            type:   "Caramel",
            name:   "Caramel Malt 20L",
            amount:  1.5   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Perle",
            amount:  0.75,  // ounces
            time:    60     // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Tettnang",
            amount:  0.75,  // ounces
            time:    10     // minutes
        },
        yeast: {
            type:    "Lager",
            company: "Wyeast Laboratories",
            number:  "2206"
        }
    },
    cat6D: {
        recipe: {
            name:    "American Wheat (6D)", 
            volTotal: 5,      // gallons 
            volBoil:  3,      // gallons
            timeBoil: 60      // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Wheat Malt Syrup",
            amount:  3.3,     // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Wheat Malt Syrup",
            amount:  3.3,    // pounds
            end:     true
        },
        grain1: {
            type:   null,
            name:   null,
            amount: null
        },
        hop1: {
            type:   "Aroma",
            name:   "Sterling",
            amount:  0.5,   // ounces
            time:    60     // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  0.75,  // ounces
            time:    30     // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Liberty",
            amount:  1,     // ounces
            time:    10     // minutes
        },
        yeast: {
            type:    "Ale",
            company: "Wyeast Laboratories",
            number:  "1010"
        }
    },
    cat7B: {
        recipe: {
            name:    "California Common (7B)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60      // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        /*extract3: {
            type:   "Powder",
            name:   "maltodextrin",
            amount:  0.25,   // pounds
            end:     false
        },*/
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 40L",
            amount:  1   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Northern Brewer",
            amount:  1,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Dual",
            name:   "Northern Brewer",
            amount:  1,  // ounces
            time:    15   // minutes
        },
        yeast: {
            type:    "Lager",
            company: "Wyeast Laboratories",
            number:  "2112"
        }
    },
    cat8C: {
        recipe: {
            name:    "Extra Special Bitter (8C)", 
            volTotal: 5,      // gallons 
            volBoil:  3,      // gallons
            timeBoil: 60      // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Maris Otter Malt Syrup",
            amount:  3.3,   // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Maris Otter Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 60L",
            amount:  0.5     // pounds
        },
        hop1: {
            type:   "Bittering",
            name:   "Brewer's Gold",
            amount:  0.5,   // ounces
            time:    60     // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Golding",
            amount:  0.75,  // ounces
            time:    30     // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Golding",
            amount:  0.75,  // ounces
            time:    15     // minutes
        },
        yeast: {
            type:    "Ale",
            company: "Wyeast Laboratories",
            number:  "1099"
        }
    },
    cat10A: {
        recipe: {
            name:    "American Pale Ale (10A)", 
            volTotal: 5,     // gallons
            volBoil:  3,     // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 60L",
            amount:  0.5   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Northern Brewer",
            amount:  0.5,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Cascade",
            amount:  0.5,  // ounces
            time:    30   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Cascade",
            amount:  1,  // ounces
            time:    15   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "White Labs",
            number:  "WLP001"
        }
    },
    cat10B: {
        recipe: {
            name:    "American Amber Ale (10B)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 60L",
            amount:  2   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Centennial",
            amount:  0.5,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Mt. Hood",
            amount:  1,  // ounces
            time:    30   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Willamette",
            amount:  1,  // ounces
            time:    15   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "Wyeast Laboratories",
            number:  "1332"
        }
    },
    cat10C: {
        recipe: {
            name:    "American Brown Ale (10C)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Amber Malt Syrup",
            amount: 3.3,    // pounds
            end:    false
        },
        extract2: {
            type:   "Liquid",
            name:   "Amber Malt Syrup",
            amount: 3.3,   // pounds
            end:    true
        },
        grain1: {
            type:   "Roasted",
            name:   "Chocolate Malt",
            amount:  0.25   // pounds
        },
        hop1: {
            type:   "Bittering",
            name:   "Nugget",
            amount:  0.5,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Willamette",
            amount:  0.5,  // ounces
            time:    15   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "White Labs",
            number:  "WLP013"
        }
    },
    cat12A: {
        recipe: {
            name:    "Brown Porter (12A)", 
            volTotal: 5,      // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  3.3,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 60L",
            amount:  0.5   // pounds
        },
        grain2: {
            type:   "Roasted",
            name:   "Chocolate Malt",
            amount:  0.5   // pounds
        },
        grain3: {
            type:   "Roasted",
            name:   "Black Malt",
            amount:  0.25   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Horizon",
            amount:  0.5,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Willamette",
            amount:  0.75,  // ounces
            time:    40   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Willamette",
            amount:  0.5,  // ounces
            time:    20   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "Wyeast Laboratories",
            number:  "1056"
        }
    },
    cat13A: {
        recipe: {
            name:    "Dry Stout (13A)", 
            volTotal: 5,     // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  6,    // pounds
            end:     false
        },
        grain1: {
            type:   "Roasted",
            name:   "Roasted Barley",
            amount:  1   // pounds
        },
        hop1: {
            type:   "Dual",
            name:   "Cluster",
            amount:  2,  // ounces
            time:    60   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "Wyeast Laboratories",
            number:  "1084"
        }
    },
    cat14A: {
        recipe: {
            name: "English IPA (14A)", 
            volTotal: 5,      // gallons
            volBoil:  3,      // gallons
            timeBoil: 60     // minutes
        },
        extract1: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  4,    // pounds
            end:     false
        },
        extract2: {
            type:   "Liquid",
            name:   "Golden Light Malt Syrup",
            amount:  4,   // pounds
            end:     true
        },
        grain1: {
            type:   "Caramel",
            name:   "Caramel Malt 20L",
            amount:  0.5   // pounds
        },
        hop1: {
            type:   "Bittering",
            name:   "Nugget",
            amount:  1,  // ounces
            time:    60   // minutes
        },
        hop2: {
            type:   "Aroma",
            name:   "Golding",
            amount:  2,  // ounces
            time:    15   // minutes
        },
        hop3: {
            type:   "Aroma",
            name:   "Golding",
            amount:  1,  // ounces
            time:    5   // minutes
        },
        yeast: {
            type:    "Ale",
            company: "White Labs",
            number:  "WLP013"
        }
    }
};
