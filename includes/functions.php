<?php

    /**
     * functions.php
     *
     * Computer Science 50
     * Final Project
     *
     * homebrew-launchpad.com helper functions.
     */

    require_once("constants.php");

    /**
     * Apologizes to user with message.
     */
    function apologize($message) {
            render("apology.php", ["message" => $message]);
            exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable) {
            require("../templates/dump.php");
            exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     * Commented out, but keep in case login/logout functinality is implemented
     * in the future.
     */
    /*
    function logout() {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }*/

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */) {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle)) {
            try {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e) {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false) {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination) {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination)) {
            header("Location: " . $destination);
        }
        // handle absolute path
        else if (preg_match("/^\//", $destination)) {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }
        // handle relative path
        else {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }
        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = []) {
        // if template exists, render it
        if (file_exists("../templates/$template")) {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }
        // else err
        else {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    /**
     * Performes basic arithmatic on 2 numbers represented as strings.
     */
    function str_math( $str1, $str2, $operator ) {
        $retval = -1;
        switch ( $operator ) {
            case "add":
                $retval = floatval($str1) + floatval($str2);
                break;
            case "subtract":
                $retval = floatval($str1) - floatval($str2);
                break;
            case "multiply":
                $retval = floatval($str1) * floatval($str2);
                break;
            case "divide":
                $retval = floatval($str1) / floatval($str2);
                break;
            default:
                trigger_error("Usage: str_math( str1, str2, 'add'|'subtract'|'multiply'|'divide' )", E_USER_ERROR );
        }
        return $retval;
    }
    
    /**
     * Takes an array of strings and outputs them in a comma separated list,
     * with each individual string bolded.
     */
    function formatted_string_list( $str = [] ) {
        $retval = "";
        $length = count($str);
        if ( $length == 1 ) {
            $retval .= "<strong>$str[0]</strong>";
        }
        else if ( $length == 2 ) {
            $retval .= "<strong>$str[0]</strong> and <strong>$str[1]</strong>";
        }
        else {
            $last_str = array_pop( $str );
            foreach ( $str as $string ) {
                $retval .= "<strong>$string</strong>, ";
            }
            $retval .= "and <strong>$last_str</strong>";
        }
        return $retval;
    }
?>
