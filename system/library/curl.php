<?php
class Contabilium {
    private $logger;
    private static $instance;
    private $lastError = null;
    private $lastResult = null;
   
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
    protected function __construct($registry) {
    // load the "Log" library from the "Registry"
    $this->logger = $registry->get('log');
    }

    /**
     * @param  string  $url     Url
     * @param  string  $token  Token 
     */   
    public function get($url, $token)
    {
        $ch = curl_init();

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
    public function post($url, $params, $token, $isAuthRequest = false, $debug = false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, $debug);
        curl_setopt($ch, CURLINFO_HEADER_OUT, $debug);

        if (!$isAuthRequest) {
            $token = $this->getTheToken();

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