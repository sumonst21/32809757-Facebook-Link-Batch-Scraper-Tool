<?php
require_once __DIR__ . '/FacebookDebugger.php';

$accessToken = '';

$fb = new FacebookDebugger();
if (!empty($accessToken)) {
	$fb->accessToken = $accessToken;
}

// get urls from file
$urls = urls_from_file('urls.txt');

// process urls
foreach ($urls as $url) {
	$result = $fb->reload($url);
	if ($result) {
		$result = json_decode($result, true);
		if (isset($result['error'])) {
			echo 'Error: ' . $result['error']['message'] . PHP_EOL;
		} else {
			echo 'Success: ' . $url . PHP_EOL;
		}
	}
}

/**
 * Read urls from file
 *
 * @param  string $file
 *
 * @return array         
 * @author sumonst21 <sumonst21@gmail.com>
 */
function urls_from_file($file) {
    $urls = array();
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $urls[] = trim($line);
        }
        fclose($handle);
    } else {
        // error opening the file.
    }
    return $urls;
}
?>