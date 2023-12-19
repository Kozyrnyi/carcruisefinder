<?php

/**
 * View: Latest Past View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/latest-past.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.1.0
 *
 * @var array $events The array containing the events.
 */
?>

<?php $this->template( 'latest-past/heading' ); ?>

<div class="tribe-events-calendar-list tribe-events-list">
    <div class="tribe-events-loop row">
        <?php
        $i = 1;
        $j = 1;

        foreach ( $events as $event ) : ?>
            <?php $this->setup_postdata( $event ); ?>

            <?php $this->template( 'latest-past/event', [ 'event' => $event ] ); ?>

            <?php if ($i%6==0) {
                /*
                $slot = "";
                if($j%2==0){
                    $slot = "3110562656";
                }else{
                    $slot = "8047194569";
                }
                */
                ?>
                <!-- <div class="big-ad-banner">
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8188368296085366"
                             data-ad-slot="<?php // echo $slot; ?>"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                         <!--<img src="<?php // echo get_template_directory_uri(); ?>/images/930x180.jpg" /> -->
                <!--</div> -->
                <?php
                // $j++;
            }

            $i++;
            do_action( 'tribe_events_inside_after_loop' ); ?>

        <?php endforeach; ?>
    </div>
</div>
