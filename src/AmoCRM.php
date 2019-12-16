<?
namespace ApiClub;

use ApiClub\AmoCRM\exceptions\AmoCRM as Exceptions;

class AmoCRM {
    /** @var string токен, который нужно получить в личном кабинете пользователя */
    var $token = '';
    /** @var string поддомен пользователя */
    var $domain = '';

    /**
     * AmoCRM constructor.
     * @param string $domain - домен пользователя
     * @param string $token - токен аккаунта для работы с api
     */
    public function __construct(string $domain='',string $token='') {
        $domain        = trim($domain);
        $token         = trim($token);

        $this->domain  = $domain;
        $this->token   = $token;
    }


    function auth(){
        return $this->request('api/v2/account');
    }

    function access_token($client_id,$client_secret,$code){

        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => 'https://api-club.ru/amo.php',
        ];
        $this->request('oauth2/access_token',$data,'POST');
    }


    protected function link($link = ''){
        return 'https://'.$this->domain.'.amocrm.ru/'.$link;
    }

    protected function request($link,$data=[],$custom_request="GET"){
        return self::_request($this->domain,$this->token,$this->link($link),$data,$custom_request);
    }

    static function _request($domain,$token,$link,$data = [],$custom_request="GET"){
        $headers = [];
        if($token) {
            $headers = ['Authorization: Bearer ' . $token];
        }
        if(!$domain)  trigger_error(Exceptions::EMPTY_DOMAIN, E_USER_NOTICE);

        $curl = curl_init(); #Сохраняем дескриптор сеанса cURL
        #Устанавливаем необходимые опции для сеанса cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        if ($custom_request) curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $custom_request);
        if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);


        $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную


        echo '<pre>';
        echo var_dump($out);
        echo '</pre>';

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
        curl_close($curl); #Завершаем сеанс cURL
        $out = json_decode($out);

        echo '<pre>';
        echo var_dump($out);
        echo '</pre>';

        return $out;

    }

}
