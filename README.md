# Api Resource

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Simple guzzle wrapper to provide simple access to api endpoints.

## Install

Require this package with composer (Packagist) using the following command:

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
Register facade in `config/app.php`:
``` php
'Api' => 'Media24si\ApiResource\Facades\ApiResource'
```

## Usage

You can use package without configuration. Just use \Api facade in controllre (or inject Media24si\ApiResource\ApiResource in function/controler).

Call your endpoints as normal guzzle request:
``` php
\Api::get('http://httpbin.org'); // you get response object
```

## Config

**base_url**
Configures a base URL for the client so that requests created using a relative URL are combined with the base_url. Same as guzzle base_url (see offcial manual).

**defaults**
Associative array of Request Options that are applied to every request created by the client. See official manual.

**default_response**
Set default response type from functions.
Possible options:
- json
- xml
- empty (default)

Setting this to json and calling `\Api::get('endpoint')` is same as leaving it empy and call `\Api::get('endpoint')->json()`

**endpoints**
Array of defined endpoints. Here you can define your aliases for calling endpoints.

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

With endpoints defined you can make simple call `\Api::get('notification')`.
Default options can be overwriten `\Api::get('categories', ['query' => ['fields' => 'id, title, slug']])`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.