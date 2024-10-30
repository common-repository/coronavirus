<?php

/**
 * The file that contains shared functionality.
 *
 * @link       https://mikezuidhoek.com/
 * @since      1.0.0
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/includes
 */

/**
 *
 * @since      1.0.0
 * @package    Coronavirus
 * @subpackage Coronavirus/includes
 * @author     Mike Zuidhoek <vohotv@gmail.com>
 */

class Coronavirus_Shared_Functionality {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	
	/**
	 * Get the data of the API.
	 */
    public function get_corona_data(string $country) {
		$country_slug = str_replace(' ', '%20', $country);
		
		// // If country attribute is omitted display global data.
		$url = empty($country) ? "https://ev3klr6bchdcdowp.disease.sh/v3/covid-19/all" : "https://ev3klr6bchdcdowp.disease.sh/v3/covid-19/countries/$country_slug";

		// Add unique user agent, requested by the COVID API team.
		$response = wp_remote_get( $url, array(
			'user-agent' => 'Coronavirus/1.0.0'
		));
		
		$body = json_decode(wp_remote_retrieve_body( $response ));

		return $body;
	}
}
