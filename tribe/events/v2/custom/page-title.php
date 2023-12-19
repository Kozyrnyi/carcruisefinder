<?php

use \Tribe\Events\Views\V2\Template;

/**
 * @var Template $this         Template Engine instance rendering.
 * @var string   $header_title The title to display.
 */
if ( empty( $header_title ) ) {
    return;
}

$header_title_element = $header_title_element ?? 'h1';
?>
<section id="page-title" class="page-title">
    <div class="page_title-with-date">
        <div class="page_title_container">
            <h3 class="entry-sub-title">
                <span class="trail-begin"><a href="<?php echo get_site_url();?>" title="<?php echo get_bloginfo( 'name' ); ?>">Home</a></span>
                <span class="sep">/</span> <span class="trail-end"><a href="<?php echo get_site_url();?>/events/" title="Events">Events</a> /</span>
                <?php if(is_tag()){?>
                    <!--<div class="breadcrumb-trail breadcrumb breadcrumbs">
					<span class="sep">/</span> <span class="trail-end"><?php echo get_queried_object()->name;?></span>
				</div>-->
                <?php } else{?>
                    <?php //tokopress_breadcrumb_event(); ?>
                <?php }?>
                <?php if ( is_single() ) : ?>
                    <?php the_title() ?>
                <?php elseif ( is_tax() ) : ?>
                    <?php single_term_title(); ?>
                <?php elseif ( is_tag() ) :  $tag_name = get_queried_object(); ?>
                    <?php _e( $tag_name->name, 'eventica-wp' ); ?>
                <?php else : ?>
                    <?php //if ( tokopress_get_mod('tokopress_events_custom_catalog_title') ) : ?>
                    <?php //echo tokopress_get_mod('tokopress_events_custom_catalog_title'); ?>
                    <?php //elseif ( tokopress_get_mod('tokopress_events_label_plural') ) : ?>
                    <?php //echo tokopress_get_mod('tokopress_events_label_plural'); ?>
                    <?php //else : ?>
                    <?php //_e( 'Events', 'eventica-wp' ); ?>
                    <?php //endif; ?>

                    <?php echo esc_html( $header_title ); ?>
                <?php endif; ?>
            </h3>
            <div class="container-page-title">

                <?php if ( is_single() ) : ?>
                    <?php the_title('<h1 class="entry-title">', '</h1>') ?>
                <?php elseif ( is_tax() ) : ?>
                    <?php single_term_title('<h1 class="entry-title">', '</h1>'); ?>
                <?php elseif ( is_tag() ) :  $tag_name = get_queried_object(); ?>
                    <h1 class="entry-title"><?php _e( $tag_name->name, 'eventica-wp' ); ?></h1>
                <?php else : ?>
                    <?php //if ( tokopress_get_mod('tokopress_events_custom_catalog_title') ) : ?>
                    <!--<h1 class="entry-title"><?php //echo tokopress_get_mod('tokopress_events_custom_catalog_title'); ?></h1>-->
                    <?php //elseif ( tokopress_get_mod('tokopress_events_label_plural') ) : ?>
                    <!--<h1 class="entry-title"><?php //echo tokopress_get_mod('tokopress_events_label_plural'); ?></h1>-->
                    <?php //else : ?>
                    <!--<h1 class="entry-title"><?php //_e( 'Events', 'eventica-wp' ); ?></h1>-->
                    <?php //endif; ?>

                    <<?php echo esc_attr( $header_title_element ); ?> class="entry-title">
                        <?php echo esc_html( $header_title ); ?> 
                    </<?php echo esc_attr( $header_title_element ); ?>>
                <?php endif; ?>
            </div>
        </div>
        <?php if ( is_single() ) :
        if ( class_exists('Tribe__Date_Utils') ) {
            $time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
        }
        elseif ( class_exists('Tribe__Events__Date_Utils') ) {
            $time_format = get_option( 'time_format', Tribe__Events__Date_Utils::TIMEFORMAT );
        }
        ?>
        <div class="date_time">
            <?php $tribe_get_start_date = tribe_get_start_date( null, false, 'dmy');
            $tribe_get_end_date = tribe_get_end_date( null, false, 'dmy');
            if($tribe_get_start_date == $tribe_get_end_date){ ?>
                <div class="date">
                    <?php echo tribe_get_start_date( NULL, false, 'M d, Y' )  ?>
                </div>
                <?php
                $start_date = tribe_get_start_date( NULL, false, 'MdY' );
                $end_date =  tribe_get_end_date( NULL, false, 'MdY' );
                if($start_date == $end_date ){ ?>
                    <div class="time">
                        <span class="start" <?php echo $time_format ; ?>><?php echo tribe_get_start_date( NULL , false, $time_format ) ?></span>
                    </div>
                <?php }else{ ?>
                    <div class="time">
                        <span class="start" <?php echo $time_format ; ?>><?php echo tribe_get_start_date( NULL , false, $time_format ) ?></span> -
                        <span class="end"><?php echo tribe_get_end_date( NULL , false, $time_format ) ?></span>
                    </div>
                <?php	}
            }else{
                ?>
                <div class="date">
                    <span><?php echo tribe_get_start_date( NULL, false, 'M d, Y' )  ?></span> -
                    <span><?php echo tribe_get_end_date( NULL, false, 'M d, Y' )  ?></span>

                </div>

                <div class="time">
                    <span class="start" <?php echo $time_format ; ?>><?php echo tribe_get_start_date( NULL , false, $time_format ) ?></span>
                </div>
            <?php } ?>

        </div>
    </div>
    <div class="big-ad-banner">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8188368296085366"
             crossorigin="anonymous"></script>
        <!-- EventListing1 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-8188368296085366"
             data-ad-slot="6208439254"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
       
    </div>

    <?php else : ?>

         <div class="big-ad-banner">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8188368296085366"
                     crossorigin="anonymous"></script>
                <!-- EventListing1 -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-8188368296085366"
                     data-ad-slot="6208439254"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            <!-- <img src="<?php //echo get_template_directory_uri(); ?>/images/930x180.jpg" /> -->
        </div>
    </div>
    <?php endif; ?>
    <div class="single-post-bg"></div>
</section>