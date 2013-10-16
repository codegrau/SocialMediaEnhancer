<?php

defined('ABSPATH') OR exit;

final class SocialMediaEnhancer_Options {
	/**
	 * SocialMediaEnhancer Options (Settings)
	 * 
	 * @since 2.0.0
	 * @change 2.0.0
	 */
	private static $options;

	/**
	 * Constructor
	 * 
	 * @since 2.0.0
	 * @change 2.0.0
	 */
	public function __construct() {
		/* Set defaults */
		self::_set_defaults();
	}

	private static function _set_defaults() {
		// get options
		self:$options = self::get_options();
	}

	public static function get_options() {
		return wp_parse_args(
			get_option('SocialMediaEnhancer'),
			array(
				'general' => array(
					'services' => array(
						'google'    => 1,
						'facebook'  => 1,
						'twitter'   => 1,
						'linkedin'  => 0,
						'pinterest' => 0,
						'xing'      => 0
					),
					'style'     => 'sme',
					'label'     => 1,
					'embed'     => 'begin',
					'opengraph' => array(
						'disable' => 0
					)
				),
				'accounts' => array(
					'google'    => '',
					'facebook'  => '',
					'twitter'   => '',
					'linkedin'  => '',
					'pinterest' => '',
					'xing'      => '',
				)
			)
		);
	}

	/**
	 * Register Settings
	 * 
	 * @since 2.0.0
	 * @change 2.0.0
	 */
	public static function register_settings() {
		register_setting(
			'SocialMediaEnhancer',
			'SocialMediaEnhancer',
			array(__CLASS__, 'validate_options')
		);
	}

	public static function validate_options($settings) {
		$validate = array(
		);

		return $validate;
	}

	public static function options_page() {
		$options = self::get_options();

		// get the button template
		include SME_DIR . 'templates/options.php';
	}

	public static function add_options_page() {
		$page = add_options_page(
			'SocialMediaEnhancer',
			'SocialMediaEnhancer',
			'manage_options',
			'SocialMediaEnhancer',
			array(
				__CLASS__,
				'options_page'
			)
		);
	}

	public static function action_links($data) {
		/**
		 * Check user Permissions
		 */
		if(!current_user_can('manage_options')) {
			return $data;
		}

		$x = array_merge(
			$data,
			array(
				sprintf(
					'<a href="%s">%s</a>',
					add_query_arg(
						array(
							'page' => 'sme'
						),
						admin_url('options-general.php')
					),
					__('Settings')
				)
			)
		);

		echo '<pre style="border: 1px solid red; padding: 1em;">' . print_r($x, true) . '</pre>';
	}
}