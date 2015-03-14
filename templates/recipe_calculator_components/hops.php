<!--Hops segment of the recipe calculator form-->

<!--Hop 1 container-->
<div class="container container-xs-height" id="hop1" style="display:none">
    <div class="row row-xs-height">

        <!--Hop 1 selection list-->
        <div class="col-xs-6 col-xs-height col-bottom">
            <div class="input-group">
                <span class="input-group-addon">Hop 1</span>
                <label class="radio-inline">
                    <input type="radio" class="hop1_type" id="hop1_bittering" name="hop1_type" value="Bittering">
                    Bittering
                </label>
                <label class="radio-inline">
                    <input type="radio" class="hop1_type" id="hop1_dual" name="hop1_type" value="Dual">
                    Dual
                </label>
                <label class="radio-inline">
                    <input type="radio" class="hop1_type" id="hop1_aroma" name="hop1_type" value="Aroma">
                    Aroma
                </label>
                <select class="form-control" id="hop1_name" name="hop1_name" disabled>
                    <option value="">Select hop type...</option>
                </select>
            </div>
        </div> <!-- close column -->

        <div id="hop1_state" class="state col-xs-6 col-xs-height col-bottom">
            <!--Hop 1 amount-->
            <div class="col-xs-4 col-xs-height col-bottom">
                <div class="input-group">
                    <input type="number" min="0" step="0.005" class="form-control inputDecimal" id="hop1_amount" name="hop1_amount">
                    <span class="input-group-addon">oz</span>
                </div>
            </div> <!-- close column -->

            <!--Hop 1 boiling time-->
            <div class="col-xs-4 col-xs-height col-bottom">
                <div class="input-group">
                    <input type="number" min="0" step="5" class="form-control inputInteger" id="hop1_time" name="hop1_time">
                    <span class="input-group-addon">min</span>
                </div>
            </div> <!-- close column -->

            <!--Hop 1 IBUs-->
            <div class="col-xs-4 col-xs-height col-bottom">
                <div class="input-group">
                    <span class="input-group-addon">IBU</span>
                    <input type="text" class="form-control" id="hop1_ibu" readonly>
                </div>
            </div> <!-- close column -->
        </div> <!-- close state -->
    </div> <!-- close row -->
</div> <!-- close container -->

<!-- Hop 2 container -->
<div class="container container-xs-height" id="hop2">
    <div class="row row-xs-height">
        <div class="col-xs-12 col-xs-height col-bottom">
            <button type="button" id="hop2_add" class="btn btn-custom btn-sm" value="hop_2_add" style="display:none">
                + Hop 2
            </button>
        </div> <!-- close column -->
    </div> <!-- close row -->
</div> <!-- close container -->
