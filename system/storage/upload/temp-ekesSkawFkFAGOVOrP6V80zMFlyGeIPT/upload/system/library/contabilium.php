<?php
/**
* 2018 Contabilium.com
*
* Libreria para la conexion con Contabilium
* Basada en la libreria connector.php creado por Federico Ferreri <federico@ferreri.com.ar>
* para el plugin de PrestaShop
*
*  @author    David Suarez <info@davidsuarez.com.ar>
*  @copyright Contabilium S.A.
*/

class Contabilium {
    private $logger;
    private $config;
    private $cache;
    private static $instance;
    private $api_base = 'https://rest.contabilium.com/';
   
    /**
     * @param  object  $registry  Registry Object
     */
    public static function get_instance($registry) {
        if (is_null(static::$instance)) {
            static::$instance = new static($registry);
        }

        return static::$instance;
    }
 
    /** 
     * @param  object  $registry  Registry Object
     * @param  object  $config  Config Object
     * 
     * You could load some useful libraries, few examples:
     *
     *   $registry->get('db');
     *   $registry->get('cache');
     *   $registry->get('session');
     *   $registry->get('config');
     *   and more... 
     */
    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->cache = $registry->get('cache');
        // load the "Log" library from the "Registry"
        $this->logger = new Log('contabilium.log');
    }

    public function token() {

		$user = $this->config->get('module_contabilium_email');
		$key = $this->config->get('module_contabilium_apikey');
		
		$credentials = false;
		$maketoken = false;

        $tokencache = unserialize($this->cache->get('module_contabilium_token_cache'));
        
		// Veridicamos que no exista un token
		if(empty($tokencache)){
			$maketoken = true;
		} else if ($tokencache['expires_ts'] > time()) {
			$credentials = $tokencache['data'];
		} else {
			$maketoken = true;
		}
	
		if($maketoken && !empty($user) && !empty($key)){
			$data = $this->post($this->api_base . 'token', array('client_id' => $user, 'client_secret' => $key, 'grant_type' => 'client_credentials'), true);

			if ($data !== false && !is_null($data) && !isset($data->error)) {
				$credentials = $data;
				
				$expiretime = $data->expires_in;
				
				$cache = array(
					'expires_ts' => time() + $expiretime,
					'data' => $data,
                );
                $this->cache->set('module_contabilium_token_cache', serialize($cache));
            } else if(isset($data->error)) {
                $this->logger->write($data->error);
            }
		}

		return $credentials;
    }

    /**
     * @param  string  $url     Url
     * @param  string  $token  Token 
     */   
    public function get($url)
    {
        $ch = curl_init();

        $token = $this->token()->access_token;

        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));

        $output = curl_exec($ch);
        if ($output) {
            $output = json_decode($output);
        }

        curl_close($ch);
        return $output;
    }

    /**
     * @param  string  $url     Url
     * @param  array  $params  Key-value pair
     * @param  string  $token  Token
     * @param  bolean  $isAuthRequest  true | false
     * @param  bolean  $debug  true | false
     */
    public function post($url, $params, $isAuthRequest = false, $debug = false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, $debug);
        curl_setopt($ch, CURLINFO_HEADER_OUT, $debug);

        if (!$isAuthRequest) {

            $token = $this->token()->access_token;

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ));

            $postData = json_encode($params);
        } else {
            $postData = http_build_query($params);
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output = curl_exec($ch);

        if ($output !== false) {
            $output = json_decode($output);
        } else {
            $this->logger->write(curl_error($ch));
        }

        if ($debug) {
            $this->logger->write(sprintf("--- [ BEGIN DEBUG ] ----------\nCURL_INFO:----------\n%s\nOUT: %s\nPOST_DATA:\n%s\n----------\n--- [ END DEBUG ] ----------\n", print_r(curl_getinfo($ch), true), var_export($output, true), print_r($postData, true)));
        }

        curl_close($ch);
        return $output;
    }

    
}