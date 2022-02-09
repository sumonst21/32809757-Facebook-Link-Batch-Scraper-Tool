<?php
// for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get urls from file
$urls = urls_from_file('urls.txt');

// process urls
foreach ($urls as $url) {
    $result = facebookDebugger($url);
    var_dump($result);
    $result = json_decode($result, true);
}

function facebookDebugger($url) {

    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v1.0/?id='. urlencode($url). '&scrape=1');
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $r = curl_exec($ch);
    return $r;
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