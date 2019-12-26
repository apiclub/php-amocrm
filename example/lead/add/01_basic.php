<?

use ApiClub\AmoCRM;
use ApiClub\AmoCRM\request\options\Lead as ROLead;

// Путь к composer autoload
include_once "../../../vendor/autoload.php";

// Домен и токен для подключения к AmoCRM
$domain = '';
$token  = '';

$amo = new AmoCRM($domain,$token);
$lead_options = new ROLead('Название лида');
$res = $amo->addLeads($lead_options); // [0]=>id созданного лида

echo '<pre>';
var_dump($res);
echo '</pre>';
