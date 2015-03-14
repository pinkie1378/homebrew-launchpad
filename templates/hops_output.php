<div id="middle" class="col-sm-12">

<h3>Hops</h3>

<p>Hops provide bitterness that offsets the sweetness of the malt, as well as flavor and aroma compounds.  They also function as a natural preservative.  Most of the bitterness comes from the alpha acids, and the flavor/aroma compounds come from the essential oils.  Hops come in 3 general categories, depending on their aroma characteristics and alpha acid contents.</p>

<ul>
	<li>Bittering: Tend to have high alpha acid contents and an undesirable flavor/aroma profile.</li>
	<li>Dual Purpose: Have moderately high alpha acids and a good flavor/aroma profile.</li>
	<li>Aroma: Usually have low alpha acids and contribute the desired flavor and aroma to the beer.</li>
</ul>

<p>Wort is generally boiled for around 60 minutes, and different hops are added at different times of the boil.</p>
<ul>
	<li>45-60 min boil: Bittering hops. Isomerizes alpha acids to provide bitterness and evaporates flavor/aroma compounds.</li>
	<li>20-40 min boil: Flavoring hops. Adds mild bitterness and retains less volatile flavor compounds.
	<li>0-15 min boil: Finishing hops.  Most aroma compounds are retained.  Hops added at the end of the boil are usually left to steep for ~10 minutes before the wort is chilled.
</ul>
<br />
<h4>Bittering Hop Varieties:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Substitutions</th>
            <th>Aroma</th>
            <th>Perception</th>
            <th>Alpha Acids</th>
            <th>Total Oil</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($bitter_hops as $bitter_hop):

            print("<tr>");
            print("<td><a href='{$bitter_hop["link"]}' target='_blank'>{$bitter_hop["name"]}</a></td>");
            print("<td>{$bitter_hop["substitutions"]}</td>");
            print("<td>{$bitter_hop["aroma"]}</td>");
            print("<td>{$bitter_hop["perception"]}</td>");
            print("<td>{$bitter_hop["alpha_min"]}-{$bitter_hop["alpha_max"]}%</td>");
            print("<td>{$bitter_hop["total_oil"]}</td>");
            print("</tr>");

	    endforeach 
		?>
    </tbody>
    
</table>

<p>Total Oil units: mL/100 g</p>
<br />
<h4>Dual Purpose Hop Varieties:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Substitutions</th>
            <th>Aroma</th>
            <th>Perception</th>
            <th>Alpha Acids</th>
            <th>Total Oil</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($dual_hops as $dual_hop):

            print("<tr>");
            print("<td><a href='{$dual_hop["link"]}' target='_blank'>{$dual_hop["name"]}</a></td>");
            print("<td>{$dual_hop["substitutions"]}</td>");
            print("<td>{$dual_hop["aroma"]}</td>");
            print("<td>{$dual_hop["perception"]}</td>");
            print("<td>{$dual_hop["alpha_min"]}-{$dual_hop["alpha_max"]}%</td>");
            print("<td>{$dual_hop["total_oil"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Total Oil units: mL/100 g</p>
<br />
<h4>Aroma Hop Varieties:</h4>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Substitutions</th>
            <th>Aroma</th>
            <th>Perception</th>
            <th>Alpha Acids</th>
            <th>Total Oil</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php 
	    foreach ($aroma_hops as $aroma_hop):

            print("<tr>");
            print("<td><a href='{$aroma_hop["link"]}' target='_blank'>{$aroma_hop["name"]}</a></td>");
            print("<td>{$aroma_hop["substitutions"]}</td>");
            print("<td>{$aroma_hop["aroma"]}</td>");
            print("<td>{$aroma_hop["perception"]}</td>");
            print("<td>{$aroma_hop["alpha_min"]}-{$aroma_hop["alpha_max"]}%</td>");
            print("<td>{$aroma_hop["total_oil"]}</td>");
            print("</tr>");

	    endforeach 
	?>
    </tbody>
    
</table>

<p>Total Oil units: mL/100 g</p>