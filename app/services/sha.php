<?php
namespace App\Services;

use App\Resources\Github;

/**
 * Main service for getting SHA value from different services
 * @package App\Services
 */
class Sha
{
    private $service = 'github'; // default service
    private $ownerRepo; // repo
    private $branch; // branch

    /**
     * Sha constructor.
     * Set options values as a class variables
     * To make them accessible from other functions
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->ownerRepo = $options['repo'];
        $this->branch = $options['branch'];

        // If 'service' wasn't given from cli, set the default one
        if (!empty($options['service'])) {
            $this->service = $options['service'];
        }
    }

    /**
     * Get SHA value/make a API call from given service
     * @return array
     */
    private function loadResource() : array
    {
        // Get SHA value from given service
        switch ($this->service) {
            case 'github':
                // Get SHA value from Gtihub
                $resource = new Github($this->ownerRepo, $this->branch);
                $response = $resource->getSha();
                break;

            default:
                // If given service isn't implemented yet - inform the user
                return ['error' => 'We are not supporting this service yet!'];
                break;
        }

        return $response;
    }

    /**
     * Get SHA value with message
     * @return string
     */
    public function getSha() : string
    {
        // Make API call to service
        $response = $this->loadResource();

        // Return and parse message
        return $this->parseMessage($response);
    }

    /**
     * @param $response
     * @return string
     */
    private function parseMessage(array $response) : string
    {
        // Check if there is no error with getting SHA value
        if (isset($response['error'])) {
            return 'Oopsss... we had some problems with getting last commit SHA value: "'.$response['error'].'"';
        }

        // Success! Return success message with SHA value
        return 'Woohoo! We got it! Last commit SHA value is: "'.$response['sha'].'"';
    }
}
