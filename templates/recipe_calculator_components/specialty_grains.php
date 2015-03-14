<!--Specialty grains segment of recipe calculator form-->

<!-- Grain 1 container -->
<div class="container container-xs-height" id="grain1" style="display:none">
    <div class="row row-xs-height"> 

        <!--Grain 1 selection list-->
        <div class="col-xs-6 col-xs-height col-bottom"> 
            <div class="input-group">
                <span class="input-group-addon">Grain 1</span>
                <label class="radio-inline">
                    <input type="radio" class="grain1_type" id="grain1_kilned" name="grain1_type" value="Kilned">
                    Kilned
                </label>
                <label class="radio-inline">
                    <input type="radio" class="grain1_type" id="grain1_caramel" name="grain1_type" value="Caramel">
                    Caramel
                </label>
                <label class="radio-inline">
                    <input type="radio" class="grain1_type" id="grain1_roasted" name="grain1_type" value="Roasted">
                    Roasted
                </label>
                <select class="form-control" id="grain1_name" name="grain1_name" disabled>
                    <option value="">Select grain type...</option>
                </select>
            </div>
        </div> <!-- close column -->

        <div id="grain1_state" class="state col-xs-6 col-xs-height col-bottom">
            <!--Grain 1 amount-->
            <div class="col-xs-4 col-xs-height col-bottom"> 
                <div class="input-group">
                    <input type="number" min="0" step="0.005" class="form-control inputDecimal" id="grain1_amount" name="grain1_amount">
                    <span class="input-group-addon">lb</span>
                </div>
            </div> <!-- close column -->

            <!--Grain 1 Malt Color Units (MCU)-->
            <div class="col-xs-4 col-xs-height col-bottom">
                <div class="input-group">
                    <span class="input-group-addon">MCU</span>
                    <input type="text" class="form-control" id="grain1_mcu" readonly>
                </div>
            </div> <!-- close column -->

            <!--Grain 1 O.G.-->
            <div class="col-xs-4 col-xs-height col-bottom"> 
                <div class="input-group">
                    <span class="input-group-addon">O.G.</span>
                    <input type="text" class="form-control" id="grain1_og" readonly>
                </div>
            </div> <!-- close column -->
        </div> <!-- close state -->
    </div> <!-- close row -->
</div> <!-- close container -->

<!-- Grain 2 container -->
<div class="container container-xs-height" id="grain2">
    <div class="row row-xs-height">
        <div class="col-xs-12 col-xs-height col-bottom">
            <button type="button" id="grain2_add" class="btn btn-custom btn-sm" value="grain_2_add" style="display:none">
                + Grain 2
            </button>
        </div> <!-- close column -->
    </div> <!-- close row -->
</div> <!-- close container -->
