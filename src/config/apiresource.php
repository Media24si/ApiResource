<?php

return [


	/**
	 * Configures a base URL for the client so that requests created using a relative URL are combined with the base_url
	 * See: http://guzzle.readthedocs.org/en/latest/clients.html#creating-a-client
	 */
	'base_url' => '',

	/**
	 * Associative array of Request Options that are applied to every request created by the client.
	 * See: http://guzzle.readthedocs.org/en/latest/clients.html#request-options
	 */
	'defaults' => [

	],

	/**
	 * Default response
	 *
	 * Possible options: json, xml, empty
	 */
	'default_response' => '',

	/**
	 * Define your endpoints
	 *
	 * Example enpoint:
	 * 'endpoint' => [
	 *		'url' => '',
	 *		'options' => []
	 * ]
	 */
	'endpoints' => [

	]
];