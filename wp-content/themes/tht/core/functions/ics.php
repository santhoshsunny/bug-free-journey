<?php
/// Source: https://gist.github.com/Jany-M/af50d5c4a0eec2692734d76383ed4dd8
// Add a custom endpoint "calendar"

function add_calendar_feed()
{
	add_feed('calendar', 'export_ics');
    // Only uncomment these 2 lines the first time you load this script, to update WP rewrite rules
    // global $wp_rewrite;
    // $wp_rewrite->flush_rules( false );
}
add_action('init', 'add_calendar_feed');

// Escapes a string of characters
function ics_escape_string($string) {
    return preg_replace('/([\,;])/','\\\$1', $string);
}

// Cut it
function ics_shorter_version($string, $lenght) {
    if (strlen($string) >= $lenght) {
        return substr($string, 0, $lenght);
    } else {
        return $string;
    }
}

function ics_get_cal_head($args = array()) {
    $defaults = array(
        'BEGIN' => 'VCALENDAR',
        'VERSION' => '2.0',
        'PRODID' => '-//Microsoft Corporation//Outlook 16.0 MIMEDIR//EN',
        'CALSCALE' => 'GREGORIAN',
        // 'TZ' => get_option('gmt_offset'),
        // 'X-WR-CALNAME' => 'Private',
        // 'X-APPLE-CALENDAR-COLOR' => '#FF2968',
        'X-WR-CALDESC' => '',
		'METHOD' => 'PUBLISH',
    );
    return array_merge( $defaults, $args );
}

function ics_get_cal_foot($args = array()) {
    $defaults = array(
		'END' => 'VCALENDAR',
    );
    return array_merge( $defaults, $args );
}

function ics_get_event_data($args = array()) {
    $defaults = array(
		'BEGIN' => 'VEVENT',
		'CREATED' => '',
		'LAST-MODIFIED' => '',
		'UID' => '',
        'SEQUENCE' => '',
        'STATUS' => '',
        'ORGANISER' => '',
        'ATTENDEE(S)' => '',
		'SUMMARY' => '',
		'DTSTART' => '',
		'DTEND' => '',
        'DTSTART_TZ' => '',
        'DTEND_TZ' => '',
		'DTSTAMP' => '',
		'DURATION' => '',
		'LOCATION' => '',
		'DESCRIPTION' => '',
		'ORGANIZER' => '',
		'URL;VALUE=URI' => '',
		'TRANSP' => 'OPAQUE',
		// 'BEGIN' => 'VALARM',
		// 'ACTION' => '',
		// 'TRIGGER;VALUE=DATE-TIME' => '',
		// 'DESCRIPTION' => 'Reminder for',
		// 'END' => 'VALARM',
		'END' => 'VEVENT',
    );
    return array_merge( $defaults, $args );
}

function ics_array_to_ics($array) {
    $output = '';
    $eol = "\r\n";
    foreach ($array as $key => $value) {
        if( $value ) {
            $output.= sprintf(
                '%s:%s%s',
                $key,
                $value,
                $eol
            );
        }
    }
    return $output;
}

function ics_get_cal_data($event) {
    $output = ics_array_to_ics( ics_get_cal_head() );
    $output.= ics_array_to_ics( $event );
    $output.= ics_array_to_ics( ics_get_cal_foot() );
    return $output;
}

function export_ics($post_id = null)
{
    /*  For a better understanding of ics requirements and time formats
        please check https://gist.github.com/jakebellacera/635416   */
    // Query the event
    $the_event = new WP_Query(array(
        'p' => $_REQUEST['id'],
        // 'p' => $post_id,
    ));
    $events = array();

    if($the_event->have_posts()) :
        while($the_event->have_posts()) : $the_event->the_post();

            //Give the iCal export a filename
            $filename = urlencode( get_the_title().'-ical-' . date('Y-m-d') . '.ics' );
            
            /*  The correct date format, for ALL dates is date_i18n('Ymd\THis\Z',time(), true)
                So if your date is not in this format, use that function    */
            $uid = get_the_ID();

            $start_date = get_field('post_event_start');
            $end_date = get_field('post_event_end');
            $organizer = get_field('post_event_organizer');
            $location = get_field('post_event_where');
            $url = get_the_permalink();
            $summary = get_the_title();
            $content = trim(preg_replace('/\s\s+/', ' ', get_the_excerpt())); // removes newlines and double spaces

            $args = array(
                'CREATED'      => get_post_time('Ymd\THis\Z', true, $uid ),
                'UID'          => $uid,
                // 'DTSTAMP'      => date_i18n('Ymd\THis\Z',time(), true),
                'DTSTAMP'      => date_i18n('Ymd\THis',time(), true),
                'DTSTART'      => ($start_date) ? date_i18n("Ymd\THis", strtotime($start_date['datetime']) ) : '',
                'DTEND'        => ($end_date) ? date_i18n("Ymd\THis", strtotime($end_date['datetime']) ) : '',
                'DTSTART_TZ'   => ($start_date) ? date_i18n("Ymd\THis\Z", strtotime($start_date['datetime']) ) : '',
                'DTEND_TZ'     => ($end_date) ? date_i18n("Ymd\THis\Z", strtotime($end_date['datetime']) ) : '',
                'LOCATION'     => ics_escape_string($location),
                'SUMMARY'      => ics_escape_string($summary),
                'DESCRIPTION'  => $content,
                'ORGANIZER'    => ics_escape_string($organizer),
                'URL;VALUE=URI'=> ics_escape_string($url),
            );
            $events += ics_get_event_data($args); 
            // var_dump($events);
            $output = ics_get_cal_data($events);

            //Collect output
            ob_start();
            // Set the correct headers for this file
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=".$filename);
            header('Content-type: text/calendar; charset=utf-8');
            header("Pragma: 0");
            header("Expires: 0");
                // The below ics structure MUST NOT have spaces before each line
                // Credit for the .ics structure goes to https://gist.github.com/jakebellacera/635416
                //Collect output and echo
                echo $output;
            $eventsical = ob_get_contents();
            ob_end_clean();
            echo $eventsical;
            exit();
        endwhile;

    endif;
}
?>