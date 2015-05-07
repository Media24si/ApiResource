<?php namespace Media24si\ApiResource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\RequestInterface;

class ApiResource extends Client {

	/**
	 * @var array
	 */
	private $endpoints;

	/**
	 * ApiResource constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'base_url' => config('apiresource.base_url'),
				'defaults' => config('apiresource.defaults')
			]
		);

		$this->endpoints = config('apiresource.endpoints');
	}

	public function send(RequestInterface $request)
	{
		$result = parent::send($request);

		switch ($result->getHeader('content-type')) {
			case 'text/json':
			case 'application/json':
				return $result->json();
			case 'text/xml':
			case 'application/xml':
				return $result->xml();
		}

		return $result;
	}

	public function createRequest($method, $url = null, array $options = [])
	{
		// overwrite from endpoints
		if ( isset($this->endpoints[$url]) ) {
			$key = $url;
			$url = $this->endpoints[$key]['url'];

			if ( isset($this->endpoints[$key]['options']) && is_array($this->endpoints[$key]['options']) ) {
				$options = array_replace_recursive($this->endpoints[$key]['options'], $options);
			}
		}

		return parent::createRequest($method, $url, $options);
	}

	/**
	 * @return string
	 */
	public function getDefaultResponse()
	{
		return $this->default_response;
	}

	/**
	 * @param string $default_response
	 */
	public function setDefaultResponse($default_response)
	{
		$this->default_response = $default_response;
		return $this;
	}


}