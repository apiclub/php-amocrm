<?

use ApiClub\AmoCRM\request\options\Account as ROAccount;

include_once "../vendor/autoload.php";

$domain  = '';
$token  = '';

include_once "test_access.php";

$amo = new \ApiClub\AmoCRM($domain,$token);
//$amo->refreshToken($client_id,$client_secret,$refresh_token,$redirect_url);
//$amo->accessToken($client_id,$client_secret,$code,$redirect_url);
/*
$account_options = new ROAccount();
$account_options->users = true;
$account_options->free_users = true;
$amo->account($account_options);
/**/

//*
$x = new \ApiClub\AmoCRM\request\options\Lead('Дарова');
$y = new \ApiClub\AmoCRM\request\options\Lead('Дарова 3');
$amo->addLeads($x);
$x->name = 'Дарова 2';

$r = $amo->addLeads(['a'=>$x,'b'=>null,$y]);
echo '<pre>';
echo var_dump($r);
echo '</pre>';

/**/

