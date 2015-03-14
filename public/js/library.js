/**
 * library.js
 * 
 * General library style helper functions.
 */

/**
 * Capitalizes the first letter of a string.
 */
function strCap( str ) {
    return str.charAt( 0 ).toUpperCase() + str.slice( 1 );
}

/**
 * Returns the last character of a string.
 */
function lastChar( str ) {
    return str.charAt( str.length - 1 );
}

/**
 * Removes the last character of a string.
 */
function removeLastChar( str ) {
    return str.slice( 0, str.length - 1 );
}

/**
 * Returns the string in between first char1 and last char2 of str
 */
function stringBetween( char1, char2, string ) {
    var pos1 = string.indexOf( char1 ) + 1;
    var pos2 = string.lastIndexOf( char2 );
    if ( pos1 == -1 || pos2  == -1 || pos2 - pos1 <= 0 ) {
        return "";
    }
    else {
        return string.substr( pos1, pos2 - pos1 );
    }
}

/**
 * Only allows integers to be entered in a form field.
 */
function restrictInteger( id, event, key ) {
    if ( (key < 48 || key > 57) && key != 0 ) {
        event.preventDefault();
    }
}

/**
 * Only allows integers and 1 decimal point to be entered in a form field.
 */
function restrictDecimal( id, event, key ) {
    // if a decimal point is present...
    if ( $( "#" + id ).val().split(".").length > 1 ) {
        restrictInteger( id, event, key );
    }
    else {
        // allow integers and a decimal point
        if ( (key < 48 || key > 57) && key != 0 && key != 46 ) {
            event.preventDefault();
        }
    }
}
