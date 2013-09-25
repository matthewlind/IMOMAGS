<?php

/**
 * imo settings api wrapper class
 */
class imo_state_rankings {

    /**
     * settings sections array
     *
     * @var array
     */
    private $settings_sections = array();

    /**
     * Settings fields array
     *
     * @var array
     */
    private $settings_fields = array();

    /**
     * Singleton instance
     *
     * @var object
     */
    private static $_instance;

    public function __construct() {

    }

    public static function getInstance() {
        if ( !self::$_instance ) {
            self::$_instance = new imo_state_rankings();
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
     *
     * Usually this should be called at `admin_init` hook.
     *
     * This function gets the initiated settings sections and fields. Then
     * registers them to WordPress and ready for use.
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
                    'state' => $option['state'],
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

    function callback_ranking_record( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="ranking-column %2$s_%5$s" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value, $args['state'] );
        echo $html;
    }
    function callback_ranking_record_textarea( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<textarea class="ranking-column %2$s_%5$s" id="%2$s[%3$s]" name="%2$s[%3$s]">%4$s</textarea>', $size, $args['section'], $args['id'], $value, $args['state'] );
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

        echo $html;
    }

    /**
     * Displays a multicheckbox a settings field
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
     * Displays a multicheckbox a settings field
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
    function show_navigation() {
        $html = '<h2 class="nav-tab-wrapper">';

        foreach ($this->settings_sections as $tab) {
            $html .= sprintf( '<a href="#%1$s" class="nav-tab" id="%1$s-tab">%2$s</a>', $tab['id'], $tab['title'] );
        }

        $html .= '</h2>';

        echo $html;
    }

    /**
     * Show the section settings forms
     *
     * This function displays every sections in a different form
     */
    function show_forms() {
			$week = 1;
			$weeks = 12;
			$stateRows = '';
			$stateRowsJS = '';
			$states = array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');
			while($week <= $weeks) {
				$count = 1;
				foreach($states as $state) {
					$altColor = '';
					if($count & 1) $altColor = ' alt-color';
					$stateName= $state;
					$state = str_replace(' ', '_', strtolower($state));
					$stateRows .= '<div class="state-row week_'.$week.'_row_'.$state.$altColor.' week_'.$week.'"><span class="state-name">'.$stateName.'</span></div>';
					$stateRowsJS .= '$(".week_'.$week.'_data_'.$state.'").appendTo(".week_'.$week.'_row_'.$state.'");';
					$stateRowsJS .= '$(".week_'.$week.'_row_'.$state.'").append("<div class=\"clear\"></div>");';
					$stateRowsJS .= '$(".week_'.$week.'").appendTo("#week_'.$week.'_data .state-rows-insert");';
					$count++;
				}
				$week++;
			}
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			<?php echo $stateRowsJS; ?>
			$('.form-table').hide(function(){
				$('.loading-box').remove();
				$('.postbox').css({'visibility':'visible'});
			}); 
			
			//Persistant Header Script 
			   var clonedHeaderRow;
			   adminBarHeight = $('#wpadminbar').height();
			   $(".persist-area").each(function() {
				   clonedHeaderRow = $(".persist-header", this);
				   clonedHeaderRow
					 .before(clonedHeaderRow.clone())
					 .css("width", clonedHeaderRow.width())
					 .addClass("floatingHeader");
					 
			   });
			   $(".floatingHeader").css({"top":0 + adminBarHeight});
			   $(window)
				.scroll(UpdateTableHeaders)
				.trigger("scroll");
			
			function UpdateTableHeaders() {
			   $(".persist-area").each(function() {		   
				   var el             = $(this),
					   offset         = el.offset(),
					   scrollTop      = $(window).scrollTop(),
					   floatingHeader = $(".floatingHeader", this)
				   
				   if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
					   floatingHeader.css({
						"visibility": "visible"
					   });
				   } else {
					   floatingHeader.css({
						"visibility": "hidden"
					   });      
				   };
			   });
			}
		});
		</script>
        
        <div class="metabox-holder">
       		<div class="loading-box">
            	Loading...
            </div>
            <div class="postbox">
            <div class="state-rows">
				<?php echo $stateRows; ?>
            </div>
                <?php foreach ($this->settings_sections as $form) { ?>
                    <div id="<?php echo $form['id']; ?>" class="group persist-area">
                        <form method="post" action="options.php">
                        <div class="state-rows-column-header persist-header">
							<span>Rank</span><span>Trend</span><span>Notes</span>
							<input type="submit" name="submit" id="submit" class="button-primary submit2" value="Save Changes">
                        </div>
                        <div class="state-rows-insert"></div>

                            <?php settings_fields( $form['id'] ); //the form tags, only used with form ?>
                            <?php do_settings_sections( $form['id'] ); ?>
                        </form>
                    </div>
                <?php } ?>
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
