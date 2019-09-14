<?php
spl_autoload_register(
/**
 * @param string $class
 */
    function ($class) {
        $class = str_replace("\\", "/", $class);
        include_once __DIR__ . '/' . "../" . $class . ".php";

    }
);