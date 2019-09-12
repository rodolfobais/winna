<?php

/**
 * @property DB $db
 */
class ModelToolIP2LocationRedirector extends Model {

    /**
     * @param $from
     * @return array
     */
    public function getRule($from) {
		$this->load->model('setting/setting');

		$from = ltrim($from, '/');

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "ip2location_redirector` WHERE `status` = '1'");

		foreach ($query->rows as $result) {
			$trigerred = false;

			if ($from == $result['to'])
				return false;

			switch (substr($result['from'], 0, 1)) {
				case '=':
					if (substr($result['from'], 1) == $from)
						$trigerred = true;

					break;

				case '^':
					if (substr($from, 0, strlen(substr($result['from'], 1))) === substr($result['from'], 1))
						$trigerred = true;

					break;

				case '*':
					if (preg_match('/' . substr($result['from'], 1) . '/', $from))
						$trigerred = true;

					break;
			}

			if ($trigerred) {
				$records = array(
					'countryCode' => '',
					'regionName' => '',
				);

				$settings = $this->model_setting_setting->getSetting('ip2location');

				$ipAddress = $_SERVER['REMOTE_ADDR'];

				if (isset($_SERVER['DEV_MODE']))
					$ipAddress = '175.144.151.253';

				if ($settings['ip2location_lookup_method'] == 0) {
					require_once(DIR_SYSTEM . 'library/ip2location/class.IP2Location.php');

					$geolocation = new \IP2Location\Database($settings['ip2location_database_location'], \IP2Location\Database::FILE_IO);
					$records = $geolocation->lookup($ipAddress, \IP2Location\Database::ALL);

					unset($geolocation);
				}
				else {
					$ch = curl_init();
					curl_setopt_array($ch, array(
						CURLOPT_HEADER			=> 0,
						CURLOPT_URL				=> 'http://api.ip2location.com/?&key=' . $settings['ip2location_api_key'] . '&package=WS3&format=json&ip=' . $ipAddress,
						CURLOPT_RETURNTRANSFER	=> 1,
						CURLOPT_TIMEOUT			=> 10,
						CURLOPT_SSL_VERIFYPEER	=> 0,
					));
					$response = curl_exec($ch);
					curl_close($ch);

					if($json = json_decode($response)){
						$records = array(
							'countryCode' => $json->country_code,
							'regionName' => $json->region_name,
						);
					}
				}

				$origins = json_decode($result['origins']);

				foreach ($origins as $origin) {
					if ($origin->code == '*')
						return array(
							'to'	=> $result['to'],
							'code'	=> $result['code'],
						);

					if ($origin->code == $records['countryCode']) {
						if($origin->region == '*')
							return array(
								'to'	=> $result['to'],
								'code'	=> $result['code'],
							);

						if ($origin->region == $records['regionName'])
							return array(
								'to'	=> $result['to'],
								'code'	=> $result['code'],
							);
					}
				}
			}
		}
    }

    /**
     * @return bool
     */
    public function isModuleEnabled() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `type` = 'module' AND `code` = 'ip2location_redirector'");

        return $query->num_rows > 0;
    }
}
