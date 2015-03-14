<div id="middle" class="col-sm-12">

<h3>Specialty Grains</h3>

<p>Specialty grains are used to increase the complexity of the wort.  Almost every beer style can be made by using a pale malt extract (<em>e.g.</em>Golden Light, Pilsen), made almost entirely of base malt, and steeping specialty grains.  Before adding the malt extract, heat the water to 165 &#176;F, put the grain in a nylon or muslin bag, and steep it for 30 minutes.  Then remove it, bring the water to a boil, and add the malt extract.  Darker malt extracts were prepared using specialty grains.</p>

<br />

<h4>Kilned Malts:</h4>

<p>These need to be mashed to convert the starches to sugar, so simple steeping doesn't add any sweetness to the wort.  However, they do add color and flavor.</p>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>&#176;L</th>
            <th>FGDB</th>
            <th>MC</th>
            <th>Color</th>
            <th>Flavor</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($kilned_grains as $kilned_grain):

            $kilned_grain["fgdb"] *= 100;
            $kilned_grain["mc"] *= 100;
            
            print("<tr>");
            print("<td><a href='{$kilned_grain["link"]}' target='_blank'>{$kilned_grain["name"]}</a></td>");
            print("<td>{$kilned_grain["lovibond"]}</td>");
            print("<td>{$kilned_grain["fgdb"]}%</td>");
            print("<td>{$kilned_grain["mc"]}%</td>");
            print("<td>{$kilned_grain["color"]}</td>");
            print("<td>{$kilned_grain["flavor"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p><a href="http://en.wikipedia.org/wiki/Beer_measurement#Colour">&#176;L</a> - Lovibond beer color scale. FGDB - Fine Grind Dry Basis (maximum soluble solids). MC - Moisture Content.</p>

<br />

<h4>Caramel/Crystal Malts:</h4>

<p>Caramel malts have been "stewed" after the malting process, which converts the starch reserves into sugar, and liquefies the sugar inside the kernel.  Then they are roasted at various temperatures, which caramalizes the sugars and produces a range of colors and flavors.  A distinguishing characteristic of Caramel Malts is their ability to improve foam development and stability, and enhance viscosity due to the non-fermentable sugars they contribute to beer.</p>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>&#176;L</th>
            <th>FGDB</th>
            <th>MC</th>
            <th>Color</th>
            <th>Flavor</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($caramel_grains as $caramel_grain):
			
			$caramel_grain["fgdb"] *= 100;
            $caramel_grain["mc"] *= 100;
			
            print("<tr>");
            print("<td><a href='{$caramel_grain["link"]}' target='_blank'>{$caramel_grain["name"]}</a></td>");
            print("<td>{$caramel_grain["lovibond"]}</td>");
            print("<td>{$caramel_grain["fgdb"]}%</td>");
            print("<td>{$caramel_grain["mc"]}%</td>");
            print("<td>{$caramel_grain["color"]}</td>");
            print("<td>{$caramel_grain["flavor"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p><a href="http://en.wikipedia.org/wiki/Beer_measurement#Colour">&#176;L</a> - Lovibond beer color scale. FGDB - Fine Grind Dry Basis (maximum soluble solids). MC - Moisture Content.</p>

<br />

<h4>Roasted Malts:</h4>

<p>These malts have been highly roasted, and they contribute chocolate and coffee flavors, as well as dark color, to brown ales, porters, and stouts.  They should be used in moderation.  Debittered black malts have much of the husk removed prior to roasting, which contributes a smoother roasted character.</p>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>&#176;L</th>
            <th>FGDB</th>
            <th>MC</th>
            <th>Color</th>
            <th>Flavor</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($roasted_grains as $roasted_grain):
	    
			$roasted_grain["fgdb"] *= 100;
            $roasted_grain["mc"] *= 100;

            print("<tr>");
            print("<td><a href='{$roasted_grain["link"]}' target='_blank'>{$roasted_grain["name"]}</a></td>");
            print("<td>{$roasted_grain["lovibond"]}</td>");
            print("<td>{$roasted_grain["fgdb"]}%</td>");
            print("<td>{$roasted_grain["mc"]}%</td>");
            print("<td>{$roasted_grain["color"]}</td>");
            print("<td>{$roasted_grain["flavor"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p><a href="http://en.wikipedia.org/wiki/Beer_measurement#Colour">&#176;L</a> - Lovibond beer color scale. FGDB - Fine Grind Dry Basis (maximum soluble solids). MC - Moisture Content.</p>