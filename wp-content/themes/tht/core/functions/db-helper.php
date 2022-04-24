<?php
/**
 * Source: https://kevdees.com/how-to-display-and-debug-all-database-queries-made-by-wordpress/
 *
 * In your wp-config.php file add the following: define( 'SAVEQUERIES', true );
 */

/**
 * Var Dump WordPress Database Queries
 */
function var_dump_database() {
    global $wpdb;
    wptht_write_log( 'var_dump_database()' );
    wptht_write_log( $wpdb->num_queries );
    wptht_write_log( $wpdb->queries );
}

add_action('shutdown', function() {
    if(WP_DEBUG || current_user_can('administrator')) {
        var_dump_database();
    }
 });