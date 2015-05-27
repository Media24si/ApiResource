<?php namespace Media24si\ApiResource;

use GuzzleHttp\Client;
//use Symfony\Component\Debug\Exception\ClassNotFoundException;

class ApiResource extends Client
{

    /**
     * @var array
     */
    private $endpoints;

    /**
     * ApiResource constructor.
     */
    public function __construct()
    {
        parent::__construct(config('apiresource.defaults'));

        $this->endpoints = config('apiresource.endpoints');

        //$this->setSubscribers();
    }

    /*
    protected function setSubscribers()
    {
        /*
        $emitter = $this->getEmitter();

        $subscribers = config('apiresource.event-subscribers');

        foreach ($subscribers as $subscriber) {
            if (is_string($subscriber)) {
                if (!class_exists($subscriber)) {
                    throw new ClassNotFoundException();
                }

                $eventSubscriber = new $subscriber();
            } else {
                if ($subscriber instanceof \Closure) {
                    $eventSubscriber = $subscriber();
                }
            }

            if (!is_a($eventSubscriber, 'GuzzleHttp\Event\SubscriberInterface')) {
                throw new \InvalidArgumentException('Class must implement GuzzleHttp\Event\SubscriberInterface');
            }

            $emitter->attach($eventSubscriber);
        }
    }*/

    public function request($method, $uri = null, array $options = [])
    {
        // overwrite from endpoints
        if (isset($this->endpoints[$uri])) {
            $key = $uri;
            $uri = $this->endpoints[$key]['uri'];

            if (isset($this->endpoints[$key]['options']) && is_array($this->endpoints[$key]['options'])) {
                $options = array_replace_recursive($this->endpoints[$key]['options'], $options);
            }
        }

        $response = parent::request($method, $uri, $options);

        if ($response->hasHeader('Content-Type')) {
            switch ($response->getHeader('Content-Type')[0]) {
                case 'text/json':
                case 'application/json':
                    return collect( json_decode( $response->getBody() ));
                case 'text/xml':
                case 'application/xml':
                    return $response->xml();
            }
        }

        return $response;
    }
}