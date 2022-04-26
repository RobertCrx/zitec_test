<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );

function carlist_shortcode_function( $atts = array(), $content = '' ) {
    

		// the main attributes;
		 $attributes = shortcode_atts( 
			[
				'post_type'=> 'car',
				'posts'    => -1,
				'order'    => '',
				'orderby'  => '',
				'fuel'    => '',
				'manufacturer' => '',
				'color' => '',
				'field'    => 'slug', 
				'showfilters' => 0
			],
			$atts 
		);

		// getting attributes;
		$posts    = $attributes['posts']; // if we want to have a specific number of cars;
		$order    = $attributes['order']; // set the order of the query
		$orderby  = $attributes['orderby']; // set the orderby order of the query
		$fuel = $attributes['fuel']; // car taxonomy;
		$manufacturer = $attributes['manufacturer']; // car taxonomy;
		$color = $attributes['color']; // car taxonomy;
		$field    = $attributes['field']; // default slug
		$show_filters = $attributes['showfilters']; // default inactive filters;
		$tax_query = [];

		// default basic query;
		$args = [
			'post_type'      => 'car',
			'posts_per_page' => $posts,
			'order'          => $order,
			'orderby'        => $orderby
		]; 

	

    	ob_start(); ?>
	
	  <section class="car-show">
		<div class="container">
			<div class="heading">
				<h2>
					Car list
				</h2>
			</div>
		  <?php if( $show_filters == 1 ): 

				// add tax query if exists;
				if ($fuel != ''):
					$fuel_tax = array(       
						'taxonomy' => 'fuel', 
						'terms'    => array($fuel),
						'field' => $field,
						'operator' => 'IN'
					);

					$tax_query[] = $fuel_tax;
				endif;

				// add tax query if exists;
				if ($manufacturer != ''):
					$manufacturer_tax = array(       
						'taxonomy' => 'manufacturer', 
						'terms'    => array($manufacturer),
						'field' => $field,
						'operator' => 'IN'
					);

					$tax_query[] = $manufacturer_tax;
				endif;

				// add tax query if exists;
				if ($color != ''):
					$color_tax = array(       
						'taxonomy' => 'color', 
						'terms'    => array($color),
						'field' => $field,
						'operator' => 'IN'
					);

					$tax_query[] = $color_tax;
				endif;


				// add the tax queries to the main query
				if (count($tax_query)>1) {
					$tax_query['relation'] = 'AND';
				}

				// add tax_query arrays to the main args; 
				$args['tax_query'] = $tax_query; ?>

				<div class="filters-content">
					<?php $filter_template = include_once('car-select.php'); ?>
				</div>

				<?php $cars_loop = new WP_Query($args);
					if( $cars_loop-> have_posts() ): ?>
						<div class="general-content">
							<?php while( $cars_loop->have_posts() ): $cars_loop->the_post(); ?>
								<a href="<?php echo the_permalink(); ?>" class="car-post">
									<div class="post-title">
										<h2><?php echo get_the_title(); ?></h2>
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
							wp_reset_postdata(); ?>
						</div>

				<?php else:
					echo('No cars with these attributes found.');
				endif;

		  else:
				$cars_loop = new WP_Query($args);
				if( $cars_loop-> have_posts() ): ?>
					<div class="general-content">
						<?php while( $cars_loop->have_posts() ): $cars_loop->the_post(); ?>
							<a href="<?php echo the_permalink(); ?>" class="car-post">
								<div class="post-title">
									<?php echo get_the_title(); ?>
								</div>
							</a>
						<?php endwhile; 
						wp_reset_postdata(); ?>
					</div>

				<?php else:
					echo('No cars with these attributes found.');
				endif;
		 endif; ?>
	
		</div>
	</section>
    
    <?php echo $content;
    return ob_get_clean();
 
}
add_shortcode( 'carlist', 'carlist_shortcode_function' );