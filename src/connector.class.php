<?php
class Connector {
    protected $address = 'https://mantis.globalrustrade.com/';
    protected $cookie = [
        'MANTIS_STRING_COOKIE' => 'MANTIS_STRING_COOKIE=',
        'MANTIS_PROJECT_COOKIE' => 'MANTIS_PROJECT_COOKIE=0'
    ];
    protected $cookie_cache;

    public function __construct($cookie)
    {
        $this->cookie['MANTIS_STRING_COOKIE'] = 'MANTIS_STRING_COOKIE=' . $cookie;
    }

    public function post($url = '', $data = [], $header = false)
    {
        $html = $this->init('POST', $url, $data, $header);
        return $html;
    }

    public function get($url = '', $data = [], $header = false)
    {
        $html = $this->init('GET', $url, $data, $header);
        return $html;
    }

    protected function init($method = 'GET', $url = '', $data = [], $header = false)
    {
        if ($method == 'GET' && !empty($data)){
            $url = $url . '?' . http_build_query($data);
        }
        $ch = curl_init($this->address . $url);
        if ($method == 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            if (!empty($data))
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_COOKIE, implode('; ',$this->cookie));
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_cache);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($header)
            curl_setopt($ch, CURLOPT_HEADER, true);
        else
            curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);

        if ($header){
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($html, 0, $header_size);
            return $header;
        }
        curl_close($ch);
        return $html;
    }

    public function addCookie($name, $value)
    {
        $this->cookie[$name] = $value;
    }

    public function __destruct()
    {

    }
}
