<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mikezuidhoek.com/
 * @since      1.0.0
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/public
 * @author     Mike Zuidhoek <vohotv@gmail.com>
 */
class Coronavirus_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coronavirus-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coronavirus-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Render shortcode and get nessecary data for the template to use.
	 */
	public function render_shortcode($atts) {
		extract(shortcode_atts(array(
            'country' => '',
		), $atts));

		$country_data = $this->shared_functionality->get_corona_data($country);
		// Contains which options the user wants to display.
		$corona_data_options = get_option('corona_data_options');

        // Display error when a message is in the response, usually caused by using a wrong country name.
        if(!empty($country_data->message)) {
            ob_start();
            require plugin_dir_path( __FILE__ ) . 'partials/error.php';
            
            return ob_get_clean();
        }

		ob_start();
		require plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shared-partials/coronavirus-info.php';

		return ob_get_clean();
	}
}
