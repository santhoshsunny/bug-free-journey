<?php


/**
 * Get current URL
 *
 * @return url string
 */
function wptht_get_current_url() {
    return home_url( $_SERVER['REQUEST_URI'] );
    // global $wp;
    // return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
}

/**
 * Write to log
 * Requires WP_DEBUG === true
 *
 */
function wptht_write_log($log) {
    if (true === WP_DEBUG) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

/**
 * Get menu by location
 *
 * @return (array|WP_Term|WP_Error|null) | False if no location is provided
 */
function wptht_get_menu_by_location($location) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}

/**
 * Print Global Element Social Network Links
 *
 * @return html markup
 */
function wptht_print_social_networks() {
    $ge_social = get_field('ge_social', 'option');
    $links = '';
    foreach ($ge_social as $key => $social_link) {
        $links.= wptht_get_social_cta_html($social_link['link']);
    }
    return ($links) ? sprintf( '<h3>%s</h3><ul>%s</ul>', __('Connect With Us', 'tht'), $links) : '';
}

/**
 * Print CTA
 *
 * @return html markup | false if cta not provided
 */
function wptht_get_cta_html($cta, $css_classes = '') {
    if ( $cta ):
        return sprintf(
            '<a href="%s" class="%s" %s>%s</a>',
            esc_url( $cta['url'] ),
            $css_classes,
            !empty($cta['target']) ? 'target="_new" nofollow rel="noreferrer" rel="noopener"' : '',
            !empty($cta['title']) ? $cta['title'] : __('Text Not Provided', 'tht')
        );
    endif;

    return false;
}

/**
 * Print Social CTA
 *
 * @return html markup | false if cta not provided
 */
function wptht_get_social_cta_html($socialcta, $css_classes = '') {
    if ( $socialcta ):
        return sprintf(
            '<a href="%s" class="%s" %s><div class="icon-%s"></div></a>',
            esc_url( $socialcta['url'] ),
            $css_classes,
            !empty($socialcta['target']) ? 'target="_new" nofollow' : '',
            !empty($socialcta['title']) ? $socialcta['title'] : __('Text Not Provided', 'tht')
        );
    endif;

    return false;
}


/**
 * Prints Guttenberg Registered Blocks
 *
 */
function wptht_print_wp_registered_blocks() {
    $block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
    echo '<pre>';
    var_dump($block_types);
    echo '</pre>';
}


/**
 * custom print image.
 *
 * @return html markup
 */
function wptht_get_img_html( int $image_id, string $image_size = 'full', string $css_class = '') {
    if ($image_id):
        $img_src    = wp_get_attachment_image_src($image_id, $image_size);
        $img_srcset = wp_get_attachment_image_srcset($image_id, $image_size);
        $img_cap    = wp_get_attachment_caption($image_id);
        $img_alt    = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    else:
        // get_image_size('post-featured');
        $image_size = wptht_get_image_sizes($image_size);
        if( !$image_size ) {
            $image_size = array('width' => 300, 'height' => 300, );
        }

        $img_src    = array (
            get_template_directory_uri() . '/images/user.jpg',
            $image_size['width'],
            $image_size['height'],
        );
        $img_srcset = $img_cap = '';
        $img_alt    = __('Default image');
    endif;

    if($img_cap) {
        return sprintf(
            '<figure><img src="%s" width="%s" height="%s" alt="%s" srcset="%s" class="%s"/><figcaption>%s</figcaption></figure>',
            $img_src[0],
            $img_src[1],
            $img_src[2],
            $img_alt,
            $img_srcset,
            $css_class,
            $img_cap
        );
    }else {
        return sprintf(
            '<img src="%s" width="%s" height="%s" alt="%s" srcset="%s" class="%s"/>',
            $img_src[0],
            $img_src[1],
            $img_src[2],
            $img_alt,
            $img_srcset,
            $css_class
        );
    }

    // return sprintf(
    //     '<img src="%s" data-src="%s" width="%s" height="%s" alt="%s" data-srcset="%s" class="lazy %s"/>',
    //     get_template_directory_uri() . '/assets/images/blank.gif',
    //     $img_src[0],
    //     $img_src[1],
    //     $img_src[2],
    //     $img_alt,
    //     $img_srcset,
    //     $css_class
    // );
}

function wptht_get_img_src( int $image_id, string $image_size = 'full') {
    if ($image_id):
        $img_src    = wp_get_attachment_image_src($image_id, $image_size);
    else:
        $image_size = wptht_get_image_sizes($image_size);
        if( !$image_size ) {
            $image_size = array('width' => 300, 'height' => 300, );
        }

        $img_src    = array (
            get_template_directory_uri() . '/images/user.jpg',
            $image_size['width'],
            $image_size['height'],
        );
    endif;

    return 'style="background-image:url('.$img_src[0].');"';
}

/**
 * Get information about available image sizes
 */
function wptht_get_image_sizes( $size = '' )
{
    $wp_additional_image_sizes = wp_get_additional_image_sizes();
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width' => $wp_additional_image_sizes[ $_size ]['width'],
                'height' => $wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    }
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}

/**
 * Returns placeholder div
 */
function wptht_get_img_placeholder() {
    return '<div class="placeholderImg">' . wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ) . '</div>';
}

/**
 * This was based off the one in Symfony's Jobeet tutorial.
 *
 * @return string
 */
function wptht_slugify($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
    return 'n-a';
    }

    return $text;
}

/**
 * Recursively get taxonomy hierarchy
 *
 * @param int|WP_Term $term
 *
 * @return array
 */
function wptht_get_taxonomy_hierarchy( $term, $taxonomy = 'category' ) {
    if ( empty( $term ) ) {
        return new WP_Error( 'invalid_term', __( 'Empty Term.' ) );
    }

    if ( $term instanceof WP_Term ) {
        $term_id = $term->term_id;
        $taxonomy = $term->taxonomy;
    } else {
        $term_id = $term;
    }
    $parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );
    array_unshift( $parents, $term_id );
    return array_reverse( $parents );
}



/**
 * Get post excerpt by char length
 *
 * @param int $post_id
 *
 * @return array | false
 */
function wptht_get_the_excerpt_max_charlength($post_id, $charlength) {
    $excerpt = get_the_excerpt($post_id);

    return wptht_substring($excerpt, $charlength);
}

/**
 * Get post excerpt by char length
 *
 * @param int $post_id
 *
 * @return array | false
 */
function wptht_substring($text, $charlength) {
    $charlength++;
    $out = $text;
	if ( mb_strlen( $text ) > $charlength ) {
		$subex = mb_substr( $text, 0, $charlength - 5 );
		$exwords = explode( ' ', $text );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$out = mb_substr( $subex, 0, $excut );
		} else {
			$out = $subex;
		}
		$out.= '[...]';
    }
    return $out;
}

/**
 * Reset Email content type to standard text/html
 *
 */
function wptht_set_email_content_type() {
    return 'text/html';
}

function wptht_get_attachment_by_post_name( $post_name ) {
    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', trim( $post_name ) );
    $args = array(
        'posts_per_page' => 1,
        'post_type'         => 'attachment',
        'post_status'       => 'inherit',
        // 'name'           => trim( $post_name ),
        's'              => $withoutExt,
    );
    $get_attachment = new WP_Query( $args );

    if ( ! $get_attachment || ! isset( $get_attachment->posts, $get_attachment->posts[0] ) ) {
        return false;
    }

    return $get_attachment->posts[0];
}

/**
 * Time information
 *
 * @return true | false if fail
 */
function wptht_time_since( $since ) {
    // Array of time period chunks.
    $chunks = array(
        /* translators: 1: The number of years in an interval of time. */
        array( 60 * 60 * 24 * 365, _n_noop( '%s year', '%s years', 'tht' ) ),
        /* translators: 1: The number of months in an interval of time. */
        array( 60 * 60 * 24 * 30, _n_noop( '%s month', '%s months', 'tht' ) ),
        /* translators: 1: The number of weeks in an interval of time. */
        array( 60 * 60 * 24 * 7, _n_noop( '%s week', '%s weeks', 'tht' ) ),
        /* translators: 1: The number of days in an interval of time. */
        array( 60 * 60 * 24, _n_noop( '%s day', '%s days', 'tht' ) ),
        /* translators: 1: The number of hours in an interval of time. */
        array( 60 * 60, _n_noop( '%s hour', '%s hours', 'tht' ) ),
        /* translators: 1: The number of minutes in an interval of time. */
        array( 60, _n_noop( '%s minute', '%s minutes', 'tht' ) ),
        /* translators: 1: The number of seconds in an interval of time. */
        array( 1, _n_noop( '%s second', '%s seconds', 'tht' ) ),
    );

    if ( $since <= 0 ) {
        return __( 'now', 'tht' );
    }

    /**
     * We only want to output two chunks of time here, eg:
     * x years, xx months
     * x days, xx hours
     * so there's only two bits of calculation below:
     */
    $j = count( $chunks );

    // Step one: the first chunk.
    for ( $i = 0; $i < $j; $i++ ) {
        $seconds = $chunks[ $i ][0];
        $name = $chunks[ $i ][1];

        // Finding the biggest chunk (if the chunk fits, break).
        $count = floor( $since / $seconds );
        if ( $count ) {
            break;
        }
    }

    // Set output var.
    $output = sprintf( translate_nooped_plural( $name, $count, 'tht' ), $count );

    // Step two: the second chunk.
    if ( $i + 1 < $j ) {
        $seconds2 = $chunks[ $i + 1 ][0];
        $name2 = $chunks[ $i + 1 ][1];
        $count2 = floor( ( $since - ( $seconds * $count ) ) / $seconds2 );
        if ( $count2 ) {
            // Add to output var.
            $output .= ' ' . sprintf( translate_nooped_plural( $name2, $count2, 'tht' ), $count2 );
        }
    }

    return $output;
}

function fall_back_menu($args){
    // extract( $args );
var_dump($args);
    return;
}
