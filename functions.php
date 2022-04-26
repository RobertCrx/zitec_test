<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );

define('ZITEC', '1.0.0');

/**
 * FRAMEWORK
 */
# Enqueue file system 
require_once __DIR__ . '/framework/enqueue.php';
# Post Types
require_once __DIR__ . '/framework/post-types.php';
# Car Object Init
require_once __DIR__ . '/framework/init.php';
# Shortcodes
require_once __DIR__ . '/framework/shortcodes.php';
# AJAX Service
require_once __DIR__ . '/framework/ajax-service.php';