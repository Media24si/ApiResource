<?php

return [

	'defaults' => [
        /**
         * Configures a base URL for the client so that requests created using a relative URL are combined with the base_url
         * See: http://guzzle.readthedocs.org/en/latest/quickstart.html#creating-a-client
         */
        'base_uri' => '',
	],

	/**
	 * Event subscribers attached to client
	 * See: http://guzzle.readthedocs.org/en/latest/events.html#event-subscribers
	 *
	 * It support string or Closure.
	 * Example:
	 * 	'App\EventSubscriber',
	 * 	function() { return new App\EventSubscriber(); }
	 */
	'event-subscribers' => [
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
