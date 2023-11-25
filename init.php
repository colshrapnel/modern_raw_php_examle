<?php

// This will let to have different config.php files on different servers
if (!file_exists('config.php')) {
    trigger_error('Create config.php based on config.sample.php');
}
$config = require 'config.php';

// Should be always E_ALL
error_reporting(E_ALL);
// whether to display errors or not
ini_set('display_errors', $config['dev_mode']);

session_start();


/**** Backward compatibility block allowing this example to work on PHP 8.0+ ****/
$mysqli_class_name = 'mysqli';
if (version_compare(PHP_VERSION, '8.2', '<')) {

    function mysqli_execute_query(mysqli $mysqli, string $query, ?array $params = null)
    {
        $stmt = $mysqli->prepare($query);
        if ($params) {
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }    
    
    class my_mysqli extends mysqli {
        public function execute_query(string $query, ?array $params = null)
        {
            return mysqli_execute_query($this, $query, $params);
        }
    }
    $mysqli_class_name = 'my_mysqli';
}

// turn on error reporting for mysql
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// connect to mysql
$db = new $mysqli_class_name(...$config['db']);
$db->set_charset($config['db_charset']);

