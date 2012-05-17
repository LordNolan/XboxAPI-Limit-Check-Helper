<?php
/**
 * XboxAPI - Limit Check
 *
 * This is some example code for useage with the XboxAPI,
 * it will help you with the API limit within your code.
 *
 * @package             XboxAPI Limit Check
 * @author              Alan Wynn (djekl)
 * @copyright 			Copyright (c) 2012, djekl Developments.
 * @license             MIT - https://xboxapi.com/licenses/MIT
 * @link                https://xboxapi.com
 * @since               Version 1.0
 */

function limit_check($input) {
	list($current, $limit) = explode('/', $input);
	if ($current+1 >= $limit) {
		$limit_error = 'API Limit reached!';
		return FALSE;
	}
	return array('current' => $current+1, 'limit' => $limit);
}

$response = file_get_contents('https://xboxapi.com/profile/djekl');
if (!$response)
	die('invalid response');
$response = json_decode($response);
if (!$response)
	die('invalid json');

$API_Limit = $response->API_Limit;
$limit_check = limit_check($API_Limit);
if (!$limit_check)
	die('API Limit Reached');
else
	print "Current API limit is {$limit_check['current']} out of {$limit_check['limit']}";

?>