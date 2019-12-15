<?
namespace ApiClub;

use ApiClub\AmoCRM\exceptions\AmoCRM as Exceptions;

class AmoCRM {
    /** @var string токен, который нужно получить в личном кабинете пользователя */
    var $token = '';
    /** @var string поддомен пользователя */
    var $domain = '';
    /** @var string аккаунт пользователя, от имени которого подлюкчаемся */
    var $account = '';

    /**
     * AmoCRM constructor.
     * @param string $domain - домен пользователя
     * @param string $account - аккаунт от имени которого подключаемся
     * @param string $token - токен аккаунта для работы с api
     * @throws Exceptions
     */
    public function __construct(string $domain,string $account,string $token) {
        $domain        = trim($domain);
        $account       = trim($account);
        $token         = trim($token);

        if(!$domain)  throw new Exceptions(Exceptions::EMPTY_DOMAIN);
        if(!$account) throw new Exceptions(Exceptions::EMPTY_ACCOUNT);
        if(!$token)   throw new Exceptions(Exceptions::EMPTY_TOKEN);

        $this->domain  = $domain;
        $this->account = $account;
        $this->token   = $token;
    }

}
