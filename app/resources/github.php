<?php
namespace App\Resources;

use App\Helpers\Curl;

/**
 * GitHub Service
 * @package App\Resources
 */
class Github
{
    private $apiUrl = 'https://api.github.com/repos/'; // api url
    private $branchPath = '/branches/'; // branch path
    private $ownerRepo; // repo
    private $branch; // branch

    /**
     * Github constructor.
     * Set repo and branch variables
     * @param $ownerRepo
     * @param $branch
     */
    public function __construct(string $ownerRepo, string $branch)
    {
        $this->ownerRepo = $ownerRepo;
        $this->branch = $branch;
    }

    /**
     * Get SHA from last commit
     * @return array
     */
    public function getSha() : array
    {
        // Generate URL and make API call
        $generatedUrl = $this->generateUrl();

        $curlCall = Curl::callAPI($generatedUrl);

        // Check if there is no error message
        if (!empty($curlCall->message)) {
            return ['error' => $curlCall->message];
        }

        // return SHA
        return ['sha' => $curlCall->commit->sha];
    }

    /**
     * Generate API call URL
     * @return string
     */
    private function generateUrl() : string
    {
        return $this->apiUrl.$this->ownerRepo.$this->branchPath.$this->branch;
    }
}
