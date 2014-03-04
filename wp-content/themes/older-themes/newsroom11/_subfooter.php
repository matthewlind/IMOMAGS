<?php if ( wpb_breadcrumbs_enabled() ): ?>
<div id="breadcrumb">
	<div class="container">
		<div id="breadcrumb-inner" class="fix">
			<div class="pad fix">
				<?php echo wpb_breadcrumbs(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if ( wpb_option('footer-widgets') ): ?>
<div id="subfooter">
	<div class="container">
		<div id="subfooter-inner" class="fix">
			<div class="pad fix">
				<?php if ( wpb_option('footer-widget-ads') ): ?>
				<div class="grid one-full ads-footer">
					<ul><?php dynamic_sidebar('widget-ads-footer'); ?></ul>
				</div>
				<?php endif; ?>

				<div class="grid one-third">
					<ul><?php dynamic_sidebar('widget-footer-1'); ?></ul>
				</div>
				<div class="grid one-third">
					<ul><?php dynamic_sidebar('widget-footer-2'); ?></ul>
				</div>
				<div class="grid one-third last">
					<ul><?php dynamic_sidebar('widget-footer-3'); ?></ul>
				</div>
			</div>
		</div><!--/subfooter-inner-->
	</div><!--/container-->
</div><!--/subfooter-->
<?php endif; ?>	