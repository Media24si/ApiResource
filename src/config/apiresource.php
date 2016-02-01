<?php

return [

	/**
	 * Configure client constructor parameters. Example: base_uri, handler, ....
	 */
	'defaults' => [
        /**
         * Configures a base URL for the client so that requests created using a relative URL are combined with the base_url
         * See: http://guzzle.readthedocs.org/en/latest/quickstart.html#creating-a-client
         */
        'base_uri' => '',
	],

	/**
	 * Merge params on request
	 */
	'merge' => [
	],

	/**
	 * Define your endpoints
	 *
	 * Example endpoint:
	 * 'endpoint' => [
	 *		'uri' => '',
	 *		'options' => []
	 * ]
	 */
	'endpoints' => [

	]
];
