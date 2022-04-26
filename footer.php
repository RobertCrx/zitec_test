<div id="preload-ajax">
	<img id="loader" src="<?php echo get_stylesheet_directory_uri(); ?>/loading.gif" alt="loading">
</div>

<?php
wp_footer(); ?>


    <script>
        //global vars;
        ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
        home_url = "<?php echo home_url(); ?>";
    </script>