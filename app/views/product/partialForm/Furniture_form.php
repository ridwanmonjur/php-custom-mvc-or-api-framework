<div id="FurnitureForm" class="is-hidden">

    <div class="row">
        <label class="col-12-sm col-3 label-fix" for="height">Height (CM)</label>
        <div class="col-12-sm col-4">
            <input type="number" class="input" id="height" min="0" name="attribute[height]" required disabled onblur="validateForms(event);"
                placeholder="Please provide height.">
        </div>
    </div>

    <div class="row">
        <label class="col-12-sm col-3 label-fix" for="width">Width (CM)</label>
        <div class="col-12-sm col-4">
            <input type="number" class="input" id="width" min="0" name="attribute[width]" required disabled onblur="validateForms(event);"
                placeholder="Please provide width.">
        </div>
    </div>

    <div class="row">
        <label class="col-12-sm col-3 label-fix" for="length">Length (CM)</label>
        <div class="col-12-sm col-4">
            <input type="number" class="input" id="length" min="0" name="attribute[length]" required disabled onblur="validateForms(event);"
                placeholder="Please provide length.">
        </div>
    </div>

    <h3 class="ml-5 is-size-5 mt-5 has-text-weight-semibold">
        Please, provide dimensions in CM.
    </h3>

</div>