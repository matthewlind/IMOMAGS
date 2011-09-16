<?php
/**
* bc-import-options.tpl.php
*
* variables
* $resp - the formatted response from form submissions.
*/
?>
<div class="wrap">
<h2>IMO Term Importer</h2>
<?php print $resp; ?>
<form action="" method="post">
<p><label for="taxonomy">From the taxonomy 
<select name="taxonomy" id="taxonomy">
<?php 
   $opts = array(
       "all"
       "activity"
       "gear"
       "location",
       "species",
   );
   foreach ($opts as $option) {
       print "<option value='$option'>$option</option>";
   }
?>
</select>, 
</label>

<select name="tax_action" id="tax_action">
   <option value="preview">Preview</option>
   <option value="import">Import</option>
</select>
Terms
</p>
<p class="submit">
   <input class="button-primary" value="Submit" type="submit" />
</p>
</form>
</div>

