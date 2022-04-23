<?php

/**
** A base module for [file] and [file*]
**/

/* form_tag handler */

wpcf7_add_form_tag( array( 'file', 'file*' ),'wpbfm_file_form_tag_handler', array( 'name-attr' => true ) );

function wpbfm_file_form_tag_handler( $tag ) {
	if ( empty( $tag->name ) ) {
		return '';
	}

	$validation_error = wpcf7_get_validation_error( $tag->name );

	$class = wpcf7_form_controls_class( $tag->type );

	if ( $validation_error ) {
		$class .= ' wpcf7-not-valid';
	}

	$atts = array();

	$atts['size'] = $tag->get_size_option( '40' );
	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

	$atts['accept'] = $filetypes = wpcf7_acceptable_filetypes(
		$tag->get_option( 'filetypes' ), 'attr' );

	if ( $tag->is_required() ) {
		$atts['aria-required'] = 'true';
	}

	$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

	$atts['type'] = 'file';
	$atts['name'] = $tag->name;

    $atts = wpcf7_format_atts( $atts );

	$html = sprintf(
        '<span class="wpcf7-form-control-wrap %1$s filewrap">
            <div class="wpbfm-file">
                <input %2$s />%3$s
                <div class="wpbfm-file__name"><span class="placeholder">Select File</span></div>
                <div class="wpbfm-file__btn">Upload File</div>
            </div>
            <div class="wpbfm-file__desc">Accepted filetypes: %4$s</div>
        </span>',
		sanitize_html_class( $tag->name ), $atts, $validation_error,  $filetypes);

	return $html;
}
