<?
namespace ApiClub;

use ApiClub\AmoCRM\exceptions\AmoCRM           as Exceptions;
use ApiClub\AmoCRM\request\options\Account     as RequestOptionsAccount;
use ApiClub\AmoCRM\request\options\Lead        as RequestOptionsLead;
use ApiClub\AmoCRM\request\options\AddLead     as RequestOptionsAddLead;
use ApiClub\AmoCRM\request\options\UpdateLead  as RequestOptionsUpdateLead;

/**
 * Class AmoCRM
 * @package ApiClub
 */
class AmoCRM {

    const OPTIONS_LEAD        = 'ApiClub\AmoCRM\request\options\Lead';
    const OPTIONS_ADD_LEAD    = 'ApiClub\AmoCRM\request\options\AddLead';
    const OPTIONS_UPDATE_LEAD = 'ApiClub\AmoCRM\request\options\UpdateLead';

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


    function account(RequestOptionsAccount $options = null){
        $data = [];
        if($options) {
            if ($options->custom_fields)  $data['with'][]     = 'custom_fields';
            if ($options->users)          $data['with'][]     = 'users';
            if ($options->pipelines)      $data['with'][]     = 'pipelines';
            if ($options->groups)         $data['with'][]     = 'groups';
            if ($options->note_types)     $data['with'][]     = 'note_types';
            if ($options->task_types)     $data['with'][]     = 'task_types';
            if ($data['with'])            $data['with']       = implode(",", $data['with']);
            if ($options->free_users)     $data['free_users'] = 'Y';
        }
        return $this->request('api/v2/account',$data);
    }

    function refreshToken(string $client_id,string $client_secret,string $refresh_token,string $redirect_url){
        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token,
            'redirect_uri'  => $redirect_url,
        ];
        return $this->request('oauth2/access_token',$data,'POST');
    }

    function accessToken(string $client_id,string $client_secret,string $code,string $redirect_url){
        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => $redirect_url,
        ];
        return $this->request('oauth2/access_token',$data,'POST');
    }


    /**
     * Функция для генерации ссылки api для поддомена пользователя
     * @param string $link
     * @return string
     */
    protected function link($link = ''){
        return 'https://'.$this->domain.'.amocrm.ru/'.$link;
    }


    /**
     * Функция добавления новых лидов
     * @param RequestOptionsLead[] | RequestOptionsLead $leads
     * @return array ассоциативный массив id добавленных сущностей
     */
    public function addLeads($leads):array {
        if(!is_array($leads)) $leads = [$leads];
        $data = [];
        $keys = [];
        $res  = [];
        /** @var RequestOptionsLead $lead */
        foreach ($leads as $k=>$lead){
            if(in_array(get_class($lead),[self::OPTIONS_LEAD,self::OPTIONS_ADD_LEAD,self::OPTIONS_UPDATE_LEAD])) {
                if (!$lead->created_at) {
                    $lead->created_at = time();
                }
                if ($lead->id) {
                    $lead->id = null;
                }
                $data[] = $lead->prepare();
                $keys[] = $k;
            }
            $res[$k] = null;
        }
        $r =  $this->request('api/v2/leads',['add'=>$data],'POST');
        foreach ($r['_embedded']['items'] as $k=>$v){
            $res[$keys[$k]] = $v['id'];
        }
        return $res;
    }

    /**
     * Функция обновления существующих лидов
     * @param RequestOptionsLead[] | RequestOptionsLead $leads
     * @return array ассоциативный массив id добавленных сущностей
     */
    public function updateLeads($leads):array {
        if(!is_array($leads)) $leads = [$leads];
        $data = [];
        $keys = [];
        $res  = [];
        /** @var RequestOptionsLead $lead */
        foreach ($leads as $k=>$lead){
            if(in_array(get_class($lead),[self::OPTIONS_LEAD,self::OPTIONS_ADD_LEAD,self::OPTIONS_UPDATE_LEAD])) {
                if (!$lead->updated_at) {
                    $lead->updated_at = time();
                }
                if (!$lead->status_id) {
                    $lead->status_id = 0;
                }
                if (!$lead->id) {
                    $lead->id = $k;
                }
                $data[] = $lead->prepare();
                $keys[] = $k;
            }
            $res[$k] = false;
        }
        $r =  $this->request('api/v2/leads',['update'=>$data],'POST');
        foreach ($r['_embedded']['items'] as $k=>$v){
            $res[$keys[$k]] = true;
        }
        return $res;
    }


    protected function request($link,$data=[],$custom_request="GET"){
        return self::_request($this->domain, $this->token, $this->link($link), $data, $custom_request);
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

        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        if ($custom_request) curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $custom_request);
        switch($custom_request) {
            case "POST": curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); break;
            case "GET" : $link.='?'.http_build_query($data); break;
        }
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');  #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
        //$code = curl_getinfo($curl, CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
        curl_close($curl); #Завершаем сеанс cURL
        $res = json_decode($out,true);

        echo '<pre>';
        echo var_dump($link,$res);
        echo '</pre>';

        return $res;
    }

}
