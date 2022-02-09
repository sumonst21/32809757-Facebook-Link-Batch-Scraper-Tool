<?php
require_once __DIR__ . '/FacebookDebugger.php';

$accessToken = '';

$fb = new FacebookDebugger();
if (!empty($accessToken)) {
	$fb->accessToken = $accessToken;
}

// get urls from file
$urls = urls_from_file('urls.txt');
if (!$urls)
    die('No urls to reload');

// process urls
foreach ($urls as $url) {
    try {
        $result = $fb->reload($url);
        if ($result) {
            $result = json_decode($result, true);
            if (isset($result['error'])) {
                echo 'Error: ' . $result['error']['message'] . PHP_EOL;
            } else {
                echo 'Success: ' . $url . PHP_EOL;
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        if ($e->getMessage() == 'FACEBOOK_ACCESS_TOKEN is not set') {
            break;
        }
    }
}

/**
 * Read urls from file
 *
 * @param string $file
 *
 * @return array|false
 * @author sumonst21 <sumonst21@gmail.com>
 */
function urls_from_file(string $file) {
    if (!file_exists($file)) {
        return false;
    }
    $urls = array();
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $urls[] = trim($line);
        }
        fclose($handle);
    } else {
        return false;
        // error opening the file.
    }
    return ($urls) ?: array();
}
