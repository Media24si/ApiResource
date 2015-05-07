# Api Resource

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A simple Guzzle wrapper, providing easy access to API endpoints.

## Install

Require this package with Composer (Packagist), using the following command:

``` bash
$ composer require media24si/api-resource
```

Register the ApiResourceServiceProvider to the providers array in `config/app.php`

``` php
'Media24si\ApiResource\ApiResourceServiceProvider',
```

Publish vendor files (config file):
``` bash
$ art vendor:publish
```

**Optional**
Register the facade in `config/app.php`:
``` php
'Api' => 'Media24si\ApiResource\Facades\ApiResource'
```

## Usage

You can use this package without any configuration. Just use the \Api facade in your controller (or inject Media24si\ApiResource\ApiResource in your function/controller).

Call your endpoints, like you would a normal Guzzle request:
``` php
\Api::get('http://httpbin.org'); // returns a response object
```

## Config

**base_url**
Configures a base URL for the client, so that requests created using a relative URL are combined with the base_url. Same as guzzle base_url. For more, see the official [manual].

**defaults**
Associative array of Request Options that are applied to every request created by the client. See the official [manual].

**endpoints**
Array of defined endpoints. Here you can define your aliases for endpoints.

Sample array:
``` php
'endpoints' => [
	'notification' => [
		'url' => 'http://httpbin.org/notification'
	],
	'categories' => [
		'url' => '/categories', // with base_url set
		'options' => [
			'query' => [
				'fields' => 'id, title'
			]
		]
	]
]
```

With endpoints defined you can make simple calls. A sample would be: 
``` php
\Api::get('notification')
```

Default options can be overridden: 
``` php
\Api::get('categories', ['query' => ['fields' => 'id, title, slug']])
```

**event-subscribers**
Attact event subscribers to emmiter.
You can add subscriber as class name or as a Closure. All classes **must** implement ```GuzzleHttp\Event\SubscriberInterface```

Sample:
``` php
'event-subscribers' => [
	'App\EventSubscriber',
	function() { return new App\EventSubscriber(); }
],
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[manual]: http://guzzle.readthedocs.org/en/latest/
