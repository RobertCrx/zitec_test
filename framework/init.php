<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );

if ( ! function_exists( 'load_data' ) ) :
	function load_data() {
		
		// using this method to call this function only once;
		if ( !get_option('init' )):
			// posts;
        	$all_cars = ['Dacia 1300', 'Audi A4', 'Audi A5', 'Alfa Romeo Julia', 'Lancia Delta', 'BMW e350', 'Dacia Logan', 'Fiat Punto', 'BMW X6', 'Skoda Octavia'];
			// terms;
            $fuels = array('benzina', 'diesel', 'electric');
            $colors = array('rosu', 'albastru', 'verde', 'galben');
            $manufacturer = array();

            foreach($all_cars as $car):
                $new_post = array(
                    'post_type' => 'car',
                    'post_title' => $car,
                    'post_status' => 'publish'
                );
		
				$to_slug = str_replace(' ', '-', $car);
				$names = strtolower(strtok($to_slug, " "));
				array_push($manufacturer, $names);

                $post_data = wp_insert_post($new_post);
		
				foreach ($fuels as $fuel):
					wp_insert_term( ucfirst($fuel), 'fuel', [
						'slug' => $fuel,
					]);
				endforeach;
		
				foreach ($colors as $color):
					wp_insert_term( ucfirst($color), 'color', [
						'slug' => $color,
					]);
				endforeach;
		
				foreach ($manufacturer as $brand):
					wp_insert_term( ucfirst($brand), 'manufacturer', [
						'slug' => $brand,
					]);
				endforeach;
		
				wp_set_object_terms($post_data, $colors[rand(1, 4)] , 'color', true);
				wp_set_object_terms($post_data, $fuels[rand(1, 3)], 'fuel', true);
				wp_set_object_terms($post_data, $car, 'manufacturer', true);
		
            endforeach;
		
			add_option('init', 1); 
		endif;
	}
	add_action( 'init', 'load_data' );

endif;