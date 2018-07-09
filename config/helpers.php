<?php

// Database helpers
if ($GLOBALS['is_localhost']) {
	$database = env('DB_DATABASE', 'forge');
	$username = env('DB_USERNAME', 'forge');
	$password = env('DB_PASSWORD', '');
} else {
	$database = env('DB_REMOTE_DATABASE', 'forge');
	$username = env('DB_REMOTE_USERNAME', 'forge');
	$password = env('DB_REMOTE_PASSWORD', '');
}
