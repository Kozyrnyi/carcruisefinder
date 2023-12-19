<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @version 4.4
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
} ?>

<?php
global $post;
global $more;
$more = false;
?>

<div class="tribe-events-loop row">

    <?php
    $i = 1;
    $j = 1;
    while ( have_posts() ) : the_post(); ?>
        <?php do_action( 'tribe_events_inside_before_loop' ); ?>

        <!-- Month / Year Headers -->
        <?php tribe_events_list_the_date_headers(); ?>

        <!-- Event  -->
        <?php
        $post_parent = '';
        if ( $post->post_parent ) {
            $post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
        }
        ?>
        <div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> col-lg-12 col-md-6 col-sm-6" <?php echo $post_parent; ?>>
            <?php
            $event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

            /**
             * Filters the event type used when selecting a template to render
             *
             * @param $event_type
             */
            $event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );

            tribe_get_template_part( 'list/single', $event_type );
            ?>
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
    <?php endwhile; ?>

</div><!-- .tribe-events-loop -->