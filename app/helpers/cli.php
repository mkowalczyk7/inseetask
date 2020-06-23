<?php
namespace App\Helpers;

/**
 * Class Cli
 * @package App\Helpers
 */
class Cli
{
    /**
     * Get options from CLI
     * @return array
     */
    public function getOptions() : array
    {
        // Initiate 3 arguments: service, repo, branch
        $longopts  = array(
            "service::",
            "repo::",
            "branch::",

        );

        // Get options from CLI
        $options = getopt('', $longopts);

        // Check if arguments aren't empty, if yes, just return an empty array
        if (empty($options)) {
            return [];
        }

        // Return options
        return $options;
    }

    /**
     * Check required options
     * @param array $options
     * @return bool
     */
    public function checkOptions(array $options) : bool
    {
        // Check if repo and branch options are not empty
        if (empty($options['repo']) || empty($options['branch'])) {
            return false;
        }

        return true;
    }
}
