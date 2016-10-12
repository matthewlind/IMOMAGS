<?php

/**
 * Child theme scripts.
 */

?>
<div id="subs_popinst" style="display:none;">
	<div style="background-color: #f00b0b;color:#ffffff;padding:30px;">
		<div style="font-size:24px;font-weight: bold;">Subs Ad Here!</div>
		<div class="subs_popinst_close">Close Me</div>
	</div>
<div class="form-container ng-scope">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-header-top css-panel" wp-editable="css" ng-transclude="" ng-style="$viewValue" wp-css-panel="" wp-apply-css="sc.contents.styles.form_header_top" style="background-color: rgb(240, 240, 240);">
        <div class="form-header-container ng-scope"></div>
        <img wp-close-popup="" ng-click="closePopup()" src="/assets/pages/misc/close_popup.png" class="ng-scope" id="close_popup">
        <div class="form-header-text-container ng-scope">
          <div class="content-panel ng-binding" ng-bind-html="$viewValue" wp-editable="content" wp-content-panel="sc.contents.form_header"><div class="form-header">
<h1><span style="font-size:28px;"><strong><span style="color:#000000;">WAIT! </span></strong><br>
<strong><span style="color:#000000;">DON'T MISS A SINGLE ISSUE!</span></strong></span></h1>

<div style="text-align: center;">
<div style="text-align: center;"><span style="font-size:20px;">Get 12 issues for the low price of <strong>just $9</strong>!</span></div>
</div>

<div style="text-align: center;">&nbsp;</div>

<div style="text-align: center;"><img src="https://s3.amazonaws.com/media.wishpond.com/media/008/141/027/original.png?1458161075" style="width: 200px; height: 202px;"></div>
</div>
</div>
        </div>
        <div class="triangle-container ng-scope">
          <div class="down_arrow triangle" wp-apply-css="sc.contents.styles.form_header_top" triangle-color-property="background-color" style="border-top-color: rgb(240, 240, 240);"></div>
        </div>
      </div>
      <div class="form-body css-panel" wp-editable="css" ng-transclude="" ng-style="$viewValue" wp-css-panel="" wp-apply-css="sc.contents.styles.form_body">
        <form id="participation" novalidate="" role="form" ng-submit="!editable &amp;&amp; submit($event)" ng-class="{'form-inline': inline}" dbg="00I" wp-participation="true" class="ng-pristine ng-valid">
  <!-- ngIf: editable && sc.supports_participation_editor -->
  <div id="contest" wp-contest="true" class="ng-scope"><div wp-ledger-panel="sc.ledger" editable="editable" class="ng-scope"><div class="ledger-panel ng-isolate-scope" wp-ledger="sc.ledger" form="participation" wp-editable="ledger" wp-editable-width="full" editable="editable" prefill-enabled="sc.premium_features.advanced_forms.enabled"><!-- TODO: Remove the stuff that is specific to the participation editor (control.hovered, etc) -->
<!--   and have the participation editor apply it itself in the linker. -->
<!-- ngRepeat: control in ledger.controls | orderBy:'position' --><div class="form-group ng-scope" ng-repeat="control in ledger.controls | orderBy:'position'" ng-class="{hover: (control.hovered &amp;&amp; !control.selected), 'has-error': invalidControl(control.name), 'has-success': hasSuccess(control.name), 'active': control.selected}" ng-mouseover="control.hovered = true" ng-mouseleave="control.hovered = false" wp-ledger-control="control" wp-element-rearrange="ledgerControls" ng-style="{ color: ledger.styles.label.color }" style="color: rgb(148, 150, 151);"><button class="btn btn-block btn-large ng-scope ng-binding" type="submit" wp-btn-style="ledger.styles.submit" ng-click="setSubmitted()" ng-disabled="submitDisabled()" style="background-color: rgb(197, 33, 39); border-color: rgba(0, 0, 0, 0);">
  Subscribe!
</button></div><!-- end ngRepeat: control in ledger.controls | orderBy:'position' --></div></div></div>
</form>
        <div class="form-footer-container ng-scope">
          <div class="content-panel ng-binding" ng-bind-html="$viewValue" wp-editable="content" wp-content-panel="sc.contents.form_footer"></div>
        </div>
      </div>
    </div>
  </div>
</div>	
</div>

<!-- BEGIN Tynt Script -->
<script type="text/javascript">
if(document.location.protocol=='http:'){
 var Tynt=Tynt||[];Tynt.push('cv-SKkRaWr4y-6acwqm_6l');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<script async src="http://cdn.mediavoice.com/nativeads/script/IMOutdoors/mv_gundog.js"></script>



