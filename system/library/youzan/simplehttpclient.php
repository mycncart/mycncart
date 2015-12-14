<?php
/**
 * @require curl-extension
 */
class Simplehttpclient {
	private static $boundary = '';
	
	public static function get($url, $params) {
		$url = $url . '?' . http_build_query($params);
		return self::http($url, 'GET');
	}

	public static function post($url, $params, $files = array()) {
		$headers = array();
		if (!$files) {
			$body = http_build_query($params);
		} else {
			$body = self::build_http_query_multi($params, $files);
			$headers[] = "Content-Type: multipart/form-data; boundary=" . self::$boundary;
		}
		return self::http($url, 'POST', $body, $headers);
	}

	/**
	 * Make an HTTP request
	 *
	 * @return string API results
	 * @ignore
	 */
	private static function http($url, $method, $postfields = NULL, $headers = array()) {
		$ci = curl_init();
		/* Curl settings */
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT, 'KdtApiSdk Client v0.1');
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ci, CURLOPT_TIMEOUT, 30);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ci, CURLOPT_ENCODING, "");
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 2);
		//curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
		curl_setopt($ci, CURLOPT_HEADER, FALSE);

		switch ($method) {
			case 'POST':
				curl_setopt($ci, CURLOPT_POST, TRUE);
				if (!empty($postfields)) {
					curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
				}
				break;
		}

		curl_setopt($ci, CURLOPT_URL, $url );
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );

		$response = curl_exec($ci);
		$httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		$httpInfo = curl_getinfo($ci);

		curl_close ($ci);
		return $response;
	}

	private static function build_http_query_multi($params, $files) {
		if (!$params) return '';

		$pairs = array();

		self::$boundary = $boundary = uniqid('------------------');
		$MPboundary = '--'.$boundary;
		$endMPboundary = $MPboundary. '--';
		$multipartbody = '';

		foreach ($params as $key => $value) {
			$multipartbody .= $MPboundary . "\r\n";
			$multipartbody .= 'content-disposition: form-data; name="' . $key . "\"\r\n\r\n";
			$multipartbody .= $value."\r\n";
		}
		foreach ($files as $key => $value) {
			if (!$value) {continue;}
			
			if (is_array($value)) {
				$url = $value['url'];
				if (isset($value['name'])) {
					$filename = $value['name'];
				} else {
					$parts = explode( '?', basename($value['url']));
					$filename = $parts[0];
				}
				$field = isset($value['field']) ? $value['field'] : $key;
			} else {
				$url = $value;
				$parts = explode( '?', basename($url));
				$filename = $parts[0];
				$field = $key;
			}
			$content = file_get_contents($url);
		
			$multipartbody .= $MPboundary . "\r\n";
			$multipartbody .= 'Content-Disposition: form-data; name="' . $field . '"; filename="' . $filename . '"'. "\r\n";
			$multipartbody .= "Content-Type: image/unknown\r\n\r\n";
			$multipartbody .= $content. "\r\n";
		}

		$multipartbody .= $endMPboundary;
		return $multipartbody;
	}
	
	
	/*
	private static function request($host, $data, $method = 'GET', $timeout = 5) {
		if (is_array($data)) $data = http_build_query($data);
		
		$parse = parse_url($host);
		$method = strtoupper ($method);
		if (!$parse) return null;
		if (!isset($parse['port']) || !$parse['port']) $parse['port'] = '80';
		if (!isset($parse['path'])) $parse['path'] = '/';
		if (!in_array($method, ['POST', 'GET'])) return null;
		
		$parse['host'] = str_replace(['http://', 'https://'], ['', 'ssl://'], $parse['scheme'] . "://") . $parse['host'];
		$fp = fsockopen($parse['host'], $parse['port'], $errnum, $errstr, $timeout);
		if (!$fp) throw new Exception('connect failed: ' . $errnum . ', ' . $errstr);
		
		$contentLength = '';
		$postContent = '';
		$query = isset($parse['query']) ? $parse['query'] : '';
		$parse['path'] = str_replace(['\\', '//'], '/', $parse['path']) . "?" . $query;
		if ($method == 'GET') {
			substr($data, 0, 1) == '&' && $data = substr($data, 1);
			$parse['path'] .= ($query ? '&' : '') . $data;
		} elseif ($method == 'POST') {
			$contentLength = "Content-length: " . strlen($data) . "\r\n";
			$postContent = $data;
		}
		//echo '<a href="' .$host . '?' . $data. '">JUMP</a>';
		$write = $method . " " . $parse['path'] . " HTTP/1.0\r\n";
		$write .= "Host: " . $parse['host'] . "\r\n";
		$write .= "Content-type: application/x-www-form-urlencoded\r\n";
		$write .= $contentLength;
		$write .= "Connection: close\r\n\r\n";
		$write .= $postContent;
		fwrite($fp, $write);
		
		$responseText = '';
		while ($data = fread($fp, 4096)) {
			$responseText .= $data;
		}
		fclose($fp);
		$responseText = trim(stristr($responseText, "\r\n\r\n" ), "\r\n");
		return $responseText;
	}
	*/
}