<div id="middle" class="col-sm-12">

<h3>Liquid Malt Extracts</h3>

<p>Liquid malt extracts (LMEs) are produced by crushing and soaking malted barley in hot water, which causes the barley's starch reserves to be converted into fermentable sugars, and creates wort.  The wort is then sent to a vacuum chamber to be dehydrated into a syrup that's about 80% solids, 20% water.  LMEs are the ideal primary malt source for homebrewing because they are easy to rehydrate.  LMEs have a points per pound per gallon (PPG) of 36, meaning that 1 lb of LME dissolved in 1 gallon of water will have a specific gravity of 1.036.</p>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>&#176;L</th>
            <th>% F</th>
            <th>Flavor</th>
            <th>Ingredients</th>
            <th>Use</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($liquidmes as $liquidme):

            print("<tr>");
            print("<td><a href='{$liquidme["link"]}' target='_blank'>{$liquidme["name"]}</a></td>");
            print("<td>{$liquidme["lovibond"]}</td>");
            print("<td>{$liquidme["fermentability"]}%</td>");
            print("<td>{$liquidme["flavor"]}</td>");
            print("<td>{$liquidme["ingredients"]}</td>");
            print("<td>{$liquidme["use"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p><a href="http://en.wikipedia.org/wiki/Beer_measurement#Colour">&#176;L</a> - Lovibond beer color scale. % F - Fermentability.</p>

<h3>Dry Malt Extracts</h3>

<p>Dry malt extracts (DMEs) are produced the same way as LMEs, but are processed further by spraying the liquid through atomizers in a tall heated chamber.  The droplets dry out by the time they fall to the bottom of the chamber, producing a powder that's about 97% solids.  DMEs are harder to rehydrate than LMEs, but they are easier to portion out, and have a longer shelf life.  They are very useful for incrementally adjusting the original gravity, and darker ones can also be used for flavor and color adjustments.  DMEs have a points per pound per gallon (PPG) of 45, meaning that 1 lb of LME dissolved in 1 gallon of water will have a specific gravity of 1.045.</p>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>&#176;L</th>
            <th>% F</th>
            <th>Flavor</th>
            <th>Ingredients</th>
            <th>Use</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($drymes as $dryme):

            print("<tr>");
            print("<td><a href='{$dryme["link"]}' target='_blank'>{$dryme["name"]}</a></td>");
            print("<td>{$dryme["lovibond"]}</td>");
            print("<td>{$dryme["fermentability"]}%</td>");
            print("<td>{$dryme["flavor"]}</td>");
            print("<td>{$dryme["ingredients"]}</td>");
            print("<td>{$dryme["use"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p><a href="http://en.wikipedia.org/wiki/Beer_measurement#Colour">&#176;L</a> - Lovibond beer color scale. % F - Fermentability.</p>
