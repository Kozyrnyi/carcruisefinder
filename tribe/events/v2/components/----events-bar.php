<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/Bar.php
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/modules/bar.php
 *
 * @package  TribeEventsCalendar
 * @version 4.6.26
 *
 * @var bool $display_events_bar   Boolean on whether to display the events bar.
 * @var bool $disable_event_search Boolean on whether to disable the event search.
 * @var array $public_views Array of data of the public views, with the slug as the key.
 */
?>

<?php

//$filters     = tribe_events_get_filters();
//$views       = tribe_events_get_views();
$current_url = tribe_events_get_current_filter_url();
$classes     = array( 'tribe-clearfix' );


if ( empty( $display_events_bar ) ) {
    return;
}

//$heading = $disable_event_search
//    ? __( 'Views Navigation', 'the-events-calendar' )
//    : sprintf( __( '%s Search and Views Navigation', 'the-events-calendar' ), tribe_get_event_label_plural() );

//$classes = [ 'tribe-events-header__events-bar', 'tribe-events-c-events-bar' ];
//if ( empty( $disable_event_search ) ) {
//    $classes[] = 'tribe-events-c-events-bar--border';
//}

//if ( ! empty( $filters ) ) {
//    $classes[] = 'tribe-events-bar--has-filters';
//}

if ( empty( $disable_event_search ) ) {
    $classes[] = 'tribe-events-bar--has-filters';
}

if ( count( $public_views ) > 1 ) {
    $classes[] = 'tribe-events-bar--has-views';
}

?>

<?php do_action( 'tribe_events_bar_before_template' ) ?>
    <div id="tribe-events-bar">

        <h2 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Search and Views Navigation', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?></h2>

        <form id="tribe-bar-form" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">

            <?php if ( empty( $disable_event_search ) ) : ?>
                <div id="tribe-bar-filters-wrap">

                    <button
                        id="tribe-bar-collapse-toggle"
                        aria-expanded="false"
                        type="button"
                        aria-controls="tribe-bar-filters"
                        data-label-hidden="<?php printf( esc_html__( 'Show %s Search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                        data-label-shown="<?php printf( esc_html__( 'Hide %s Search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                    >
					<span class="tribe-bar-toggle-text">
						<?php printf( esc_html__( 'Show %s Search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>
					</span>
                        <span class="tribe-bar-toggle-arrow"></span>
                    </button>

                    <div id="tribe-bar-filters" class="tribe-bar-filters" aria-hidden="true">
                        <div class="tribe-bar-filters-inner tribe-clearfix">
                            <h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?></h3>
<!--                            --><?php //foreach ( $filters as $filter ) : ?>
<!--                                <div class="--><?php //echo esc_attr( $filter['name'] ) ?><!---filter">-->
<!--                                    <label class="label---><?php //echo esc_attr( $filter['name'] ) ?><!--" for="--><?php //echo esc_attr( $filter['name'] ) ?><!--">--><?php //echo $filter['caption'] ?><!--</label> -->
<!--                                    --><?php //echo $filter['html'] ?>
<!--                                </div>-->
<!--                            --><?php //endforeach; ?>

<!--                            <div-->
<!--                                class="tribe-events-c-events-bar__search-container"-->
<!--                                id="tribe-events-search-container"-->
<!--                                data-js="tribe-events-search-container"-->
<!--                            >-->
<!--                                --><?php //$this->template( 'components/events-bar/search' ); ?>
<!--                            </div>-->


                            <?php $this->template( 'components/events-bar/search/keyword' ); ?>



                            <div class="tribe-bar-submit">
                                <input
                                    class="tribe-events-button tribe-no-param"
                                    type="submit"
                                    name="submit-bar"
                                    aria-label="<?php printf( esc_attr__( 'Submit %s search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                                    value="<?php printf( esc_attr__( 'search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                                />
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <div class="filter-with-regions-counties-cities">
                <div class="dropdowns">
                    <?PHP

                    $terms = $terms = get_terms("tribe_events_cat",array(
                        'orderby'    => 'term_id',
                        'hide_empty' => 0
                    ) );
                    if ( empty( $terms ) || is_wp_error( $terms ) ) {
                        return;
                    }
                    echo '<div class="dropdown">';
                    echo '<button class="dropbtn">View By Regions <i class="fa fa-angle-down custom-angle-down" aria-hidden="true" style="
				"></i>
				
				</button>';
                    echo '<div class="dropdown-content">';
                    foreach ( $terms as $single_term ) {
                        $url = esc_url( get_term_link( $single_term ) );



                        $name = esc_html( get_term_field( 'name', $single_term ) );
                        echo '<a href="' . $url . '">' . $name . '</a>';
                    }
                    echo '</div>';
                    echo '</div>';


                    $tags = get_tags(['name__like' => 'County']);
                    if($tags){
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">View By Counties <i class="fa fa-angle-down custom-angle-down" aria-hidden="true" style="
					"></i>
					
					</button>';
                        echo '<div class="dropdown-content">';
                        foreach($tags as $tag) {
                            $tag_link = get_tag_link($tag->term_id);
                            echo '<a href="'. get_site_url() .'/events/tag/'. $tag->slug .'/">'.$tag->name.'</a>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';

                    $alltags = get_tags(['name__like' => 'County']);
                    $county_tags=array();
                    if($alltags){
                        foreach($alltags as $tag1) {
                            $county_tags[]=$tag1->term_id;
                        }
                    }
                    $citytags = get_tags(['orderby' => 'name']);
                    if($citytags){
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">View By Cities <i class="fa fa-angle-down custom-angle-down" aria-hidden="true" style="
					"></i>
					
					</button>';
                        echo '<div class="dropdown-content">';
                        foreach($citytags as $ctag) {
                            if(!in_array($ctag->term_id,$county_tags)){
                                $ctag_link = get_tag_link($ctag->term_id);
                                echo '<a href="'. get_site_url() .'/events/tag/'. $ctag->slug .'/">'.$ctag->name.'</a>';
                            }
                        }
                    }
                    echo '</div>';
                    echo '</div>';

                    ?>
                </div><!-- .dropdowns -->

                <?php $this->template( 'components/events-bar/views' ); ?>

<!--                --><?php //if ( count( $views ) > 1 ) : ?>
<!--                    <div id="tribe-bar-views" class="tribe-bar-views">-->
<!--                        <div class="tribe-bar-views-inner tribe-clearfix">-->
<!--                            <h3 class="tribe-events-visuallyhidden">--><?php //printf( esc_html__( '%s Views Navigation', 'the-events-calendar' ), tribe_get_event_label_singular() ); ?><!--</h3>-->
<!--                            <label id="tribe-bar-views-label" aria-label="--><?php //printf( esc_html__( 'View %s As', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?><!--">-->
<!--                                --><?php //esc_html_e( 'View As', 'the-events-calendar' ); ?>
<!--                            </label>-->
<!--                            <select-->
<!--                                class="tribe-bar-views-select tribe-no-param"-->
<!--                                name="tribe-bar-view"-->
<!--                                aria-label="--><?php //printf( esc_attr__( 'View %s As', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?><!--"-->
<!--                            >-->
<!--                                --><?php
//                                foreach ( $views as $view ) {
//                                    printf(
//                                        '<option value="%1$s" data-view="%2$s"%3$s>%4$s</option>',
//                                        esc_attr( $view['url'] ),
//                                        esc_attr( $view['displaying'] ),
//                                        tribe_is_view( $view['displaying'] ) ? ' selected' : '',
//                                        esc_html( $view['anchor'] )
//                                    );
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //endif; ?>
            </div>
        </form>

    </div>
    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        jQuery("#tribe-bar-search").attr("placeholder","Search Keyword");
        jQuery("#tribe-bar-geoloc").attr("placeholder","Search Near Location");

    </script>
<?php
do_action( 'tribe_events_bar_after_template' );
