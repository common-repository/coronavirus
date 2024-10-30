<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mikezuidhoek.com/
 * @since      1.0.0
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/admin
 * @author     Mike Zuidhoek <vohotv@gmail.com>
 */
class Coronavirus_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}

	private function load_dependencies() {

		/**
		 * The class responsible which contains shared functionality between the admin area and 
		 * public-facing side of the website.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-coronavirus-shared-functionality.php';

		$this->shared_functionality = new Coronavirus_Shared_Functionality();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Coronavirus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Coronavirus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ($hook === 'toplevel_page_coronavirus') {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coronavirus-admin.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Coronavirus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Coronavirus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coronavirus-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_menu_page() {
		add_menu_page( 'Coronavirus', 'Coronavirus', 'manage_options', 'coronavirus', [$this, 'render_menu_page'], 'dashicons-admin-site');
	}

	public function render_menu_page() {
		require_once plugin_dir_path(__FILE__) . 'partials/coronavirus-settings.php';
	}

	public function save_settings(array $checkbox_ids) {
		/**
		 * If user can manage_options/is admin and matches the forms nonce, save the settings.
		 */
		if (current_user_can('manage_options') && isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'submit-settings')) {
			if (isset($_POST['save-settings']) ) {
				
				// Update color options.
				if (!empty($_POST['header-background-color'])) update_option('header_background_color', sanitize_hex_color($_POST['header-background-color']));
				if (!empty($_POST['header-text-color'])) update_option('header_text_color', sanitize_hex_color($_POST['header-text-color']));
				if (!empty($_POST['general-background-color'])) update_option('general_background_color', sanitize_hex_color($_POST['general-background-color']));
				if (!empty($_POST['general-text-color'])) update_option('general_text_color', sanitize_hex_color($_POST['general-text-color']));
				if (!empty($_POST['border-color'])) update_option('border_color', sanitize_hex_color($_POST['border-color']));

				// Update options which choose what data to display. Get's the $_POST index from the $checkbox_ids array.
				$corona_data_options = [];
				foreach ($checkbox_ids as $id => $display_value) {
					isset($_POST[$id]) ? $corona_data_options[$id] = sanitize_key($_POST[$id]) : $corona_data_options[$id] = 'off';
				}

				// Update whether to display flag or not 
				isset($_POST['display-flag']) ? update_option('display_flag', sanitize_key($_POST['display-flag'])) : update_option('display_flag', 'off');
				
				// Save data options and its chosen value.
				update_option('corona_data_options', $corona_data_options);
					
			} elseif (isset($_POST['reset-settings'])) {

				// Delete color settings when user choses to reset to default config.
				delete_option('header_background_color');
				delete_option('header_text_color');
				delete_option('general_background_color');
				delete_option('general_text_color');
				delete_option('border_color');
				
				delete_option('corona_data_options');

				delete_option('display_flag');
			}
		}
	}
}
