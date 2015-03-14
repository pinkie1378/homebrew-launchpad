<?php

	// configuration
	require("../includes/config.php");
	
	// get kilned specialty grains
	$kilned_grains = query("SELECT * FROM Specialty_Grains WHERE type = ? ORDER BY lovibond", "Kilned");
	
	if ($kilned_grains === false)
	{
		apologize("Unable to retrieve kilned specialty grains.");
	}
	// get caramel specialty grains
	$caramel_grains = query("SELECT * FROM Specialty_Grains WHERE type = ? ORDER BY lovibond", "Caramel");
	
	if ($caramel_grains === false)
	{
		apologize("Unable to retrieve caramel specialty grains.");
	}
	
	// get roasted specialty grains
	$roasted_grains = query("SELECT * FROM Specialty_Grains WHERE type = ? ORDER BY lovibond", "Roasted");
	
	if ($roasted_grains === false)
	{
		apologize("Unable to retrieve roasted specialty grains.");
	}
	
	// render malt extract database
	render("grains_output.php", ["kilned_grains" => $kilned_grains, "caramel_grains" => $caramel_grains, "roasted_grains" => $roasted_grains, "title" => "Specialty Grains"]);

?>
