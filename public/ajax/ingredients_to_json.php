<?php

/**
 * Looks up all the beer ingredients from their respective databases, and puts 
 * them in an ingredients array indexable by name (or number, for yeast)
 */

  // configuration
  require("../../includes/config.php");

  // get malt extracts
  $rows = query("SELECT name, type, lovibond, ppg, fermentability FROM Malt_Extracts");
  foreach ($rows as $row){
    $ingredients["extract"][$row["name"]] = [
        "name"            => $row["name"],
        "type"            => $row["type"],
        "lovibond"        => $row["lovibond"],
        "ppg"             => $row["ppg"],
        "fermentability"  => $row["fermentability"]
    ];
  }
  unset($rows);

  // get specialty grains
  $rows = query("SELECT name, type, lovibond, fgdb, mc FROM Specialty_Grains");
  foreach ($rows as $row) {
    $ingredients["grain"][$row["name"]] = [
        "name"      => $row["name"],
        "type"      => $row["type"],
        "lovibond"  => $row["lovibond"],
        "fgdb"      => floatval($row["fgdb"]),
        "mc"        => floatval($row["mc"])
    ];
  }
  unset($rows);

  // get hops
  $rows = query("SELECT name, type, alpha_min, alpha_max FROM Hops");
  foreach ($rows as $row) {
    $ingredients["hop"][$row["name"]] = [
        "name"      => $row["name"] . " (" . $row["alpha_min"] . "-" 
                       . $row["alpha_max"] . "% AA)",
        "type"      => $row["type"],
        "minAlpha"  => floatval($row["alpha_min"]),
        "maxAlpha"  => floatval($row["alpha_max"]),
        "meanAlpha" => ( floatval($row["alpha_min"]) + floatval($row["alpha_max"]) ) / 2
    ];
  }
  unset($rows);

  // get yeast
  $rows = query("SELECT name, number, company, type FROM Yeast");
  foreach ($rows as $row) {
    $ingredients["yeast"][$row["number"]] = [
        "name"    => $row["name"] . " - " . $row["number"],
        "number"  => $row["number"],
        "company" => $row["company"],
        "type"    => $row["type"]
    ];
  }
  unset($rows);

  echo json_encode($ingredients);

?>