<div class="form-wrap">
<h3>Global</h3>
<p class="form-field">
	<label for="title"><?php echo __('Title', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('title', 'title', $wpform->getField('title'), array('class' => 'widefat')); ?>
	<?php echo ($wpform->hasErrors('title')) ? '<div class="error">' . $wpform->getErrors('title', 1) . '</div>' : '<div class="submitted-on">' . __('A title if you want to show one above your widget.', $this->NAME_SLUG) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed1"><?php echo __('Feed 1', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed1', 'feed1', $wpform->getField('feed1'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed1')) echo '<div class="error">' . $wpform->getErrors('feed1', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed2"><?php echo __('Feed 2', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed2', 'feed2', $wpform->getField('feed2'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed2')) echo '<div class="error">' . $wpform->getErrors('feed2', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed3"><?php echo __('Feed 3', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed3', 'feed3', $wpform->getField('feed3'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed3')) echo '<div class="error">' . $wpform->getErrors('feed3', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed4"><?php echo __('Feed 4', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed4', 'feed4', $wpform->getField('feed4'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed4')) echo '<div class="error">' . $wpform->getErrors('feed4', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed5"><?php echo __('Feed 5', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed5', 'feed5', $wpform->getField('feed5'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed5')) echo '<div class="error">' . $wpform->getErrors('feed5', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="feed6"><?php echo __('Feed 6', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('feed6', 'feed6', $wpform->getField('feed6'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('feed6')) echo '<div class="error">' . $wpform->getErrors('feed6', 1) . '</div>' ?>
</p>
<p class="form-field">
	<label for="view"><?php echo __('View', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::select('view', 'view', $this->get_views($this->plugin_path . '/views/', true), $wpform->getField('view'), array('class' => 'widefat')); ?>
	<?php echo ($wpform->hasErrors('view')) ? '<div class="error">' . $wpform->getErrors('view', 1) . '</div>' : '<div class="submitted-on">' . __('Which view you want to use from the views folder.', $this->NAME_SLUG) . '</div>' ?>
</p>
<p>
	<?php echo HtmlHelper::checkbox('random', 'random', 'true', $wpform->getField('random') == 'true'); ?>
	<label for="random" style="display: inline-block;"><?php echo __('Randomize items', $this->NAME_SLUG) ?></label>
</p>
<p class="form-field">
	<label for="number"><?php echo __('Number of items to show', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('number', 'number', $wpform->getField('number'), array('class' => 'widefat')); ?>
	<?php if($wpform->hasErrors('number')) echo '<div class="error">' . $wpform->getErrors('number', 1) . '</div>' ?>
</p>
<h3>Ajax</h3>
<p>
	<?php echo HtmlHelper::checkbox('use_ajax', 'use_ajax', 'true', $wpform->getField('use_ajax') == 'true'); ?>
	<label for="use_ajax" style="display: inline-block;"><?php echo __('Enable Ajax', $this->NAME_SLUG) ?></label>
</p>
<p class="form-field">
	<label for="ajax_refresh_time"><?php echo __('Refresh Interval', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('ajax_refresh_time', 'ajax_refresh_time', $wpform->getField('ajax_refresh_time'), array('class' => 'widefat')); ?>
	<?php echo ($wpform->hasErrors('ajax_refresh_time')) ? '<div class="error">' . $wpform->getErrors('ajax_refresh_time', 1) . '</div>' : '<div class="submitted-on">' . __('Refresh the widget items every x seconds.', $this->NAME_SLUG) . '</div>' ?>
</p>
<h3>Cache</h3>
<p class="form-field">
	<label for="cache"><?php echo __('Cache in seconds', $this->NAME_SLUG) ?>:</label>
	<?php echo HtmlHelper::textfield('cache', 'cache', $wpform->getField('cache'), array('class' => 'widefat')); ?>
	<?php echo ($wpform->hasErrors('cache')) ? '<div class="error">' . $wpform->getErrors('cache', 1) . '</div>' : '<div class="submitted-on">' . __('Number of seconds to cache feeds. Set to 0 if you don\'t want to use caching.', $this->NAME_SLUG) . '</div>' ?>
</p>
</div>