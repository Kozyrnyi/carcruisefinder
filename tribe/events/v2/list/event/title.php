<?php
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
?>

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


<!--                --><?php //if ( function_exists( 'tribe_get_custom_fields' ) ) :
//                    $fields = tribe_get_custom_fields();
//                    if(!empty($fields ) && isset($fields['Event Type'])) {?>
<!--                        <div class="tribe-events-venue-details-type">-->
<!--                            --><?php //echo $fields['Event Type']; ?>
<!--                        </div>-->
<!--                    --><?php //} endif ?>
            <?php endif; ?>

        </div>
    </div>
    <!-- .tribe-events-event-meta -->
    <?php do_action( 'tribe_events_after_the_meta' ) ?>

</div>