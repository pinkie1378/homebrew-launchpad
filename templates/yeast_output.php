<div id="middle" class="col-sm-12">

<h3>Yeast</h3>

<p>Humans make wort, yeast make beer.  As you can see below, there are many different varieties of yeast out there.  Yeast can be grouped into two general categories: ale and lager.  Traditionally ale yeast do their work floating on top of the wort while lager yeast frement from the bottom, but the most important difference from the brewer's perspective is their optimal fermentation temperatures.  Ale yeast work at room temperature, while lager yeast work at cooler, cellar temperatures.  Other yeast properties:</p>
<ul>
	<li>
	Attenuation: percentage of wort sugars (not all of which are fermentable) the yeast convert into CO<sub>2</sub> and alcohol.  Low attenuation strains will produce a sweeter brew, while high attenuation strains will produce a drier brew.
		<ul>
			<li>67-70% = Low</li>
			<li>71-74% = Medium</li>
			<li>75-78% = High</li>
		</ul>
	</li>
	<li>
	Flocculation: how well the yeast clump together and settle to the bottom of the fermenter after fermentation is complete.  Low flocculation strains don't settle well, and contribute the cloudy look of unfiltered beers.  High flocculation strains settle very well, and are good for bright, clear beers.
	</li>
</ul>

<h3>Wyeast Laboratories</h3>

<p>Wyeast Laboratories sells live yeast in Smack-Packs&#8482;, a mylar envelope containing a liquid yeast culture and a sealed nutrient packet.  Once the envelope is "smacked", the nutrient packet bursts open, and the yeast begin metabolizing, causing the envelope to inflate.  I like this system, because you know your yeast are active when you pitch them.  Since they're active, you know they'll start the fermentation process with minimal lag.  This is good contamination insurance, as they're likely to outcompete any unwanted microbial hitchhikers.</p>

<h4>Wyeast Ale Strains:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Attenuation</th>
            <th>Flocculation</th>
            <th>Temp.</th>
            <th>EtOH Tol.</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($wyeast_ales as $wyeast_ale):

            print("<tr>");
            print("<td><a href='{$wyeast_ale["link"]}' target='_blank'>{$wyeast_ale["name"]}</a></td>");
            print("<td>{$wyeast_ale["number"]}</td>");
            print("<td>{$wyeast_ale["min_atten"]}-{$wyeast_ale["max_atten"]}%</td>");
            print("<td>{$wyeast_ale["flocculation"]}</td>");
            print("<td>{$wyeast_ale["optimum_temp"]}</td>");
            print("<td>{$wyeast_ale["alcohol_tolerance"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Temp: Optimum fermentation temperature. EtOH Tol: Ethanol tolerance.</p>
<br />
<h4>Wyeast Lager Strains:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Attenuation</th>
            <th>Flocculation</th>
            <th>Temp.</th>
            <th>EtOH Tol.</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($wyeast_lagers as $wyeast_lager):

            print("<tr>");
            print("<td><a href='{$wyeast_lager["link"]}' target='_blank'>{$wyeast_lager["name"]}</a></td>");
            print("<td>{$wyeast_lager["number"]}</td>");
            print("<td>{$wyeast_lager["min_atten"]}-{$wyeast_lager["max_atten"]}%</td>");
            print("<td>{$wyeast_lager["flocculation"]}</td>");
            print("<td>{$wyeast_lager["optimum_temp"]}</td>");
            print("<td>{$wyeast_lager["alcohol_tolerance"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Temp: Optimum fermentation temperature. EtOH Tol: Ethanol tolerance.</p>

<br />

<h3>White Labs</h3>

<p>White Labs sells live yeast in durable plastic screw-cap test tubes.  While you don't get to see evidence of the yeast working before pitching them, there are more cells in a White tube than in a Wyeast envelope.  White also offers a larger spectrum of yeast strains.  The pressure inside a White tube can be considerably higher than outside of it, make sure you open it slowly over a sink!</p>

<h4>White Ale Strains:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Attenuation</th>
            <th>Flocculation</th>
            <th>Temp.</th>
            <th>EtOH Tol.</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($white_ales as $white_ale):

            print("<tr>");
            print("<td><a href='{$white_ale["link"]}' target='_blank'>{$white_ale["name"]}</a></td>");
            print("<td>{$white_ale["number"]}</td>");
            print("<td>{$white_ale["min_atten"]}-{$white_ale["max_atten"]}%</td>");
            print("<td>{$white_ale["flocculation"]}</td>");
            print("<td>{$white_ale["optimum_temp"]}</td>");
            print("<td>{$white_ale["alcohol_tolerance"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Temp: Optimum fermentation temperature. EtOH Tol: Ethanol tolerance.</p>
<br />
<h4>White Lager Strains:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Attenuation</th>
            <th>Flocculation</th>
            <th>Temp.</th>
            <th>EtOH Tol.</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($white_lagers as $white_lager):

            print("<tr>");
            print("<td><a href='{$white_lager["link"]}' target='_blank'>{$white_lager["name"]}</a></td>");
            print("<td>{$white_lager["number"]}</td>");
            print("<td>{$white_lager["min_atten"]}-{$white_lager["max_atten"]}%</td>");
            print("<td>{$white_lager["flocculation"]}</td>");
            print("<td>{$white_lager["optimum_temp"]}</td>");
            print("<td>{$white_lager["alcohol_tolerance"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Temp: Optimum fermentation temperature. EtOH Tol: Ethanol tolerance.</p>
