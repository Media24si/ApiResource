<?php namespace Media24si\ApiResource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\RequestInterface;
use Symfony\Component\Debug\Exception\ClassNotFoundException;

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

		$this->setSubscribers();
	}

	protected function setSubscribers() {
		$emitter = $this->getEmitter();

		$subscribers = config('apiresource.event-subscribers');

		foreach( $subscribers as $subscriber) {
			if ( is_string($subscriber) ) {
				if ( !class_exists($subscriber) ) {
					throw new ClassNotFoundException();
				}

				$eventSubscriber = new $subscriber();
			}
			else if ( $subscriber instanceof \Closure ) {
				$eventSubscriber = $subscriber();
			}

			if ( !is_a($eventSubscriber, 'GuzzleHttp\Event\SubscriberInterface') ) {
				throw new \InvalidArgumentException('Class must implement GuzzleHttp\Event\SubscriberInterface');
			}

			$emitter->attach($eventSubscriber);
		}
	}

	public function send(RequestInterface $request)
	{
		$result = parent::send($request);

		switch ($result->getHeader('content-type')) {
			case 'text/json':
			case 'application/json':
				return collect($result->json());
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