<?php

	// configuration
	require("../includes/config.php");
	
	// get wyeast ale strains
	$wyeast_ales = query("SELECT * FROM Yeast WHERE type = ? AND company = ?", "Ale", "Wyeast Laboratories");
	
	if ($wyeast_ales === false)
	{
		apologize("Unable to retrieve Wyeast Laboratories ale yeast strains.");
	}
	
	// get wyeast lager strains
	$wyeast_lagers = query("SELECT * FROM Yeast WHERE type = ? AND company = ?", "Lager", "Wyeast Laboratories");
	
	if ($wyeast_lagers === false)
	{
		apologize("Unable to retrieve Wyeast Laboratories lager yeast strains.");
	}
	
	// get white labs ale strains
	$white_ales = query("SELECT * FROM Yeast WHERE type = ? AND company = ?", "Ale", "White Labs");
	
	if ($white_ales === false)
	{
		apologize("Unable to retrieve White Labs ale yeast strains.");
	}
	
	// get white labs lager strains
	$white_lagers = query("SELECT * FROM Yeast WHERE type = ? AND company = ?", "Lager", "White Labs");
	
	if ($white_lagers === false)
	{
		apologize("Unable to retrieve White Labs lager yeast strains.");
	}
	
	// render malt extract database
	render("yeast_output.php", ["wyeast_ales" => $wyeast_ales, "wyeast_lagers" => $wyeast_lagers, "white_ales" => $white_ales, "white_lagers" => $white_lagers, "title" => "Yeast"]);

?>
