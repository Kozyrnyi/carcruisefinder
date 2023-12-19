<?php
/**
 * View: List View - Single Event Date
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/date.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @since 4.9.9
 * @since 5.1.1 Move icons into separate templates.
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 * @version 5.1.1
 */
use Tribe__Date_Utils as Dates;

//$event_date_attr = $event->dates->start->format( Dates::DBDATEFORMAT );

?>
<!--<div class="tribe-events-calendar-list__event-datetime-wrapper tribe-common-b2">-->
<!--    --><?php //$this->template( 'list/event/date/featured' ); ?>
<!--    <time class="tribe-events-calendar-list__event-datetime" datetime="--><?php //echo esc_attr( $event_date_attr ); ?><!--">-->
<!--        --><?php //echo $event->schedule_details->value(); ?>
<!--    </time>-->
<!--    --><?php //$this->template( 'list/event/date/meta', [ 'event' => $event ] ); ?>
<!--</div>-->


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
        <?php /*
if ( function_exists( 'tribe_is_recurring_event' ) && function_exists( 'tribe_get_recurrence_text' ) && tribe_is_recurring_event( get_the_ID() ) ) : ?>
	<div class="see-all">
		<?php if ( function_exists( 'tribe_all_occurences_link' ) ) : ?>
		<?php printf( '<a href="%s">%s</a>', esc_url( tribe_all_occurences_link( get_the_ID(), false ) ), __( '(See All)', 'eventica-wp' ) ); ?>
		<?php endif ?>
	</div>
*/ ?>

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
        <?php } ?>

    </div>

<?php } ?>
