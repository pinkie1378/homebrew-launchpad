<div id="middle"> 

    <!--Recipe calculator form-->

    <form id="recipe" action="recipe_display.php" method="get">

        <!--Recipe select list-->
        <div class="container container-xs-height">
            <div class="row row-xs-height">
                <div class="col-xs-12 col-xs-height">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Example Recipes:</span>
                        <select class="form-control" id="recipes" disabled>
                            <option>replace with names in recipes.js</option>
                        </select>
                    </div>
                </div> <!-- close column -->
            </div> <!-- close row -->
        </div> <!-- close container -->

        <!--BJCP style guidelines select lists-->
        <div class="container container-xs-height">
            <div class="row row-xs-height">

                <!--Categories-->
                <div class="col-xs-8 col-xs-height col-top">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">BJCP style guidelines:</span>
                        <select class="form-control" id="cat" name="cat">
                            <option value="" disabled selected style="display:none">Select category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category["cat_num"] ?>">
                                    <?= $category["cat_num"] . ". " . $category["category"] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <!--Sub-categories-->
                <div class="col-xs-4 col-xs-height col-top">
                    <select class="form-control lg-select" id="subcat" name="subcat" disabled>
                        <option>Choose a category...</option>
                    </select>
                </div> <!-- close column -->
            </div> <!-- close row -->
        </div> <!-- close container -->

        <!--BJCP ingredients and Vital Statistics-->
        <div class="container container-xs-height">
            <div class="row row-xs-height">
                <div class="col-xs-12 col-xs-height">
                    <div id="bjcp" name="bjcp"></div>
                </div> <!-- close column -->
            </div> <!-- close row -->
        </div> <!-- close container -->

        <div id="calculator">
            <?php require("recipe_calculator_components/recipe_specs.php"); ?>
            <br />
            <?php require("recipe_calculator_components/extracts.php"); ?>
            <br />
            <?php require("recipe_calculator_components/specialty_grains.php"); ?>
            <br />
            <?php require("recipe_calculator_components/hops.php"); ?>
            <br />
            <?php require("recipe_calculator_components/yeast.php"); ?>
            <br />
        </div> <!-- close calculator -->

        <!-- Submit button -->
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <button id="submit" type="submit" class="btn btn-custom btn-lg btn-block">Display Recipe</button>
            </div>
        </div>
    </form>
