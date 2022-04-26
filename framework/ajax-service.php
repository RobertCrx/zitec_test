<?php

// load brands;
add_action('wp_ajax_find_cars', 'find_cars');
add_action('wp_ajax_nopriv_find_cars', 'find_cars');
function find_cars(){
    global $wp_query;
    $brands = (isset($_POST['brand']) ? $_POST['brand'] : ''); 
	$colors = (isset($_POST['color']) ? $_POST['color'] : ''); 
	$fuel = (isset($_POST['fuel']) ? $_POST['fuel'] : ''); 
	$tax_query = [];
	
	
	    $args = [
			'post_type'      => 'car',
			'posts_per_page' => -1,
		]; 
	
	  	// add tax query if exists;
        if ($brands != 'default' && $brands != ''):
            $brands_tax = array(       
                'taxonomy' => 'manufacturer', 
                'terms'    => array($brands),
                'field' => 'slug',
                'operator' => 'IN'
            );
    
            $tax_query[] = $brands_tax;
        endif;
        
        // add tax query if exists;
        if ($colors != 'default' && $colors != ''):
            $colors_tax = array(       
                'taxonomy' => 'color', 
                'terms'    => array($colors),
                'field' => 'slug',
                'operator' => 'IN'
            );
    
            $tax_query[] = $colors_tax;
        endif;
        
        // add tax query if exists;
        if ($fuel != 'default' && $fuel != ''):
            $fuel_tax = array(       
                'taxonomy' => 'fuel', 
                'terms'    => array($fuel),
                'field' => 'slug',
                'operator' => 'IN'
            );
    
            $tax_query[] = $fuel_tax;
        endif;
        
    
        // add the tax queries to the main query
        if (count($tax_query)>1) {
            $tax_query['relation'] = 'AND';
        } 
        
        // add tax_query arrays to the main args; 
        $args['tax_query'] = $tax_query;
	
		$filter_query = new WP_Query( $args ); 
		if( $filter_query-> have_posts() ): 
			while ( $filter_query->have_posts() ) : $filter_query->the_post(); 
				global $post; ?>
				<a href="<?php echo the_permalink(); ?>" class="car-post">
					<div class="post-title">
						<h2>
							<?php echo get_the_title(); ?>
						</h2>
					</div>
					
					<div class="flex car-filters">
						<?php $filter_brand = get_the_terms($post->ID, 'manufacturer');
							if( $filter_brand && !is_wp_error($fitler_brand) ): ?>
							<div class="filter-name">
								<?php foreach( $filter_brand as $manufacturer ): ?>
									<h3><?php echo str_replace("-", " ", $manufacturer->name); ?></h3>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						
						<?php $filter_fuel = get_the_terms($post->ID, 'fuel');
							if( $filter_fuel && !is_wp_error($filter_fuel) ): ?>
							<div class="filter-name">
								<?php foreach( $filter_fuel as $the_fuel ): ?>
									<h3><?php echo $the_fuel->name; ?></h3>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						
						<?php $filter_color = get_the_terms($post->ID, 'color');
							if( $filter_color && !is_wp_error($filter_color) ): ?>
							<div class="filter-name">
								<?php foreach( $filter_color as $the_color ): ?>
									<h3><?php echo $the_color->name; ?></h3>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</a>
			<?php endwhile;
			wp_reset_postdata();
		else:
			echo('No cars with these filters found.');
		endif;
	
	die();
}