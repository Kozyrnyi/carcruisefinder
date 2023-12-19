<?php
/**
 * View: List View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://evnt.is/1aiy
 *
 * @since   6.1.4 Changing our nonce verification structures.
 *
 * @version 6.2.0
 * @since 6.2.0 Moved the header information into a new components/header.php template.
 *
 * @var array    $events               The array containing the events.
 * @var string   $rest_url             The REST URL.
 * @var string   $rest_method          The HTTP method, either `POST` or `GET`, the View will use to make requests.
 * @var int      $should_manage_url    int containing if it should manage the URL.
 * @var bool     $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes    Classes used for the container of the view.
 * @var array    $container_data       An additional set of container `data` attributes.
 * @var string   $breakpoint_pointer   String we use as pointer to the current view we are setting up with breakpoints.
 */

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
    $header_classes[] = 'tribe-events-header--has-event-search';
}

?>
<div
    <?php tribe_classes( $container_classes ); ?>
        data-js="tribe-events-view"
        data-view-rest-url="<?php echo esc_url( $rest_url ); ?>"
        data-view-rest-method="<?php echo esc_attr( $rest_method ); ?>"
        data-view-manage-url="<?php echo esc_attr( $should_manage_url ); ?>"
    <?php foreach ( $container_data as $key => $value ) : ?>
        data-view-<?php echo esc_attr( $key ) ?>="<?php echo esc_attr( $value ) ?>"
    <?php endforeach; ?>
    <?php if ( ! empty( $breakpoint_pointer ) ) : ?>
        data-view-breakpoint-pointer="<?php echo esc_attr( $breakpoint_pointer ); ?>"
    <?php endif; ?>
>
    <div class="tribe-common-l-container tribe-events-l-container">
        <?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'the-events-calendar' ) ] ); ?>

        <?php $this->template( 'components/json-ld-data' ); ?>

        <?php $this->template( 'components/data' ); ?>

        <?php $this->template( 'components/before' ); ?>

<!--        --><?php //tribe_get_template_part( 'custom/page-title' ); ?>

        <?php $this->template( 'custom/page-title' ); ?>

        <?php $this->template( 'components/header' ); ?>

        <?php $this->template( 'components/filter-bar' ); ?>

        <div class="tribe-events-calendar-list tribe-events-list">
            <div class="tribe-events-loop row">
                <?php
                $i = 1;
                $j = 1;
                foreach ( $events as $event ) : ?>
                    <?php $this->setup_postdata( $event ); ?>

                    <?php $this->template( 'list/month-separator', [ 'event' => $event ] ); ?>

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

        <?php $this->template( 'list/nav' ); ?>

        <?php $this->template( 'components/ical-link' ); ?>

        <?php $this->template( 'components/after' ); ?>

    </div>
</div>

<?php $this->template( 'components/breakpoints' ); ?>
