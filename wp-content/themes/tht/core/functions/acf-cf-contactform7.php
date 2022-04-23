<?php

function include_field_types_groups($version)
{
    class acf_field_groups extends acf_field
    {


        /*
        *  __construct
        *
        *  This function will setup the field type data
        *
        *  @type	function
        *  @date	5/03/2014
        *  @since	5.0.0
        *
        *  @param	n/a
        *  @return	n/a
        */
        function __construct()
        {

            /*
            *  name (string) Single word, no spaces. Underscores allowed
            */
            $this->name = 'contactform7';


            /*
            *  label (string) Multiple words, can include spaces, visible when selecting a field type
            */
            $this->label = __('ContactForm7', 'acf-groups');


            /*
            *  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
            */
            $this->category = 'relational';


            /*
            *  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
            */
            $this->defaults = array();


            /*
            *  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
            *  var message = acf._e('contactform7', 'error');
            */
            $this->l10n = array(
                'error'    => __('Error! Please enter a higher value', 'acf-groups'),
            );


            // do not delete!
            parent::__construct();
        }

        /*
        *  render_field()
        *
        *  Create the HTML interface for your field
        *
        *  @param	$field (array) the $field being rendered
        *
        *  @type	action
        *  @since	1.0.0
        *  @date	10/29/19
        *
        *  @param	$field (array) the $field being edited
        *  @return	n/a
        */
        function render_field($field)
        {
            $field['multiple'] = isset($field['multiple']) ? $field['multiple'] : false;
            $field['disable'] = isset($field['disable']) ? $field['disable'] : false;
            // $field['allow_null'] = isset($field['allow_null']) ? $field['allow_null'] : 0;

            // Add multiple select functionality as required
            $multiple = '';
            if ($field['multiple'] == '1') {
                $multiple = ' multiple="multiple" size="5" ';
                $field['name'] .= '[]';
            }

            $posts = get_posts(array(   //retrieving the contact form list
                'post_type'     => 'wpcf7_contact_form',
                'numberposts'   => -1,
                'order_by' => 'name',
                'order'    => 'ASC'
            ));

            // Begin HTML select field
            echo '<select  class="' . $field['class'] . ' groups-select" name="' . $field['name'] . '" ' . $multiple . ' >';
            foreach ($posts as $k => $post) {
                $key = $post->ID;
                $value = $post->post_title;
                $selected = '';

                // Mark form as selected as required
                if (is_array($field['value'])) {
                    // If the value is an array (multiple select), loop through values and check if it is selected
                    if (in_array($key, $field['value'])) {
                        $selected = 'selected="selected"';
                    }
                    //Disable form selection as required
                    if (in_array(($k + 1), $field['disable'])) {
                        $selected = 'disabled="disabled"';
                    }
                } else {
                    // If not a multiple select, just check normaly
                    if ($key == $field['value']) {
                        $selected = 'selected="selected"';
                    }
                    if (is_array($field['disable']) && in_array(($k + 1), $field['disable'])) {
                        $selected = 'disabled="disabled"';
                    }
                }
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            echo '</select>';
        }


        /*
        *  format_value()
        *
        *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
        *
        *  @type	filter
        *  @since	3.6
        *  @date	23/01/13
        *
        *  @param	$value (mixed) the value which was loaded from the database
        *  @param	$post_id (mixed) the $post_id from which the value was loaded
        *  @param	$field (array) the field array holding all the field options
        *
        *  @return	$value (mixed) the modified value
        */
        function format_value( $value, $post_id, $field ) {
            
            // bail early if no value
            if( empty($value) ) {
                return $value;
            }
            

            return do_shortcode('[contact-form-7 id="' . $value . '" ]');
        }
    }

    // create field
    new acf_field_groups();
}
add_action('acf/include_field_types', 'include_field_types_groups', 20);  // v5
