<?

include_once "../vendor/autoload.php";

$domain  = '';
$token  = '';

include_once "test_access.php";

$amo = new \ApiClub\AmoCRM($domain,$token);
$amo->auth();
