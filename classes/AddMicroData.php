<?php

namespace PassionImpact;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PassionImpact\Interfaces\PassionImpactClassInterface;

/**
 * @class AddMicroData
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class AddMicroData extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        add_action('wp_head', [&$this, 'addEventsMicroData']);
        add_action('wp_head', [&$this, 'addPositionsMicroData']);
        add_action('wp_head', [&$this, 'addBlogMicroData']);
    }

    /**
     * @return string
     */
    private function getProtocol(): string
    {
        return stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @param string $path
     * @return mixed
     */
    private function getDataFromEndPoint(string $path)
    {
        try {
            /// wp-json/passion-impact/v1/events/group
            $client = new Client([
                'timeout' => 2.0,
            ]);

            $protocol = $this->getProtocol();

            $request = new Request('GET',
                $protocol . $_SERVER['HTTP_HOST'] . $path,
            );

            $finalPromise = $client->sendAsync($request)->then(function (Response $response1) use ($client) {

                return $response1;

            });

            // The decoded JSON from the second query here.
            $finalResponse = $finalPromise->wait();

            return json_decode($finalResponse->getBody());

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            echo \GuzzleHttp\json_encode($response->getBody()->getContents());
        }
    }


    /**
     *
     * @param object $event
     * @return string
     */
    private function getEventStatus(object $event): string
    {
        if ($event->cancelled === 'yes') {

            $eventStatus = 'https://schema.org/EventCancelled';

        } else {

            $eventStatus = 'https://schema.org/EventScheduled';

        }

        return $eventStatus;
    }

    /**
     * @description Build Schema for each of the events on the events page.
     * @author Keith Murphy | nomadmystics@gmail.com
     * @link https://schema.org/event
     *
     * @return void
     */
    public function addEventsMicroData(): void
    {
        if (function_exists('is_page') && is_page('events-page')) {
            $finalArray = [];

            $eventData = $this->getDataFromEndPoint('/wp-json/passion-impact/v1/events/group');

            if (isset($eventData) && !empty($eventData) && is_object($eventData)) {
                foreach ($eventData as $eventKey => $eventValue) {
                    if (isset($eventKey) && !empty($eventKey) && $eventValue->is_published !== 'no' && isset($eventValue->title) && !empty($eventValue->title)) {
                        $event = (object) [
                            '@context' => 'https://schema.org',
                            '@type' => 'event',
                            'name' => $eventValue->title,
                            'startDate' => !empty($eventValue->start_date_time) ? $eventValue->start_date_time : $eventValue->created,
                            'endDate' => !empty($eventValue->end_date_time) ? $eventValue->end_date_time : null,
                            'eventStatus' => $this->getEventStatus($eventValue),
                            'url' => 'https://www.givepulse.com/event/' . $eventValue->id,
                            'image' => $eventValue->image,
                            'organizer' => (object) [
                                '@type' => 'Organization',
                                'name' => $eventValue->group_title,
                                'url' => 'https://passionimpact.org',
                            ],
                            'description' => $eventValue->description,
                            'location' => (object) [
                                '@type' => 'Place',
                                'address' =>  (object) [
                                    '@type' => 'PostalAddress',
                                    'addressLocality' => $eventValue->city,
                                    'addressRegion' => $eventValue->state,
                                    'streetAddress' => $eventValue->address1,
                                ],
                                'name' => $eventValue->title,
                            ],
                        ];

                        $finalArray[] = $event;
                    }
                }

                echo '<script type="application/ld+json">' . json_encode($finalArray) . '</script>';
            }
        }
    }

    /**
     * @description Build Schema for the blog posts.
     * @author Keith Murphy | nomadmystics@gmail.com
     * @global $wp_query
     *
     * @return void
     */
    public function addBlogMicroData(): void
    {
        global $wp_query;

        $protocol = $this->getProtocol();

        $finalArray = [];

        // Only do this on the blogs page
        if (isset($wp_query) && (bool) $wp_query->is_posts_page) {
            // Get our blog posts
            $blogPosts = $wp_query->posts;

            foreach ($blogPosts as $postKey => $postValue) {
                if (isset($postValue) && !empty($postValue)) {
                    // Build our image
                    $thumbnail = get_the_post_thumbnail_url($postValue->ID);

                    // Use the default if it doesn't exist
                    if (function_exists('has_post_thumbnail') && !has_post_thumbnail($postValue->ID)) {
                        $thumbnail = get_template_directory_uri() . '/src/img/passion-impact-logo.png';
                    }

                    $post = (object) [
                        '@context' => 'https://schema.org',
                        '@type' => 'BlogPosting',
                        'headline' => $postValue->post_title,
                        'image' => $thumbnail,
                        'url' => $protocol . $_SERVER['HTTP_HOST'] . '/' . $postValue->post_name,
                        'editor' => get_the_author_meta('display_name', $postValue->post_author),
                        'publisher' => 'Passion Impact',
                        'datePublished' => $postValue->post_date,
                        'dateCreated' => $postValue->post_date,
                        'description' => $postValue->post_excerpt,
                        'articleBody' => $postValue->post_content,
                        'author' => (object) [
                            '@type' => 'Person',
                            'name' => get_the_author_meta('display_name', $postValue->post_author),
                        ],
                    ];

                    $finalArray[] = $post;
                }
            }

            echo '<script type="application/ld+json">' . json_encode($finalArray) .  '</script>';
        }
    }

    /**
     * @description Create our json+ld for each positions on th positions page.
     * @author Keith Murphy | nomadmystics@gmail.com
     * @link https://schema.org/JobPosting
     *
     * @return void
     */
    public function addPositionsMicroData(): void
    {
        $positionsData = $this->getDataFromEndPoint('/wp-json/passion-impact/v1/events/positions');
        $finalArray = [];

        // Make sure we are on the right page
        if (function_exists('is_page') && is_page('positions-page')) {

            // Create our json+ld for the positions page
            if (isset($positionsData->results) && !empty($positionsData->results)) {
                foreach ($positionsData->results as $positionKey => $position) {
                    if (isset($position) && !empty($position) && $position->is_published === 'yes') {
                        $positionSchema = (object) [
                            '@context' => 'https://schema.org',
                            '@type' => 'JobPosting',
                            'title' => $position->title,
                            'hiringOrganization' => 'Passion Impact Org',
                            'datePosted' => !empty($position->start_date_time) ? $position->start_date_time : $position->created,
                            'jobLocation' => (object) [
                                '@type' => 'Place',
                                'address' =>  (object) [
                                    '@type' => 'PostalAddress',
                                    'addressLocality' => !empty($position->city) ? $position->city : 'Portland',
                                    'addressRegion' => !empty($position->state) ? $position->state : 'OR',
                                    'streetAddress' => !empty($position->address1) ? $position->address1 : '1200 5106 SE Powell Blvd',
                                    'postalCode' => !empty($position->zip) ? $position->zip : '97206'
                                ],
                                'name' => 'Passion Impact Org',
                            ],
                            'url' => 'https://www.givepulse.com/event/' . $position->id,
                            'image' => $position->image,
                            'employmentType' => $position->kind_of_event,
                            'description' => $position->description,
                        ];

                        $finalArray[] = $positionSchema;
                    }
                }

                echo '<script type="application/ld+json">' . json_encode($finalArray) . '</script>';
            }
        }
    }
}
