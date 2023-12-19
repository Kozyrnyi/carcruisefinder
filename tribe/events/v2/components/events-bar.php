<?php
/**
 * View: Events Bar
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/events-bar.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.2.0
 *
 * @var bool $display_events_bar   Boolean on whether to display the events bar.
 * @var bool $disable_event_search Boolean on whether to disable the event search.
 */

if ( empty( $display_events_bar ) ) {
    return;
}

$heading = $disable_event_search
    ? __( 'Views Navigation', 'the-events-calendar' )
    : sprintf( __( '%s Search and Views Navigation', 'the-events-calendar' ), tribe_get_event_label_plural() );

$classes = [ 'tribe-events-header__events-bar', 'tribe-events-c-events-bar' ];
if ( empty( $disable_event_search ) ) {
    $classes[] = 'tribe-events-c-events-bar--border';
}
?>
<div
    <?php tribe_classes( $classes ); ?>
    data-js="tribe-events-events-bar"
>

    <h2 class="tribe-common-a11y-visual-hide">
        <?php echo esc_html( $heading ); ?>
    </h2>

    <?php if ( empty( $disable_event_search ) ) : ?>
        <div id="tribe-bar-filters-wrap">
            <?php $this->template( 'components/events-bar/search-button' ); ?>

            <div
                class="tribe-events-c-events-bar__search-container"
                id="tribe-events-search-container"
                data-js="tribe-events-search-container"
            >
                <?php $this->template( 'components/events-bar/search' ); ?>
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

        <div id="tribe-bar-views" class="tribe-bar-views">
            <?php $this->template( 'components/events-bar/views' ); ?>
        </div>

    </div>

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
