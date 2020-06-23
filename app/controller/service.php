<?php
namespace App\Controller;

use App\Helpers\Cli;
use App\Services\Sha;

/**
 * Main controller
 * Class Service
 * @package App\Controller
 */
class Service
{
    /**
     * @return bool
     */
    public function getSha()
    {
        // Get CLI options
        $cli = new Cli();
        $options = $cli->getOptions();

        // Check if some arguments are missing
        if (!$cli->checkOptions($options)) {
            echo "Some arguments are missing.";
            echo "\r\nRequired arguments: '--repo' and '--branch'";
            echo "\r\nOptional arguments: '--service'";
            return false;
        }

        // Get SHA
        $obj = new Sha($options);
        echo $obj->getSha();
    }
}
