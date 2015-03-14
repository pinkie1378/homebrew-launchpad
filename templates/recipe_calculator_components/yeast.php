<!--Yeast-->
<div class="container container-xs-height" id="yeast" style="display:none">
    <div class="row row-xs-height">
        <div class="col-sm-8 col-xs-height col-middle">
            <div class="input-group">
                <span class="input-group-addon">Yeast Type:</span>
                <label class="radio-inline">
                    <input type="radio" class="yeast_type" name="yeast_type" id="yeast_ale" value="Ale">
                    Ale
                </label>
                <label class="radio-inline">
                    <input type="radio" class="yeast_type" name="yeast_type" id="yeast_lager" value="Lager">
                    Lager
                </label>
                <span class="input-group-addon">Company:</span>
                <label class="radio-inline">
                    <input type="radio" class="yeast_company" id="yeast_wyeast" name="yeast_company" value="Wyeast Laboratories" disabled>
                    <span id="yeast_wyeast_text" class="yeast_company_text inactive">Wyeast</span>
                </label>
                <label class="radio-inline">
                    <input type="radio" class="yeast_company" id="yeast_white" name="yeast_company" value="White Labs" disabled>
                    <span id="yeast_white_text" class="yeast_company_text inactive">White Labs</span>
                </label>
            </div>
        </div> <!-- close column -->

        <div class="col-xs-4 col-xs-height col-middle">
            <select class="form-control" id="yeast_number" name="yeast_number" style="visibility:hidden">
                <option value=""></option>
            </select>
        </div> <!-- close column -->
    </div> <!-- close row-->
</div> <!-- close container -->