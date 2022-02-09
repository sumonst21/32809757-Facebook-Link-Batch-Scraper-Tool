<?php
class FacebookDebugger
{
	public $accessToken = '';
	public function __construct()
	{
		$this->accessToken = getenv('FACEBOOK_ACCESS_TOKEN');
	}
	public function reload($url)
	{
		$graph = 'https://graph.facebook.com/';
		if (empty($this->accessToken)) {
			throw new Exception('FACEBOOK_ACCESS_TOKEN is not set');
		}
		$post = 'id='.urlencode($url).'&scrape=true&access_token='.$this->accessToken;
		return $this->send_post($graph, $post);
	}

	private function send_post($url, $post)
	{
		$r = curl_init();
		curl_setopt($r, CURLOPT_URL, $url);
		curl_setopt($r, CURLOPT_POST, 1);
		curl_setopt($r, CURLOPT_POSTFIELDS, $post);
		curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($r, CURLOPT_CONNECTTIMEOUT, 5);
		$data = curl_exec($r);
		curl_close($r);
		return $data;
	}
}
