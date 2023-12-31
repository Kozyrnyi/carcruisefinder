<?php
/**
 * View: Latest Past Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/latest-past/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.1.0
 *
 * @var WP_Post            $event        The event post object with properties added by the `tribe_get_event` function.
 * @var \DateTimeInterface $request_date The request date object. This will be "today" if the user did not input any
 *                                       date, or the user input date.
 * @var bool               $is_past      Whether the current display mode is "past" or not.
 *
 * @see tribe_get_event() For the format of the event object.
 */


//use Tribe\Events\Views\V2\Utils;
//
//
//if ( empty( $is_past ) && ! empty ( $request_date ) ) {
//    $should_have_month_separator = Utils\Separators::should_have_month( $this->get( 'events' ), $event, $request_date );
//} else {
//    $should_have_month_separator = Utils\Separators::should_have_month( $this->get( 'events' ), $event );
//}
//
//if ( ! $should_have_month_separator ) {
//    return;
//}


/*
 * Depending on the request date we show the later date between the real event start date and the request date.
 * This avoids users from seeing results "in the past" in relation to an input date or "today".
 * This does not apply to past events.
 */
$sep_date = empty( $is_past ) && ! empty( $request_date )
    ? max( $event->dates->start_display, $request_date )
    : $event->dates->start_display;
?>
<h2 class="tribe-events-list-separator-month">
    <span><?php echo esc_html( $sep_date->format_i18n( 'F Y' ) ); ?></span>
</h2>
<div class="<?php tribe_events_event_classes() ?> col-lg-12 col-md-6 col-sm-6">
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

            <?php $this->template( 'latest-past/event/date', [ 'event' => $event ] ); ?>

            <?php $this->template( 'latest-past/event/title', [ 'event' => $event ] ); ?>

        </div>
        <div class="event-list-wrapper-bottom-intrested">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Interested</a>
        </div>
    </div>
</div>