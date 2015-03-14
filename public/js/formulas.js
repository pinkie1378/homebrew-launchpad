/**
 * Formulas for calculating beer recipe specifications based on quantities
 * and specifications of the original ingredients entered in the calculator.
 */

/**
 * Converts points into specific gravity.
 */
function pointsToSG( ppg ) {
    return Number( ( 1 + (ppg * 0.001) ).toPrecision(4) );
}

/**
 * Convert Fine Grind, Dry Basis (FGDB) value into PPG value.
 * Also takes Moisture Content (MC) into consideration.  Uses the following
 * equation from http://morebeer.com/brewingtechniques/bmg/noonan.html
 *
 * PPG = (CGDB - MC - 0.002) * efficiency * 46.214
 *
 * CGDB is Coarse Grind, Dry Basis, and is usually 2% lower than FGDB.
 * efficiency is estimated to be around 65% for steeping and rinsing grains.
 * 46.214 is the number of PPG for sugar.
 */
function fgdbToPPG( fgdb, mc ) {
    var efficiency = 0.65;
    var cgdb = fgdb - 0.02;                 // convert fgdb to cgdb
    
    return (cgdb - mc - 0.002) * efficiency * 46.124;
}

/**
 * Calculates the utilization of the alpha acids (bitterness) of the hops.
 * Uses the following equation from How to Brew by John Palmer:
 *
 * utilization = f(G) x f(T)
 * f(G) = 1.65 * 0.000125^(boil gravity - 1)
 * f(T) = (1 - e^(-0.04 * boil time)) / 4.15
 */
function utilization( boilGravity, boilTime ) {
    var fG = 1.65 * Math.pow( 0.000125, boilGravity - 1 );
    var fT = (1 - Math.exp( -0.04 * boilTime )) / 4.15;
    
    return fG * fT;
}

/**
 * Calculates International Bitterness Units (IBUs)
 * Uses the following equation from How to Brew by John Palmer:
 *
 * IBU = (AAU * utilization * 75) / volume
 * AAU (alpha acid units) = oz of hops * % alpha acid
 * volume is the total volume of the batch of beer in gallons
 */
function ibu( ounces, alpha, volume, utilization ) {    
    return Math.round( (ounces * alpha * utilization * 75) / volume );
}

/**
 * Estimates the overall color of the beer using the Morey equation:
 * 
 * SRM/Lovibond = 1.49 * MCU^0.69
 */
function morey( mcu ) {
    return Math.round( 1.49 * Math.pow( mcu, 0.69 ) );
}

/**
 * Calculates the points value from PPG, amount (in pounds),
 * and volume (in gallons) of a malt extract or specialty grain.
 */
function points( ppg, pounds, volume ) {
    return (ppg * pounds) / volume;
}

/**
 * Calculates the malt color units (MCU) of a malt extract or specialty grain.
 */
function mcu( lovibond, pounds, volume ) {
    return Math.round( (lovibond * pounds) / volume );
}
