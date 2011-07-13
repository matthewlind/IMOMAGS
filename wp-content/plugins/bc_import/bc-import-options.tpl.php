<?php
/**
 * bc-import-options.tpl.php
 *
 * variables
 * $resp - the formatted response from form submissions.
 */
?>
<div class="wrap">
<style>.red { color:#C00; } .green { color: #0C0;} </style>
<h2>Brightcove Importer</h2>
<?php print $resp; ?>
<form action="" method="post">
<p><label for="bc_meth">Search 
<select name="bc_meth" id="bc_meth">
<?php 
    $opts = array(
        "tag"=>"By Tags",
        "search"=>"By Title",
        "id"=>"By Id",
    );
    foreach ($opts as $option=>$value) {
        print "<option value='$option'>$value</option>";
    }
?>
</select>
</label>
<label for="bc_query">for
<input name="bc_query" id="bc_query" type='text'/></label> and
<select name="bc_action" id="bc_action">
    <option value="preview">Preview</option>
    <option value="import">Import</option>
</select>
</p>
<p class="submit">
    <input class="button-primary" value="Submit" type="submit" />
</p>
</form>
</div>
