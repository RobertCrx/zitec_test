<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );?>

<div class="filter-wrapper">
	<select class="primary-select" id="brand">
		<option value="default" selected>All</option>
		<?php
		$brands = get_terms( array(
			'taxonomy' => 'manufacturer',
			'hide_empty' => false,
		) );
		if( $brands && !is_wp_error($brands) ):
			foreach( $brands as $brand): ?>
				<option value="<?php echo $brand->slug; ?>"> 
					<?php echo $brand->name; ?>
				</option>
			<?php endforeach; 
		endif; ?>
	</select>
	
	<select class="primary-select" id="color">
		<option value="default" selected>All</option>
		<?php
		$colors = get_terms( array(
			'taxonomy' => 'color',
			'hide_empty' => false,
		) );
		if( $colors && !is_wp_error($colors) ):
			foreach( $colors as $color): ?>
				<option value="<?php echo $color->slug; ?>">
					<?php echo $color->name; ?>
				</option>
			<?php endforeach; 
		endif; ?>
	</select>
	
	<select class="primary-select" id="fuel">
		<option value="default" selected>All</option>
		<?php
		$fuels = get_terms( array(
			'taxonomy' => 'fuel',
			'hide_empty' => false,
		) );
		if( $fuels && !is_wp_error($fuels) ):
			foreach( $fuels as $fuel): ?>
				<option value="<?php echo $fuel->slug; ?>">
					<?php echo $fuel->name; ?>
				</option>
			<?php endforeach; 
		endif; ?>
	</select>
</div>

