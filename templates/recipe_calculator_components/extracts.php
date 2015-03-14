<!--Malt extracts segment of recipe calculator form-->

<!-- Extract 1 container -->
<div class="container container-xs-height" id="extract1">
    <div class="row row-xs-height">

        <!--Extract 1 selection list-->
        <div class="col-xs-6 col-xs-height col-bottom"> 
            <div class="input-group">
                <span class="input-group-addon">Extract 1</span>
                <label class="radio-inline">
                    <input type="radio" id="extract1_liquid" name="extract1_type" class="extract1_type" value="Liquid">
                    Liquid
                </label>
                <label class="radio-inline">
                    <input type="radio" id="extract1_powder" name="extract1_type" class="extract1_type" value="Powder">
                    Powder
                </label>
                <select class="form-control" id="extract1_name" name="extract1_name" disabled>
                    <option value="">Select extract type...</option>
                </select>
            </div>
        </div> <!-- close column -->

        <div id="extract1_state" class="state col-xs-6 col-xs-height col-bottom">
            <!--Extract 1 amount-->
            <div class="col-xs-4 col-xs-height col-bottom"> 
                <div class="input-group">
                    <input type="number" min="0" step="0.01" class="form-control inputDecimal" id="extract1_amount" name="extract1_amount">
                    <span class="input-group-addon">lb</span>
                </div>
            </div> <!-- close column -->

            <!--Extract 1 Malt Color Units (MCU)-->
            <div class="col-xs-4 col-xs-height col-bottom"> 
                <div class="input-group">
                    <span class="input-group-addon">MCU</span>
                    <input type="text" class="form-control" id="extract1_mcu" readonly>
                </div>
            </div> <!-- close column -->

            <!--Extract 1 O.G.-->
            <div class="col-xs-4 col-xs-height col-bottom"> 
                <div class="input-group">
                    <span class="input-group-addon">O.G.</span>
                    <input type="text" class="form-control" id="extract1_og" readonly>
                </div>
            </div> <!-- close column -->
        </div> <!-- close state -->
    </div> <!-- close row -->
</div> <!-- close container -->

<!-- Extract 2 container -->
<div class="container container-xs-height" id="extract2">
    <div class="row row-xs-height">
        <div class="col-xs-12 col-xs-height col-bottom">
            <button type="button" id="extract2_add" class="btn btn-custom btn-sm" value="extract_2_add" style="display:none">
                + Extract 2
            </button>
        </div> <!-- close column -->
    </div> <!-- close row -->
</div> <!-- close container -->