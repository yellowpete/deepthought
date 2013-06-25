<?php

class DeepThought {

	function DeepThought($config) {
		$this->api_url = "https://deepthought.probability.co.uk/";
		$this->prod_api_url = "https://deepthought.probability.co.uk/";
		$this->_loadConfig($config);
	}

	function _loadConfig($config = null) {
		if(!isset($config) || !is_array($config)) {
			throw new RuntimeException("DeepThought API: Invalid configuration");
		}
		$this->config = $config;
	}
	function activity_stream() {
		return $this->_sendToDeepThoughtService("activity.stream");
	}

	function partner_getAllBrands() {
		return $this->_sendToDeepThoughtService("partner.getAllBrands");
	}

	function partner_setGameDetails($params = array()) {
		return $this->_sendToDeepThoughtService("partner.setGameDetails", $params);
	}

	function partner_getGameDetails($params = array()) {
		return $this->_sendToDeepThoughtService("partner.getGameDetails", $params);
	}

	function partner_setCustomisationDetails($params = array()) {
		return $this->_sendToDeepThoughtService("partner.setCustomisationDetails", $params);
	}

	function partner_getCustomisationDetails($params = array()) {
		return $this->_sendToDeepThoughtService("partner.getCustomisationDetails", $params);
	}

	function reporting_keywordReport($params = array()) {
		return $this->_sendToDeepThoughtService("reporting.keywordReport", $params);
	}

	function user_create($params = array()) {
		return $this->_sendToDeepThoughtService("user.create", $params);
	}

	function _sendToDeepThoughtService($method, $params = array()) {

		$this->url = $this->api_url . $method . "?apiKey=" . urlencode($this->config["apiKey"]);
		if(isset($params) && is_array($params)) {
			foreach($params as $k=>$v) {
				$this->url .= "&" . urlencode($k) . "=" . urlencode($v);
			}
		}
		if (isset($params["format"]) && ($params["format"] == "xml" || $params["format"] == "json")) {
			$this->url .= "&format=" . $params["format"];
		} else {
			$this->url .= "&format=php";
		}
		// Send to Probability
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1800);
		if($this->api_url != $this->prod_api_url) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}
		$this->response = curl_exec($ch);
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
		} else {
			curl_close($ch);
			$response_data = unserialize(trim($this->response));
			if(isset($response_data['errorNum']) && $response_data['errorNum'] > 0) {
				throw new RuntimeException($this->url." DeepThought API:".$response_data['errorDescription'], $response_data['errorNum']);
			} else {
				if(isset($params["format"])) {
					return $this->response;
				}
				return $response_data;
			}
		}
	}
}

?>
