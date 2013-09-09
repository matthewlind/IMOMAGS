<?php
/**
 * This page shows the procedural or functional example
 *
 * OOP way example is given on the main plugin file.
 *
 * @author Tareq Hasan <tareq@imo.com>
 */


/**
 * Registers settings section and fields
 */
function imo_admin_init() {

    $sections = array(
        array(
            'id' => 'imo_basics',
            'title' => __( 'Basic Settings', 'imo' )
        ),
        array(
            'id' => 'imo_advanced',
            'title' => __( 'Advanced Settings', 'imo' )
        ),
        array(
            'id' => 'imo_others',
            'title' => __( 'Other Settings', 'wpuf' )
        )
    );

    $fields = array(
        'imo_basics' => array(
            array(
                'name' => 'text',
                'label' => __( 'Text Input', 'imo' ),
                'desc' => __( 'Text input description', 'imo' ),
                'type' => 'text',
                'default' => 'Title'
            ),
            array(
                'name' => 'textarea',
                'label' => __( 'Textarea Input', 'imo' ),
                'desc' => __( 'Textarea description', 'imo' ),
                'type' => 'textarea'
            ),
            array(
                'name' => 'checkbox',
                'label' => __( 'Checkbox', 'imo' ),
                'desc' => __( 'Checkbox Label', 'imo' ),
                'type' => 'checkbox'
            ),
            array(
                'name' => 'radio',
                'label' => __( 'Radio Button', 'imo' ),
                'desc' => __( 'A radio button', 'imo' ),
                'type' => 'radio',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'name' => 'multicheck',
                'label' => __( 'Multile checkbox', 'imo' ),
                'desc' => __( 'Multi checkbox description', 'imo' ),
                'type' => 'multicheck',
                'options' => array(
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'Three',
                    'four' => 'Four'
                )
            ),
            array(
                'name' => 'selectbox',
                'label' => __( 'A Dropdown', 'imo' ),
                'desc' => __( 'Dropdown description', 'imo' ),
                'type' => 'select',
                'default' => 'no',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            )
        ),
        'imo_advanced' => array(
            array(
                'name' => 'text',
                'label' => __( 'Text Input', 'imo' ),
                'desc' => __( 'Text input description', 'imo' ),
                'type' => 'text',
                'default' => 'Title'
            ),
            array(
                'name' => 'textarea',
                'label' => __( 'Textarea Input', 'imo' ),
                'desc' => __( 'Textarea description', 'imo' ),
                'type' => 'textarea'
            ),
            array(
                'name' => 'checkbox',
                'label' => __( 'Checkbox', 'imo' ),
                'desc' => __( 'Checkbox Label', 'imo' ),
                'type' => 'checkbox'
            ),
            array(
                'name' => 'radio',
                'label' => __( 'Radio Button', 'imo' ),
                'desc' => __( 'A radio button', 'imo' ),
                'type' => 'radio',
                'default' => 'no',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'name' => 'multicheck',
                'label' => __( 'Multile checkbox', 'imo' ),
                'desc' => __( 'Multi checkbox description', 'imo' ),
                'type' => 'multicheck',
                'default' => array('one' => 'one', 'four' => 'four'),
                'options' => array(
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'Three',
                    'four' => 'Four'
                )
            ),
            array(
                'name' => 'selectbox',
                'label' => __( 'A Dropdown', 'imo' ),
                'desc' => __( 'Dropdown description', 'imo' ),
                'type' => 'select',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            )
        ),
        'imo_others' => array(
            array(
                'name' => 'text',
                'label' => __( 'Text Input', 'imo' ),
                'desc' => __( 'Text input description', 'imo' ),
                'type' => 'text',
                'default' => 'Title'
            ),
            array(
                'name' => 'textarea',
                'label' => __( 'Textarea Input', 'imo' ),
                'desc' => __( 'Textarea description', 'imo' ),
                'type' => 'textarea'
            ),
            array(
                'name' => 'checkbox',
                'label' => __( 'Checkbox', 'imo' ),
                'desc' => __( 'Checkbox Label', 'imo' ),
                'type' => 'checkbox'
            ),
            array(
                'name' => 'radio',
                'label' => __( 'Radio Button', 'imo' ),
                'desc' => __( 'A radio button', 'imo' ),
                'type' => 'radio',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'name' => 'multicheck',
                'label' => __( 'Multile checkbox', 'imo' ),
                'desc' => __( 'Multi checkbox description', 'imo' ),
                'type' => 'multicheck',
                'options' => array(
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'Three',
                    'four' => 'Four'
                )
            ),
            array(
                'name' => 'selectbox',
                'label' => __( 'A Dropdown', 'imo' ),
                'desc' => __( 'Dropdown description', 'imo' ),
                'type' => 'select',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            )
        )
    );

    $settings_api = IMO_Settings_API::getInstance();

    //set sections and fields
    $settings_api->set_sections( $sections );
    $settings_api->set_fields( $fields );

    //initialize them
    $settings_api->admin_init();
}

add_action( 'admin_init', 'imo_admin_init' );

/**
 * Register the plugin page
 */
function imo_admin_menu() {
    add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test', 'imo_plugin_page' );
}

add_action( 'admin_menu', 'imo_admin_menu' );

/**
 * Display the plugin settings options page
 */
function imo_plugin_page() {
    $settings_api = IMO_Settings_API::getInstance();

    echo '<div class="wrap">';
    settings_errors();

    $settings_api->show_navigation();
    $settings_api->show_forms();

    echo '</div>';
}
