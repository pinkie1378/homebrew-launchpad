<!--Overall specifications for recipe calculator form-->

<!--Recipe Name row-->
<div class="container container-xs-height">
    <div class="row row-xs-height"> 

        <!--Name-->
        <div class="col-xs-12 col-xs-height">
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Recipe Name</span>
                <input type="text" class="form-control" id="name" name="name" 
                        placeholder="Enter your recipe name here"             />
            </div>
        </div> <!-- close column -->
    </div> <!-- close row -->
</div> <!-- close container -->

<!-- Overall recipe specifications -->
<div class="container container-xs-height" id="recipeSpecs" style="display:none">

    <!--Overall original gravity, IBU, and lovibond row-->
    <div class="row row-xs-height">

        <!--O.G.-->
        <div class="col-xs-4 col-xs-height"> 
            <div class="input-group input-group-lg">
                <span class="input-group-addon">O.G.</span>
                <input type="text" class="form-control" id="og" name="og" readonly>
            </div>
        </div> <!-- close column -->

        <!--Lovibond-->
        <div class="col-xs-4 col-xs-height"> 
            <div class="input-group input-group-lg">
                <span class="input-group-addon">&deg;Lovibond</span>
                <input type="text" class="form-control" id="lovibond" name="lovibond" readonly>
            </div>
        </div> <!-- close column -->

        <!--IBUs-->
        <div class="col-xs-4 col-xs-height"> 
            <div class="input-group input-group-lg">
                <span class="input-group-addon">IBUs</span>
                <input type="text" class="form-control" id="ibu" name="ibu" readonly>
            </div>
        </div> <!-- close column -->
    </div> <!-- close row -->

    <!--Total Volume, Boil Volume, and Boil Time row-->
    <div class="row row-xs-height">

        <!--Total Volume-->
        <div class="col-xs-4 col-xs-height">
            <div class="input-group">
                <span class="input-group-addon">Total Volume</span>
                <input type="number" min="0" step="0.1" class="form-control volume" id="volTotal" name="volTotal">
                <span class="input-group-addon">gal</span>
            </div>
        </div> <!-- close column -->

        <!--Boil Volume-->
        <div class="col-xs-4 col-xs-height"> 
            <div class="input-group">
                <span class="input-group-addon">Boil Volume</span>
                <input type="number" min="0" step="0.1" class="form-control volume" id="volBoil" name="volBoil">
                <span class="input-group-addon">gal</span>
            </div>
        </div> <!-- close column -->

        <!--Boil Time-->
        <div class="col-xs-4 col-xs-height">
            <div class="input-group">
                <span class="input-group-addon">Boil Time</span>
                <input type="number" min="0" step="5" class="form-control time" id="timeBoil" name="timeBoil">
                <span class="input-group-addon">min</span>
            </div>
        </div> <!-- close column -->
    </div> <!-- close row -->
</div> <!-- close container -->
