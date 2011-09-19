<?php
/**
 * imo-tax-options-page.tpl.php
 *
 * variables
 * $resp - the formatted response from form submissions.
 */
?>
<div class="wrap">
<h2>IMO Term Importer</h2>
<?php if (!empty($resp)): ?>
<div id="response-pane" class="" style="background:#EFEFEF;color:#333; border-radius:5px;padding:5px 15px 10px;">
<?php print $resp; ?>
</div>
<?php endif; ?>
<form action="" method="post">
<p><label for="taxonomy">From the taxonomy 
<select name="taxonomy" id="taxonomy">
<?php 
$opts = array(
    "all",
    "activity",
    "gear",
    "location",
    "species",
);
foreach ($opts as $option) {
    print "<option value='$option'>$option</option>";
}
?>
</select> and then
</label>
<select name="tax_action" id="tax_action">
   <option value="preview">Preview</option>
   <option value="import">Import</option>
</select>
the terms
</p>
<p class="submit">
   <input class="button-primary" value="Submit" type="submit" />
</p>
</form>
</div>
