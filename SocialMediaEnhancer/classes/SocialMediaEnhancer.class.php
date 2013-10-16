<?php

defined('ABSPATH') OR exit;

final class SocialMediaEnhancer {
	/**
	 * Pseude Constructor
	 * 
	 * @since 2.0.0
	 * @change 2.0.0
	 */
	public static function init() {
		new self();
	}

	/**
	 * Constructor
	 * 
	 * @since 2.0.0
	 * @change 2.0.0
	 */
	public function __construct() {
		if(is_admin()) {
			add_action('admin_init', array('SocialMediaEnhancer_Options', 'register_settings'));
			add_action('admin_menu', array('SocialMediaEnhancer_Options', 'add_options_page'));
			add_action('admin_print_styles', array(__CLASS__, 'add_styles'));

			add_filter('plugin_action_links_', array('plugin_action_links_' . SME_FILE_SYMLINK, 'action_links'));
		} else {

		}
	}

	public static function add_styles() {
		$plugin_data = get_plugin_data(SME_FILE);

		/**
		 * register css
		 */
		wp_register_style(
			'SocialMediaEnhancer_CSS',
			plugins_url('assets/css/sme.css', SME_FILE_SYMLINK),
			array(),
			$plugin_data['Version']
		);

		/**
		 * embed css
		 */
		wp_enqueue_style('SocialMediaEnhancer_CSS');
	}
}
