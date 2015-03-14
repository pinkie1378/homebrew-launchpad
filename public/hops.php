<?php

	// configuration
	require("../includes/config.php");
	
	// get bittering hops varieties
	$bitter_hops = query("SELECT * FROM Hops WHERE type = ?", "Bittering");
	
	if ($bitter_hops === false)
	{
		apologize("Unable to retrieve bittering hops varieties.");
	}
	
	// get dual purpose hops varieties
	$dual_hops = query("SELECT * FROM Hops WHERE type = ?", "Dual");
	
	if ($dual_hops === false)
	{
		apologize("Unable to retrieve dual purpose hops varieties.");
	}
	
	// get aroma hops varieties
	$aroma_hops = query("SELECT * FROM Hops WHERE type = ?", "Aroma");
	
	if ($aroma_hops === false)
	{
		apologize("Unable to retrieve dual purpose hops varieties.");
	}
	
	// render malt extract database
	render("hops_output.php", ["bitter_hops" => $bitter_hops, "dual_hops" => $dual_hops, "aroma_hops" => $aroma_hops, "title" => "Hops"]);

?>
