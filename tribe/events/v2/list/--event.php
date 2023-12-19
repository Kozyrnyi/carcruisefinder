<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

?>

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

            <?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>

            <?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>

        </div>
        <div class="event-list-wrapper-bottom-intrested">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Interested</a>
        </div>
    </div>
</div>

<?php if ($i%6==0) {
    $slot = "";
    if($j%2==0){
        $slot = "3110562656";
    }else{
        $slot = "8047194569";
    }
    ?>
    <div class="big-ad-banner">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-8188368296085366"
             data-ad-slot="<?php echo $slot; ?>"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <!-- <img src="<?php //echo get_template_directory_uri(); ?>/images/930x180.jpg" /> -->
    </div>
    <?php
    $j++;
}

$i++;
do_action( 'tribe_events_inside_after_loop' ); ?>



