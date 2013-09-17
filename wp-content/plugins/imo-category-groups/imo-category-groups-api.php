<?php

/**
 * IMO Category Groups Wrapper Class for the WordPress Settings API
 */
class imo_settings_api {

    private $settings_sections = array();
    private $settings_fields = array();
    private static $_instance;

    public function __construct() {

    }

    public static function getInstance() {
        if ( !self::$_instance ) {
            self::$_instance = new imo_settings_api();
        }

        return self::$_instance;
    }

    /**
     * Set settings sections
     *
     * @param array $sections setting sections array
     */
    function set_sections( $sections ) {
        $this->settings_sections = $sections;
    }

    /**
     * Set settings fields
     *
     * @param array $fields settings fields array
     */
    function set_fields( $fields ) {
        $this->settings_fields = $fields;
    }

    /**
     * Initialize and registers the settings sections and fileds to WordPress
     */
    function admin_init() {

        //register settings sections
        foreach ($this->settings_sections as $section) {
            if ( false == get_option( $section['id'] ) ) {
                add_option( $section['id'] );
            }

            add_settings_section( $section['id'], $section['title'], '__return_false', $section['id'] );
        }

        //register settings fields
        foreach ($this->settings_fields as $section => $field) {
            foreach ($field as $option) {
                $args = array(
                    'id' => $option['name'],
                    'desc' => $option['desc'],
                    'name' => $option['label'],
                    'section' => $section,
                    'size' => isset( $option['size'] ) ? $option['size'] : null,
                    'options' => isset( $option['options'] ) ? $option['options'] : '',
                    'std' => isset( $option['default'] ) ? $option['default'] : ''
                );
                add_settings_field( $section . '[' . $option['name'] . ']', $option['label'], array($this, 'callback_' . $option['type']), $section, $section, $args );
            }
        }

        // creates our settings in the options table
        foreach ($this->settings_sections as $section) {
            register_setting( $section['id'], $section['id'] );
        }
    }

    /**
     * Displays a text field for a settings field
     *
     * @param array $args settings field args
     */
    function callback_text( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<span class="description"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a checkbox for a settings field
     *
     * @param array $args settings field args
     */
    function callback_checkbox( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );

        $html = sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s]" name="%1$s[%2$s]" value="on"%4$s />', $args['section'], $args['id'], $value, checked( $value, 'on', false ) );
        $html .= sprintf( '<label for="%1$s[%2$s]"> %3$s</label>', $args['section'], $args['id'], $args['desc'] );

		$html .= sprintf( '
	
		' );


        echo $html;
    }

    /**
	 * No longer used for IMO cats in favor of single checkboxes
	 *
     * Displays a multicheckbox a settings field, modified for Category Child CSS
     *
     * @param array $args settings field args
     */
    function callback_multicheck( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ($args['options'] as $key => $label) {
            $checked = isset( $value[$key] ) ? $value[$key] : '0';
            $html .= sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s][%3$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $checked, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s</label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a radio button a settings field
     *
     * @param array $args settings field args
     */
    function callback_radio( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ($args['options'] as $key => $label) {
            $html .= sprintf( '<input type="radio" class="radio" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s</label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a selectbox for a settings field
     *
     * @param array $args settings field args
     */
    function callback_select( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<select class="%1$s" name="%2$s[%3$s]" id="%2$s[%3$s]">', $size, $args['section'], $args['id'] );
        foreach ($args['options'] as $key => $label) {
            $html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
        }
        $html .= sprintf( '</select>' );
        $html .= sprintf( '<span class="description"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a textarea for a settings field
     *
     * @param array $args settings field args
     */
    function callback_textarea( $args ) {

        $value = esc_textarea( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<textarea rows="5" cols="55" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]">%4$s</textarea>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<br><span class="description"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Get the value of a settings field
     *
     * @param string $option settings field name
     * @param string $section the section name this field belongs to
     * @param string $default default text if it's not found
     * @return string
     */
	 
	function get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    }

    /**
     * Show navigations as tab
     *
     * Shows all the settings section labels as tab
     */
	function show_header() {
								echo '<form id="imo_tab_settings_form" method="post" action="options.php" style="float:left;display:inline-block;">';
								echo '<div style="display:none;">';
								settings_fields( 'imo_tab_settings' );
                            	do_settings_sections( 'imo_tab_settings' );
								echo '</div>';			
								$settings = get_option('imo_tab_settings');
								$tab_count_plus_one = intval($settings['imo_tab_count'])+1;
								echo '<input type="hidden" id="imo_tab_settings[imo_tab_count]" name="imo_tab_settings[imo_tab_count]" value="'.$tab_count_plus_one.'">';
								echo '<input type="submit" name="submit" id="submit" class="button button-primary" value="Create Meta Box">';
								echo '</form>';
								
								echo '<form id="imo_tab_settings_form_delete" method="post" action="options.php" style="float:left;margin-left: 15px;display:inline-block;">';
								echo '<div style="display:none;">';
								settings_fields( 'imo_tab_settings' );
                            	do_settings_sections( 'imo_tab_settings' );
								echo '</div>';				
								$settings = get_option('imo_tab_settings');
								$tab_count_minus_one = intval($settings['imo_tab_count'])-1;
								$tab_to_delete = $settings['imo_group_delete'];
								delete_option($tab_to_delete);
								echo '<input type="hidden" id="imo_tab_settings[imo_group_delete]" name="imo_tab_settings[imo_group_delete]" value="imo_tab_'.$settings['imo_tab_count'].'">';
								echo '<input type="hidden" id="imo_tab_settings[imo_tab_count]" name="imo_tab_settings[imo_tab_count]" value="'.$tab_count_minus_one.'">';
								echo '<input type="submit" name="submit" id="submit" class="button button-secondary" value="Delete Last Box">';
								echo '</form><div style="clear:both;"></div>';
	}
    function show_navigation() {
        $html = '<h2 class="nav-tab-wrapper">';

        foreach ($this->settings_sections as $tab) {
			if($tab['id'] != 'imo_tab_settings') {
			$tab_options = get_option($tab['id']);
			$tab_title = $tab_options['imo_group_title'];
			$tab_title = str_replace(' ', '&nbsp;', $tab_title);
			if(!$tab_title) $tab_title = $tab['title'];
            $html .= sprintf( '<a href="#%1$s" class="nav-tab" id="%1$s-tab">%2$s</a>', $tab['id'], $tab_title );
			}
		}

        $html .= '</h2>';

        echo $html;
    }

    /**
     * Show the section settings forms
     *
	 * JS here makes it so a categorey can only be check in one group and children are checked ith parents
	 *
     * This function displays every sections in a different form
     */
    function show_forms() {
        ?>
        
    <script type="text/javascript">
		jQuery(document).ready(function($) {
	<?php
	$tab_count = count($this->settings_sections)-1;
	while($tab_count > 0){
	?>
	<?php	
	$imo_all_cats = get_categories(
		array(
			'type'			=> 'post',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 0
		)
	);
	foreach($imo_all_cats as $category) {
	?>	
			$("input[type='checkbox'][name*='<?php echo 'imo_tab_'.$tab_count.'['.$category->cat_ID.']'; ?>']").click(function() {
				if (this.checked) {
					$("input[type='checkbox'][name*='<?php echo '['.$category->cat_ID.']'; ?>']").attr("checked", false);
					$(".<?php echo $category->cat_ID.'-child'; ?>").attr("checked", false);
					$(this).attr("checked", true);
					$(".child-of-<?php echo 'imo_tab_'.$tab_count.'-'.$category->cat_ID; ?>").attr("checked", true);
				} else {
					$(".child-of-<?php echo 'imo_tab_'.$tab_count.'-'.$category->cat_ID; ?>").attr("checked", false);
				}
			});
	<?php } 
	$tab_count--;
	} ?>
	
	<?php $tab_count = count($this->settings_sections)-1;?>
	$("<?php while($tab_count > 0) { echo '#imo_tab_'.$tab_count.'_form, '; $tab_count --;}?>#imo-null-div").submit(function() {
			$('.form-submit-success').hide();
			$('.form-submit-saving').fadeIn();
			$('.save-top').css( "margin-top", "7px" );
	<?php
	$tab_count = count($this->settings_sections)-1;
	while($tab_count > 0) {
			echo '
			var form_data'.$tab_count.' = $("#imo_tab_'.$tab_count.'_form input").serializeArray();
			$.post( "options.php", form_data'.$tab_count.' ).error(function() {
				$(".form-submit-saving").hide();
   			 }).success( function() {
				$(".form-submit-saving").hide();
				$(".form-submit-success").fadeIn( function(){
					location.reload();
				}); 
			});
			';
	$tab_count--;
	} ?>	

		return false; 
	});
	
	
	
	
	});
	</script>
        <div class="metabox-holder">
            <div class="postbox">

                <?php
                foreach ($this->settings_sections as $form) {
					$options = get_option($form['id']);
					if($form['id'] != 'imo_tab_settings') {
				?>
             	<div id="<?php echo $form['id']; ?>" class="group">
                        <form id="<?php echo $form['id']; ?>_form" method="post" action="options.php">
							<div style="float: right;margin: -72px 0 0 0;">
                            <input type="submit" name="submit" id="submit" class="button-primary save-top" value="Save Changes">
                            </div>
            				<div class="form-submit-saving imo-success-or-error">Saving Data</div>
               				<div class="form-submit-success imo-success-or-error">Reloading</div>
                            <div class="clear"></div>

                            <?php 
							//Auto Form HTML
							settings_fields( $form['id'] );
                            //do_settings_sections( $form['id'] );
							?>
                            
<!--- Manual Form HTML -->
<h4>Group Name</h4><br/>
<input type="text" class="regular-text title-input" id="<?php echo $form['id'];?>[imo_group_title]" name="<?php echo $form['id'];?>[imo_group_title]" value="<?php echo $options['imo_group_title'];?>">
<div class="clear"></div>
<h4>Group Categories</h4><br/>

<?php
$imo_group_cats = '';
		$imo_get_cats = get_categories(
			array(
				'type'			=> 'post',
				'parent'		=> 0,
				'orderby'		=> 'name',
				'order'			=> 'ASC',
				'hide_empty'	=> 0
			)
		);

		$imo_group_cats .= '<div class="cat-list">';
		
		//For categories without children
		$cat_count = 1;
		foreach($imo_get_cats as $category) {
			$options = get_option($form['id']);
			$imo_get_child_cats = get_categories(
				array(
					'type'			=> 'post',
					'parent'		=> $category->cat_ID,
					'orderby'		=> 'name',
					'order'			=> 'ASC',
					'hide_empty'	=> 0
				)
			);
			if(count($imo_get_child_cats) == 0) {
				$imo_group_cats .= '<input type="checkbox" class="checkbox" id="'.$form['id'].'['.$category->cat_ID.']" name="'.$form['id'].'['.$category->cat_ID.']" value="on"'.checked( 'on', $options[$category->cat_ID], false ).'/> <b>'.$category->cat_name.'</b><br/><br/>';
			}
		}
		$imo_group_cats .= '</div>';
		
		
		//For categories with children
		foreach($imo_get_cats as $category) {
			$options = get_option($form['id']);
			$imo_get_child_cats = get_categories(
				array(
					'type'			=> 'post',
					'parent'		=> $category->cat_ID,
					'orderby'		=> 'name',
					'order'			=> 'ASC',
					'hide_empty'	=> 0
				)
			);
			if(count($imo_get_child_cats) > 0) {
				$imo_group_cats .= '<div class="cat-list">';
				$imo_group_cats .= '<input type="checkbox" class="checkbox" id="'.$form['id'].'['.$category->cat_ID.']" name="'.$form['id'].'['.$category->cat_ID.']" value="on"'.checked( 'on', $options[$category->cat_ID], false ).'/> <b>'.$category->cat_name.'</b><br/><br/>';
				foreach($imo_get_child_cats as $child_category) {
					$imo_group_cats .= '<input type="checkbox" class="checkbox child-checkbox child-of-'.$form['id'].'-'.$category->cat_ID.' '.$category->cat_ID.'-child" id="'.$form['id'].'['.$child_category->cat_ID.']" name="'.$form['id'].'['.$child_category->cat_ID.']" value="on" '.checked( 'on', $options[$child_category->cat_ID], false ).'/> '.$child_category->cat_name.'<br/><br/>';
				}	
				$imo_group_cats .= '</div>';
				$cat_count++;
				if($cat_count % 6 == 0) $imo_group_cats .= '<div class="clear"></div>';
			}
		}
		
		
		
		$imo_group_cats .= '<div class="clear"></div>';
		echo $imo_group_cats;
?>
<!--- End Manual Form HTML -->





                            <div style="padding-left: 10px">
                                <?php submit_button(); ?>
                            </div>
                        </form>
                    </div>
                <?php } } ?>
        	</div>
        </div>
        <?php
        $this->script();
    }

    /**
     * Tabbable JavaScript codes
     *
     * This code uses localstorage for displaying active tabs
     */
    function script() {
        ?>
        <script>
            jQuery(document).ready(function($) {
                // Switches option sections
                $('.group').hide();
                var activetab = '';
                if (typeof(localStorage) != 'undefined' ) {
                    activetab = localStorage.getItem("activetab");
                }
                if (activetab != '' && $(activetab).length ) {
                    $(activetab).fadeIn();
                } else {
                    $('.group:first').fadeIn();
                }
                $('.group .collapsed').each(function(){
                    $(this).find('input:checked').parent().parent().parent().nextAll().each(
                    function(){
                        if ($(this).hasClass('last')) {
                            $(this).removeClass('hidden');
                            return false;
                        }
                        $(this).filter('.hidden').removeClass('hidden');
                    });
                });

                if (activetab != '' && $(activetab + '-tab').length ) {
                    $(activetab + '-tab').addClass('nav-tab-active');
                }
                else {
                    $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
                }
                $('.nav-tab-wrapper a').click(function(evt) {
                    $('.nav-tab-wrapper a').removeClass('nav-tab-active');
                    $(this).addClass('nav-tab-active').blur();
                    var clicked_group = $(this).attr('href');
                    if (typeof(localStorage) != 'undefined' ) {
                        localStorage.setItem("activetab", $(this).attr('href'));
                    }
                    $('.group').hide();
                    $(clicked_group).fadeIn();
                    evt.preventDefault();
                });
            });
        </script>
        <?php
    }

}