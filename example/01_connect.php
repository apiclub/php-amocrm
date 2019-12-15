<?

include_once "../vendor/autoload.php";
$domain  = 'julliflo';
$account = 'julli.flo@yandex.ru';
$token   = '5d1ebdb131b08a44cdfc7f5a63f860fe1d9c182d';



$amo = new \ApiClub\AmoCRM($domain,$account,$token);
