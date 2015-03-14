<?php
	
	// configuration
	require("../includes/config.php");
	
	// get style guidelines in 1 giant array
	$styles = query("SELECT * FROM BJCP");
	if ($styles === false)
		apologize("Unable to retrieve beer styles data.");
	
	// get style category names
	$categories = query("SELECT * FROM BJCP_Categories");
	if ($categories === false) {
		apologize("Unable to retreive beer style categories.");
	}
	
	render("styles.php",["styles" => $styles, "categories" => $categories, "title" => "Beer Styles"]);

?>