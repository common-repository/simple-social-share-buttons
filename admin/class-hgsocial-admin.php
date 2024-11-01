<?php
/**
 * Simple Social Share.
 *
 * @package   	Simple Social Share Buttons
 * @author    	hgplugindesigners
 * @link      	http://plugin-boutique.com/social-media-buttons/
 * @copyright 	2016 hgplugindesigners
 */

class hgSocialAdmin {

	private $settings_api;

	/**
	 * Instance of this class.
	 *
	 * @since	1.0.0
	 *
	 * @var		object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since	1.0.0
	 *
	 * @var		string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since	 1.0.0
	 */
	private function __construct() {

		$plugin = hgSocial::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );

		$this->settings_api = new WeDevs_Settings_API;

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		add_action( 'admin_init', array( $this, 'admin_init' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since	 1.0.0
	 *
	 * @return	object	A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Loading settings page and menu.
	 *
	 * @since	 1.0.0
	 */
	public function admin_init() {

		$this->settings_api->set_sections( $this->get_settings_sections() );
		$this->settings_api->set_fields( $this->get_settings_fields() );

		$this->settings_api->admin_init();
	}

	/**
	 * Loading admin menu.
	 *
	 * @since	 1.0.0
	 */
	public function admin_menu() {
		add_options_page( 'Simple Social Share', 'Simple Social Share', 'delete_posts', 'hg-social-share', array($this, 'settings_page') );
	}

	/**
	 * Creating admin menu wrapper.
	 *
	 * @since	 1.0.0
	 */
	public function settings_page() {
		echo '<style>.form-table span.description,.form-table td{line-height:150%!important;float:left!important;width:100%!important}#increase_page_rank th,#us_advanced th,#us_mail th,#us_styling th,.form-table td{width:100%!important}.form-table td{padding-top:0!important}.group h2:first-of-type{font-size:20px;padding:20px;background:#232323;margin:0!important;border-bottom:1px solid #e4e4e4;color:#fff}.form-table h2{margin-bottom:0!important;padding-top:15px!important;max-width:97%!important;line-height:150%!important;font-size:30px!important;background:#fff!important;padding-left:0!important;border-bottom:0!important;border-top:2px dashed #dadada!important;padding-bottom:0!important;color:#333!important}.form-table tr:first-of-type h2{border-top:0!important}#increase_page_rank td,#us_advanced td,#us_mail td,#us_styling td{display:none!important}.form-table th{padding-top:0!important;margin-top:0!important;float:left;width:100%}</style>';
		echo '<div class="wrap ultimate-social-settings">';

		$this->settings_api->show_navigation();
		$this->settings_api->show_forms();

		echo '</div>';
	}

	/**
	 * Creating settings tabs.
	 *
	 * @since	 1.0.0
	 */
	public function get_settings_sections() {
		$sections = array(
			array(
				'id' => 'us_placement',
				'title' => __( 'Buttons Placement Settings', 'hg-social-share' )
				),
			array(
				'id' => 'us_basic',
				'title' => __( 'Twitter Settings', 'hg-social-share' )
				),
			array(
				'id' => 'us_styling',
				'title' => __( 'Design Settings', 'hg-social-share' )
				),
			array(
				'id' => 'us_mail',
				'title' => __( 'Email Settings', 'hg-social-share' )
				),
			array(
				'id' => 'us_advanced',
				'title' => __( 'Advanced Settings', 'hg-social-share' )
				),
			array(
				'id' => 'increase_page_rank',
				'title' => __( 'Boost your SEO', 'hg-social-share' )
				),
			
			);

		return $sections;
	}

	/**
	 * Creating individual settings.
	 *
	 * @since	 1.0.0
	 */
	public function get_settings_fields() {

		$facebook = __('Facebook','hg-social-share');
		$twitter = __('Twitter','hg-social-share');
		$google = __('Google Plus','hg-social-share');
		$pinterest = __('Pinterest','hg-social-share');
		$linkedin = __('LinkedIn','hg-social-share');
		$stumble = __('StumbleUpon','hg-social-share');
		$delicious = __('Delicious','hg-social-share');
		$buffer = __('Buffer','hg-social-share');
		$mail = __('Mail','hg-social-share');

		$fields = array(
			'us_basic' => array(
				array(
					'name' => 'us_tweet_via',
					'label' => __( '<br>Tweet via username', 'hg-social-share' ),
					'desc' => __( 'Type in your Twitter username if you want every tweet to have "Via @username" as default.', 'hg-social-share' ),
					'type' => 'text',
					),
				),
			'us_styling' => array(
				array(
					'name' => 'us_mail_color',
					'label' => __( '<br>Please upgrade to the $5 version to change design. <br>You can upgrade here: <a href="http://plugin-boutique.com/social-media-buttons/">http://plugin-boutique.com/social-media-buttons/</a>', 'hg-social-share' ),
					'desc' => __( 'Please upgrade to the $5 version to change design. You can upgrade here: <a href="http://plugin-boutique.com/social-media-buttons/"><http://plugin-boutique.com/social-media-buttons//a>', 'hg-social-share' ),
					'type' => 'text',
					),
				),
			'increase_page_rank' => array(
				array(
					'name' => 'us_mail_color',
					'label' => __( '<br>We have helped over 100 websites from top 100 to top 3 in Google. You can see our <a href="http://seo-servicen.dk/en/">Seo services here</a>', 'hg-social-share' ),
					'desc' => __( 'Please upgrade to the $5 version to change design. You can upgrade here: <a href="http://plugin-boutique.com/social-media-buttons/"><http://plugin-boutique.com/social-media-buttons//a>', 'hg-social-share' ),
					'type' => 'text',
					),
				),
'us_mail' => array(
	array(
		'label' => '<br><strong>Please upgrade to the $5 version to change email settings.</strong><br> You can upgrade here: <a href="http://plugin-boutique.com/social-media-buttons/">http://plugin-boutique.com/social-media-buttons/</a>',
		'type' => 'text',
		),

	),
'us_placement' => array(
	array(
		'name' => 'us_pages_top',
		'label' => '<h2>'.__( 'Pages: Top Buttons', 'hg-social-share' ).'</h2><img src="http://plugin-boutique.com/wp-content/uploads/2016/10/share-top.png">',
		'type' => 'multicheck',
		'options' => array(
			'facebook' => $facebook,
			'twitter' => $twitter,
			'googleplus' => $google,
			'pinterest' => $pinterest,
			'linkedin' => $linkedin,
			'stumble' => $stumble,
			'delicious' => $delicious,
			'buffer' => $buffer,
			'mail' => $mail,
			)
		),
	array(
		'name' => 'us_pages_top_align',
		'label' => __( 'Align Buttons', 'hg-social-share' ),
		'type' => 'radio',
		'default' => 'center',
		'options' => array(
			'left' => __( 'Left', 'hg-social-share' ),
			'center' => __( 'Center', 'hg-social-share' ),
			'right' => __( 'Right', 'hg-social-share' )
			)
		),
	array(
		'name' => 'us_pages_top_exclude',
		'label' => __( 'Exclude social top buttons on specific pages', 'hg-social-share' ),
		'desc' => __( 'If you want to exclude the social top buttons on any pages, type in their IDs here, for example: "1, 2"', 'hg-social-share' ),
		'type' => 'text',
		),
	array(
		'name' => 'us_pages_bottom',
		'label' => '<h2>'.__( 'Pages: bottom Buttons', 'hg-social-share' ).'</h2><img src="http://plugin-boutique.com/wp-content/uploads/2016/10/share-bottom.png">',
		'type' => 'multicheck',
		'options' => array(
			'facebook' => $facebook,
			'twitter' => $twitter,
			'googleplus' => $google,
			'pinterest' => $pinterest,
			'linkedin' => $linkedin,
			'stumble' => $stumble,
			'delicious' => $delicious,
			'buffer' => $buffer,
			'mail' => $mail,
			)
		),
	array(
		'name' => 'us_pages_bottom_align',
		'label' => __( 'Align Buttons', 'hg-social-share' ),
		'type' => 'radio',
		'default' => 'center',
		'options' => array(
			'left' => __( 'Left', 'hg-social-share' ),
			'center' => __( 'Center', 'hg-social-share' ),
			'right' => __( 'Right', 'hg-social-share' )
			)
		),
	array(
		'name' => 'us_pages_bottom_exclude',
		'label' => __( 'Exclude social bottom buttons on specific pages', 'hg-social-share' ),
		'desc' => __( 'If you want to exclude the social bottom buttons on any pages, type in their IDs here, for example: "1, 2"', 'hg-social-share' ),
		'type' => 'text',
		),
	array(
		'name' => 'us_posts_top',
		'label' => '<h2>'.__( 'Posts: Top Buttons', 'hg-social-share' ).'</h2><img src="http://plugin-boutique.com/wp-content/uploads/2016/10/share-top.png">',
		'type' => 'multicheck',
		'options' => array(
			'facebook' => $facebook,
			'twitter' => $twitter,
			'googleplus' => $google,
			'pinterest' => $pinterest,
			'linkedin' => $linkedin,
			'stumble' => $stumble,
			'delicious' => $delicious,
			'buffer' => $buffer,
			'mail' => $mail,
			)
		),
	array(
		'name' => 'us_posts_top_align',
		'label' => __( 'Align Buttons', 'hg-social-share' ),
		'type' => 'radio',
		'default' => 'center',
		'options' => array(
			'left' => __( 'Left', 'hg-social-share' ),
			'center' => __( 'Center', 'hg-social-share' ),
			'right' => __( 'Right', 'hg-social-share' )
			)
		),
	array(
		'name' => 'us_posts_top_exclude',
		'label' => __( 'Exclude social top buttons on specific posts', 'hg-social-share' ),
		'desc' => __( 'If you want to exclude the social top buttons on any posts, type in their IDs here, for example: "1, 2"', 'hg-social-share' ),
		'type' => 'text',
		),
	array(
		'name' => 'us_posts_bottom',
		'label' => '<h2>'.__( 'Posts: Bottom Buttons', 'hg-social-share' ).'</h2><img src="http://plugin-boutique.com/wp-content/uploads/2016/10/share-bottom.png">',
		'type' => 'multicheck',
		'options' => array(
			'facebook' => $facebook,
			'twitter' => $twitter,
			'googleplus' => $google,
			'pinterest' => $pinterest,
			'linkedin' => $linkedin,
			'stumble' => $stumble,
			'delicious' => $delicious,
			'buffer' => $buffer,
			'mail' => $mail,
			)
		),
	array(
		'name' => 'us_posts_bottom_align',
		'label' => __( 'Align Buttons', 'hg-social-share' ),
		'type' => 'radio',
		'default' => 'center',
		'options' => array(
			'left' => __( 'Left', 'hg-social-share' ),
			'center' => __( 'Center', 'hg-social-share' ),
			'right' => __( 'Right', 'hg-social-share' )
			)
		),
	array(
		'name' => 'us_posts_bottom_exclude',
		'label' => __( 'Exclude social bottom buttons on specific pages', 'hg-social-share' ),
		'desc' => __( 'If you want to exclude the social bottom buttons on any posts, type in their IDs here, for example: "1, 2"', 'hg-social-share' ),
		'type' => 'text',
		),
		array(
		'name' => 'us_floating',
		'label' => '<h2>'.__( 'Social Sidebar', 'hg-social-share' ).'</h2><img src="http://plugin-boutique.com/wp-content/uploads/2016/10/share-side.png">',
		'type' => 'multicheck',
		'options' => array(
			'facebook' => $facebook,
			'twitter' => $twitter,
			'googleplus' => $google,
			'pinterest' => $pinterest,
			'linkedin' => $linkedin,
			'stumble' => $stumble,
			'delicious' => $delicious,
			'buffer' => $buffer,
			'mail' => $mail,
			)
		),
	array(
		'name' => 'us_floating_url',
		'label' => __( 'Share Specific URL', 'hg-social-share' ),
		'desc' => __( 'If you want the user to always share one single URL, type it in here.', 'hg-social-share' ),
		'type' => 'text',
		),
	array(
		'name' => 'us_floating_exclude',
		'label' => __( 'Exclude social sidebar on specific pages or posts', 'hg-social-share' ),
		'desc' => __( 'If you want to exclude the social sidebar on any pages or posts, type in their IDs here, for example: "1, 2"', 'hg-social-share' ),
		'type' => 'text',
		),
	),
'us_advanced' => array(
	array(
		'name' => 'us_buffer_width',
		'label' => __( '<br>Please upgrade to the $5 version to access the advanced settings. </strong><br>You can upgrade here: <a href="http://plugin-boutique.com/social-media-buttons/">http://plugin-boutique.com/social-media-buttons/</a>', 'hg-social-share' ),
		'type' => 'text',
		),
	),
);

return $fields;
}

}