<?php 
get_header();

 if( have_posts() ):
        while( have_posts() ): the_post(); ?>

            <div class="main-panel">
             
                <?php echo the_content(); ?>
                
            </div>
        
        <?php endwhile;
        wp_reset_postdata();
    endif;

get_footer(); ?>