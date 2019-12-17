<?

use ApiClub\AmoCRM\request\options\Account as ROAccount;

include_once "../vendor/autoload.php";

$domain  = '';
$token  = '';

include_once "test_access.php";


$amo = new \ApiClub\AmoCRM($domain,$token);
//$amo->access_token($client_id,$client_secret,$code,$redirect_url);

$account_options = new ROAccount();
$account_options->users = true;
$account_options->free_users = true;
$amo->account($account_options);
