<?php
/**
 * Plugin Name: Mcq Quiz
 * Description: for multiple choice questionnaire
 * Version: 1.0.0
 * Author: Md. Atiqur Rahman
 * Author URI: https://profiles.wordpress.org/atiqsu/
 * Text Domain: mcq-quiz
 * Domain Path: /languages
 * License: GPLv2 or later
 */

defined( 'ABSPATH' ) || exit;

require __DIR__ . '/autolaod.php';


call_user_func(function($bootstrap) {
	$bootstrap(__FILE__);
}, require(__DIR__.'/boot/app.php'));
