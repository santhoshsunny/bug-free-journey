<?php

/*
 * Admin menu option page
 */
add_action('admin_menu', function () {
    add_management_page( 'Cron Events', 'Cron Events', 'manage_options', 'wpbfm-cron-events', 'wpbfm_cron_events' );
});

/*
 * Admin page
 */
function wpbfm_cron_events() {
    $crons = _get_cron_array();

    $messages = array(
        '1' => __( 'Successfully executed the cron event %s.', 'dra' ),
        '2' => __( 'Failed to the execute the cron event %s.', 'dra' ),
    );
    if ( isset( $_GET['ce_message'] ) && isset( $_GET['ce_name'] ) && isset( $messages[ $_GET['ce_message'] ] ) ) {
        $hook = wp_unslash( $_GET['ce_name'] );
        $message = wp_unslash( $_GET['ce_message'] );
        $msg  = sprintf( esc_html( $messages[ $message ] ), '<strong>' . esc_html( $hook ) . '</strong>' );

        printf( '<div id="message" class="updated notice is-dismissible"><p>%s</p></div>', $msg );
    }
    $time_format = 'Y-m-d H:i:s';
?>
	<div class="wrap">
        <?php
            if ( empty( $crons ) ):
                _e( 'You don\'t have scheduled cron events at the moment.', 'dra' );
            else:
        ?>


		<h2><?php _e('Lists of active crons/scheduled events:', 'dra'); ?></h2>
		<table class="wp-list-table widefat" style="margin: 10px;">		
		<tr>
            <th><strong><?php _e('Function', 'dra'); ?></strong></th>
            <th><strong><?php _e('Next Schedule For', 'dra'); ?></strong></th>
			<th><strong><?php _e('Recurrence', 'dra'); ?></strong></th>
            <th><strong><?php _e('Actions', 'dra'); ?></strong></th>
		</tr>
        <?php if ( DISABLE_WP_CRON ): ?>
        <tr>
			<td colspan="4" style="text-align:center"><strong><?php _e('WP Cron is Disabled', 'dra'); ?></strong></span></td>
        </tr>
        <?php 
            else:
                
                foreach ( $crons as $time => $cron ) {
                    foreach ( $cron as $hook => $details ) {
                        foreach ( $details as $exec => $data ) {
                            $link = array(
                                'page'     => 'manage_options',
                                'action'   => 'run-cron',
                                'id'       => rawurlencode( $hook ),
                                'exec'     => rawurlencode( $exec ),
                                'next_run' => rawurlencode( $time ),
                            );
                            $link = add_query_arg( $link, admin_url( 'tools.php' ) );
                            $link = wp_nonce_url( $link, "run-cron_{$hook}_{$exec}" );
                            $anchor = "<a href='" . esc_url( $link ) . "'>" . esc_html__( 'Run Now', 'dra' ) . '</a>';
        ?>
                            <tr class='alternate'>
                                <td><?php echo $hook; ?></td>
                                <td>
                                    <?php 
                                        printf( '%s (%s)',
					                        esc_html( date( $time_format, $time ), $time_format ) ,
					                        esc_html( wpbfm_time_since( $time - time() ) )
                                        );
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if( isset( $data['interval'] ) ):
                                            printf( '%s (%s)',
                                                esc_html( wpbfm_time_since( $data['interval'] ) ),
                                                esc_html( $data['schedule'] )
                                            );
                                        endif;
                                    ?>
                                </td>
                                <td><?php echo $anchor; ?></td>
                            </tr>
                            <?php
                        }
                    }
                }
            endif; ?>
        </table>
        
        <?php
            endif;
        ?>
        <p>
            <strong><?php _e( 'Current Server Time', 'dra' )?>:</strong> <span><?php echo date($time_format)?></span>
        </p>
	</div>
<?php
}

function wpbfm_cron_control() {
?>
	<div class="wrap">
	</div>
<?php
}

/*
 * Handle Cron actions
 */
add_action('init', function () {
    if ( isset( $_GET['action'] ) && 'run-cron' == $_GET['action'] ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( esc_html__( 'You are not allowed to run cron events.', 'dra' ), 401 );
        }
        $id = wp_unslash( $_GET['id'] );
        $exec = wp_unslash( $_GET['exec'] );
        check_admin_referer( "run-cron_{$id}_{$exec}" );
        $redirect = array(
            'page'       => 'wpbfm-cron-events',
            'ce_message' => '1',
            'ce_name'    => rawurlencode( $id ),
        );
        if ( !wpbfm_run_cron( $id, $exec ) ) {
            $redirect['ce_message'] = '2';
        }
        wp_safe_redirect( add_query_arg( $redirect, admin_url( 'tools.php' ) ) );
        exit;
    }
});

/*
 * Handle Cron actions
 */
function wpbfm_run_cron( $hookname, $exec ) {
    $crons = _get_cron_array();
    foreach ( $crons as $time => $cron ) {
        if ( isset( $cron[ $hookname ][ $exec ] ) ) {
            $args = $cron[ $hookname ][ $exec ]['args'];
            delete_transient( 'doing_cron' );
            wp_schedule_single_event( time() - 1, $hookname, $args );
            spawn_cron();
            return true;
        }
    }
    return false;
}
