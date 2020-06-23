<?php
/**
 * Autoload needed classes
 */
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', strtolower($class) . '.php'));
});
