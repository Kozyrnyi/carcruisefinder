<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();
if ( isset( $venue_details['linked_name'] ) ) {
    $venue_name = $venue_details['linked_name'];
}
elseif ( isset( $venue_details['name'] ) ) {
    $venue_name = $venue_details['name'];
}
else {
    $venue_name = '';
}

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

// $month_format = tokopress_get_mod( 'tokopress_events_month_short_text' ) ? 'M' : 'F';
$month_format = "M";
?>

<div class="even-list-wrapper">
    <div class="event-list-wrapper-top">
        <div class="tribe-events-event-image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php if(has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail( 'blog-thumbnail' ); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/thumb-event.png" alt="<?php the_title(); ?>">
                <?php endif; ?>
            </a>
        </div>
    </div>

    <div class="event-list-wrapper-bottom">
        <?php
        $tribe_get_start_date = tribe_get_start_date( null, false, 'dmy');
        $tribe_get_end_date = tribe_get_end_date( null, false, 'dmy');
        if($tribe_get_start_date != $tribe_get_end_date){ ?>
            <div class="tribe-events-event-date">


                <div class="date">
                    <span class="dd"><?php echo tribe_get_start_date( null, false, 'M d, Y' ) ?></span>-
                    <span class="mm"><?php echo tribe_get_end_date( null, false, "M d, Y" ) ?></span>

                </div>
                <div class="time">
                    <span class="hh"><?php echo tribe_get_start_date( null, false, 'g:i a' ) ?></span>
                </div>
                <?php /* if ( function_exists( 'tribe_is_recurring_event' ) && function_exists( 'tribe_get_recurrence_text' ) && tribe_is_recurring_event( get_the_ID() ) ) : ?>
                <div class="see-all">
                    <?php if ( function_exists( 'tribe_all_occurences_link' ) ) : ?>
                        <?php printf( '<a href="%s">%s</a>', esc_url( tribe_all_occurences_link( get_the_ID(), false ) ), __( '(See All)', 'eventica-wp' ) ); ?>
                    <?php endif ?>
                </div>
                 <?php endif */ ?>

            </div>

        <?php }else{ ?>
            <div class="tribe-events-event-date">
                <div class="date">
                    <span class="dd"><?php echo tribe_get_start_date( null, false, 'M d, Y' ) ?></span>
                </div>
                <?php
                $start_date =  tribe_get_start_date( null, false, 'gia' );
                $end_date = tribe_get_end_date( null, false, 'gia' );
                if($start_date == $end_date){ ?>
                    <div class="time">
                        <span class="hh"><?php echo tribe_get_start_date( null, false, 'g:i a' ) ?></span>
                    </div>
                <?php }else{ ?>
                    <div class="time">
                        <span class="hh"><?php echo tribe_get_start_date( null, false, 'g:i a' ) ?></span> -
                        <span class="ii"><?php echo tribe_get_end_date( null, false, 'g:i a' ) ?></span>
                    </div>
                <?php }
                if ( function_exists( 'tribe_is_recurring_event' ) && function_exists( 'tribe_get_recurrence_text' ) && tribe_is_recurring_event( get_the_ID() ) ) : ?>
                    <div class="see-all">
                        <?php if ( function_exists( 'tribe_all_occurences_link' ) ) : ?>
                            <?php printf( '<a href="%s">%s</a>', esc_url( tribe_all_occurences_link( get_the_ID(), false ) ), __( '(See All)', 'eventica-wp' ) ); ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>

        <?php } ?>
        <?php //echo tribe_events_event_schedule_details() ?>
        <div class="wraper-bottom-left">
            <!-- Event Title -->
            <?php do_action( 'tribe_events_before_the_event_title' ) ?>
            <h2 class="tribe-events-list-event-title entry-title summary">
                <a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
                    <?php the_title() ?>
                </a>
            </h2>
            <?php do_action( 'tribe_events_after_the_event_title' ) ?>

            <!-- Event Meta -->
            <?php do_action( 'tribe_events_before_the_meta' ) ?>
            <div class="tribe-events-event-meta vcard">
                <div class="author <?php echo esc_attr( $has_venue_address ); ?>">

                    <?php
                    if ( $venue_name ) : ?>
                        <div class="tribe-events-venue-detail ">
                            <div class="tribe-events-address">
                                <div class="tribe-get_venue">
                                    <?php echo tribe_get_venue() ?>
                                </div>
                                <?php if ( tribe_address_exists() ) : ?>
                                    <address class="adderss">
                                        <?php echo tribe_get_full_address(); ?>
                                    </address>
                                <?php endif; ?>
                                <?php //echo wp_kses_data( $address ); ?>
                            </div>
                            <?php //if ( tribe_show_google_map_link() ) : ?>
                            <!--<p class="location">-->
                            <?php //echo tribe_get_map_link_html(); ?>
                            <!--</p>-->
                            <?php //endif; ?>

                        </div>
                        <!-- <div class="tribe-events-venue-details">

                        </div> -->
                        <?php if ( function_exists( 'tribe_get_custom_fields' ) ) :
                            $fields = tribe_get_custom_fields();
                            if(!empty($fields ) && isset($fields['Event Type'])) {?>
                                <div class="tribe-events-venue-details-type">
                                    <!-- <i class="fa fa-calendar" aria-hidden="true"></i>  -->

                                    <?php echo $fields['Event Type']; ?>
                                </div>
                            <?php } endif ?>
                    <?php endif; ?>

                </div>
            </div>
            <!-- .tribe-events-event-meta -->
            <?php do_action( 'tribe_events_after_the_meta' ) ?>

        </div>

    </div>
    <div class="event-list-wrapper-bottom-intrested">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Interested</a>
    </div>
</div>
