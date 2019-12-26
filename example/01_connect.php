<?
use ApiClub\AmoCRM;
use ApiClub\AmoCRM\request\options\Lead as ROLead;
use ApiClub\AmoCRM\request\options\AddLead as ROAddLead;
use ApiClub\AmoCRM\request\options\UpdateLead as ROUpdateLead;
use ApiClub\AmoCRM\request\options\Account as ROAccount;

include_once "../vendor/autoload.php";

$domain  = '';
$token  = '';

include_once "test_access.php";

$time = date('Y.m.d H:i:s');

$amo = new AmoCRM($domain,$token);
//$amo->refreshToken($client_id,$client_secret,$refresh_token,$redirect_url);
//$amo->accessToken($client_id,$client_secret,$code,$redirect_url);
/*
$account_options = new ROAccount();
$account_options->users = true;
$account_options->free_users = true;
$amo->account($account_options);
/**/

/*
$x = new Lead('Дарова');
$y = new Lead('Дарова 3');
$amo->addLeads($x);
$x->name = 'Дарова 2';

$r = $amo->addLeads(['a'=>$x,'b'=>null,$y]);
echo '<pre>';
echo var_dump($r);
echo '</pre>';

/**/

$x = new ROLead('Hello '.$time);
$y = new ROUpdateLead(1704795,'Hi '.$time);
$r = $amo->updateLeads([1704797=>$x,1=>null,'sex'=>$y]);

echo '<pre>';
echo var_dump($r);
echo '</pre>';
