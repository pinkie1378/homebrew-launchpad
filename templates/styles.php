<div id="middle" class="col-sm-12">
    <p>These are the beer style guidelines published by the <a href="http://www.bjcp.org" target="_blank">Beer Judge Certification Program</a> (BJCP) in 2008:</p>

    <div class="panel-group" id="accordion">

    <?php
        // collapsible categories from $categories array
        foreach ($categories as $category) {
            print("<div class='panel panel-default'>");
            print("<div class='panel-heading'>");
            print("<h4 class='panel-title'>");
            print("<a data-toggle='collapse' data-parent='#accordion' href='#collapse{$category["cat_num"]}'>");
            print("{$category["cat_num"]}. {$category["category"]}");
            print("</a></h4></div>");
            print("<div id='collapse{$category["cat_num"]}' class='panel-collapse collapse'>");
            print("<div class='panel-body'>");

            // tabs for each beer in that category
            print("<ul class='nav nav-tabs'>");
            foreach ($styles as $style) {
                if ($category["category"] == $style["category"]) {
                    if ($style["cat_letter"] == 'A')
                        print("<li class='active'>");
                    else
                        print("<li>");
                    print("<a href='#{$style["type"]}{$style["cat_num"]}{$style["cat_letter"]}' data-toggle='tab'>");
                    print("{$style["cat_letter"]}. {$style["style"]}</a></li>");
                }
            }
            print("</ul>");

            // tab panes for each beer in that category
            print("<div class='tab-content'>");
            foreach ($styles as $style) {
                if ($category["category"] == $style["category"]) {
                    if ($style["cat_letter"] == 'A')
                        print("<div class='tab-pane active'");
                    else
                        print("<div class='tab-pane'");
                    print("id='{$style["type"]}{$style["cat_num"]}{$style["cat_letter"]}'>");
                    print("<dl class='dl-horizontal'>");
                    print("<dt>Aroma</dt><dd>{$style['aroma']}</dd>");
                    print("<dt>Appearance</dt><dd>{$style['appearance']}</dd>");
                    print("<dt>Flavor</dt><dd>{$style['flavor']}</dd>");
                    print("<dt>Mouthfeel</dt><dd>{$style['mouthfeel']}</dd>");
                    print("<dt>Impression</dt><dd>{$style['impression']}</dd>");
                    if (isset ($style['history']))
                        print("<dt>History</dt><dd>{$style['history']}</dd>");
                    if (isset ($style['comments']))
                        print("<dt>Comments</dt><dd>{$style['comments']}</dd>");
                    if (isset ($style['ingredients']))
                        print("<dt>Ingredients</dt><dd>{$style['ingredients']}</dd>");
                    print("<dt>Vital Statistics</dt>");
                    if (isset ($style['vital_stat_note']))
                        print("<dd>{$style['vital_stat_note']}</dd>");
                    else {
                        print("<dd><table><thead><tr>");
                        print("<th style='padding-right:20px'>IBUs</th>");
                        print("<th style='padding-right:20px'>&deg;Lovibond</th>");
                        print("<th style='padding-right:20px'>Original Gravity</th>");
                        print("<th style='padding-right:20px'>Final Gravity</th>");
                        print("<th style='padding-right:20px'>% Alcohol</th>");
                        print("</tr></thead><tbody><tr>");
                        print("<td>{$style['ibu_min']} - {$style['ibu_max']}</td>");
                        print("<td>{$style['srm_min']} - {$style['srm_max']}</td>");
                        print("<td>{$style['og_min']} - {$style['og_max']}</td>");
                        print("<td>{$style['fg_min']} - {$style['fg_max']}</td>");
                        print("<td>{$style['abv_min']} - {$style['abv_max']}</td>");
                        print("</tr></tbody></table></dd>");
                    }
                    print("<dt>Commercial Examples</dt><dd>{$style['examples']}</dd>");
                    print("</dl></div>");
                }
            }
            print("</div></div></div></div>");
        }

    ?>

</div>
