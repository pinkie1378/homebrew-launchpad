<?php

	// configuration
	require("../includes/config.php");
	
	// get liquid malt extract data
	$liquidmes = query("SELECT * FROM Malt_Extracts WHERE type = ? ORDER BY lovibond", "Liquid");
	
	if ($liquidmes === false)
	{
		apologize("Unable to retrieve liquid malt extract information.");
	}
	
	// get dry malt extract data
	$drymes = query("SELECT * FROM Malt_Extracts WHERE type = ? ORDER BY lovibond", "Powder");
	
	if ($drymes === false)
	{
		apologize("Unable to retrieve dry malt extract information.");
	}
	
	// render malt extract database
	render("extracts_output.php", ["liquidmes" => $liquidmes, "drymes" => $drymes, "title" => "Malt Extracts"]);

?>
