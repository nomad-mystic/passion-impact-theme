<?php

namespace PassionImpact;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PassionImpact\Interfaces\PassionImpactClassInterface;
use WP_REST_Request;
use WP_REST_Server;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class RestEndpoints
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class RestEndpoints extends PassionImpactSingleton implements PassionImpactClassInterface
{
    private string $password = '';
    private string $username = '';
    private int $passion_group_id = 123521;
    private int $offset = 0;
    private string $token = '';
    private array $events = [];
    private array $finalGroupEvents = [];
    private array $queryParameters = [];

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->buildEndpoints();
    }

    /**
     * @description Build our API endpoints
     *
     * @return void
     */
    public function buildEndpoints(): void
    {
        // Get the positions API endpoint
        add_action('rest_api_init', function () {
            register_rest_route( 'passion-impact/v1', 'events/positions', [
                'methods' => 'GET',
                'callback' => [&$this, 'getPositions'],
                'permission_callback' => function () {
                    return '__return_true';
                }
            ]);
        });

        add_action('rest_api_init', function () {
            register_rest_route( 'passion-impact/v1', 'events/group/(?P<id>\d+)', [
                'methods' => WP_REST_Server::READABLE,
                'callback' => [&$this, 'getGivePulseGroupEvents'],
                'permission_callback' => function () {
                    return '__return_true';
                }
            ]);
        });

        add_action('rest_api_init', function () {
            register_rest_route( 'passion-impact/v1', 'events/group', [
                'methods' => WP_REST_Server::READABLE,
                'callback' => [&$this, 'getGivePulseGroupEvents'],
                'permission_callback' => function () {
                    return '__return_true';
                }
            ]);
        });

        add_action('rest_api_init', function () {
            register_rest_route( 'passion-impact/v1', 'group', [
                'methods' => WP_REST_Server::READABLE,
                'callback' => [&$this, 'getGivePulseGroups'],
                'permission_callback' => function () {
                    return '__return_true';
                }
            ]);
        });
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @example https://api2.givepulse.com/events?tag=Positions&limit=50
     *
     * @return void
     */
    public function getPositions(): void
    {
        try {
            $client = new Client([
                'timeout' => 2.0,
            ]);

            $headers = [
                'Authorization' => 'Basic '. base64_encode($this->password . ':' . $this->username),
            ];

            $request = new Request('GET',
                'https://api2.givepulse.com/auth',
                $headers,
            );

            $finalPromise = $client->sendAsync($request)->then(function (Response $response1) use ($client) {
                // Get our token
                $token =  json_decode($response1->getBody());

                // Set our token
                $this->token = $token->token;

                // Build our Request
                $request = new Request('GET', 'https://api2.givepulse.com/events/?' . http_build_query([
                        'tag' => 'Positions',
                        'limit' => 50,
                    ]),
                    [
                        'Authorization' => 'Bearer ' . $this->token,
                        'Accept' => 'application/json',
                    ]);

                $positions = $client->sendAsync($request)->then(function (Response $groupEvents) {

                    echo $groupEvents->getBody()->getContents();

                    exit();
                });

                return $positions;
            });

            // The decoded JSON from the second query here.
            $response2 = $finalPromise->wait();

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            echo \GuzzleHttp\json_encode($response->getBody()->getContents());
        }
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @description Call the for the PI group information. This is used on the ACF events page.
     *
     * @return void
     */
    public function getGivePulseGroups(): void
    {

        try {
            $client = new Client([
                'timeout' => 2.0,
            ]);

            $headers = [
                'Authorization' => 'Basic '. base64_encode($this->password . ':' . $this->username),
            ];

            $request = new Request('GET',
                'https://api2.givepulse.com/auth',
                $headers,
            );

            $finalPromise = $client->sendAsync($request)->then(function (Response $response1) use ($client) {
                // Get our token
                $token =  json_decode($response1->getBody());

                // Set our token
                $this->token = $token->token;

                // Build our Request
                $request = new Request('GET', 'https://api2.givepulse.com/group/?' . http_build_query(['id' => $this->passion_group_id]), [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ]);

                $groups = $client->sendAsync($request)->then(function (Response $groupEvents) {

                    echo $groupEvents->getBody()->getContents();

                    exit();
                });

                return $groups;
            });

            // The decoded JSON from the second query here.
            $response2 = $finalPromise->wait();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            echo \GuzzleHttp\json_encode($response->getBody()->getContents());
        }
    }

    /**
     * @description Build and call our Give Pulse Events API
     *
     * @param WP_REST_Request $api_request
     * @return void
     */
    public function getGivePulseGroupEvents(WP_REST_Request $api_request): void
    {

        try {
            $this->queryParameters['id'] = $api_request->get_param('id');

            $client = new Client([
                'timeout' => 2.0,
            ]);

            $headers = [
                'Authorization' => 'Basic '. base64_encode($this->password . ':' . $this->username),
            ];

            $request = new Request('GET',
                'https://api2.givepulse.com/auth',
                $headers,
            );

            // Chain our API calls
            $finalPromise = $client->sendAsync($request)->then(function (Response $response1) use ($client) {
                // Get our token
                $token =  json_decode($response1->getBody());

                // Set our token
                $this->token = $token->token;

                // Build Query Parameters
                $params = $this->buildParamsRequest(50, 0);

                // Build our request
                $request = $this->buildRequest($params);

                $secondPromise = $client->sendAsync($request)->then(function (Response $response2) use ($client) {

                    // Gather our first list of
                    $this->events[0] = (array) \GuzzleHttp\json_decode($response2->getBody()->getContents());

                    $this->finalGroupEvents = array_merge($this->finalGroupEvents, $this->events[0]['results']);

                    // Build Query Parameters
                    $params = $this->buildParamsRequest(50, 51);

                    // Build our request
                    $request = $this->buildRequest($params);

                    $thirdPromise = $client->sendAsync($request)->then(function (Response $response3) use ($client) {

                        $this->events[1] = (array) json_decode($response3->getBody()->getContents());

                        $this->finalGroupEvents = array_merge($this->finalGroupEvents, $this->events[1]['results']);

                        // Build Query Parameters
                        $params = $this->buildParamsRequest(50, 102);

                        // Build our request
                        $request = $this->buildRequest($params);

                        $fourthPromise = $client->sendAsync($request)->then(function (Response $response4) use ($client) {

                            $this->events[2] = (array) json_decode($response4->getBody()->getContents());

                            $this->finalGroupEvents = array_merge($this->finalGroupEvents, $this->events[2]['results']);

                            echo \GuzzleHttp\json_encode($this->finalGroupEvents);

                            exit();

                        });

                        return $fourthPromise;
                    });

                    return $thirdPromise;

                });

                return $secondPromise;
            });

            // The decoded JSON from the second query here.
            $response2 = $finalPromise->wait();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            echo \GuzzleHttp\json_encode($response->getBody()->getContents());
        }
    }

    /**
     * @description Build our query parameters
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    private function buildParamsRequest(int $limit = 50, int $offset = 0): array
    {
        $params = [
            'group_id' => (isset($this->queryParameters['id']) && !empty($this->queryParameters['id'])) ? $this->queryParameters['id'] : $this->passion_group_id,
            'offset' => $offset,
            'limit' => $limit,
            'type' => 'all',
        ];

        return $params;
    }

    /**
     * @param array $params
     * @return Request
     */
    private function buildRequest(array $params): Request
    {
        $request = new Request('GET', 'https://api2.givepulse.com/events?' . http_build_query($params), [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ]);

        return $request;
    }

    /**
     * @throws GuzzleException
     */
    public function callGivePulse(): void
    {
        $client = new Client([
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET',
            'https://api2.givepulse.com/auth',
            [
                'auth' => ['0nNA5ZOXhPtHDSwbuPz1f053SZClmbVE:eS9ZKPaLESrJnMuQYpzoGa5Q88GzDVcj', 'nomadmystics@gmail.com:yaiw0LOR*suw_cur'],
            ]
        );

        $body = $response->getBody()->getContents();

        echo $body;
    }
}
