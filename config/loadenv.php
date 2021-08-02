<?php

if (!file_exists(BASE_PATH . '/config/env.php')) {
    echo "File config/env.php not found!";
    exit();
}

require_once(BASE_PATH . '/config/env.php');

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return $value;
    }
}
