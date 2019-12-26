# php-amocrm
Статус: в разработке

# Навигация
## Стандартные запросы
### Аккаунт
- [account](#account)

### Лиды
- [addLeads](#add_leads) - добавляет лидов
- [updateLeads](#update_leads) - обновляет лиды

## Настройки
- [ApiClub\AmoCRM\request\options\Lead](#request_options_lead) - Основной класс настроек для запросов связанных с лидами
- [ApiClub\AmoCRM\request\options\AddLead](#request_options_add_lead) - Класс для быстрого создания настроек для добавления лидов
- [ApiClub\AmoCRM\request\options\UpdateLead](#request_options_update_lead)  - Класс для быстрого создания настроек для обновления лидов

## Стандартные запросы
### Аккаунт
- <a name="account"></a>
account( [ApiCLUB\AmoCRM\request\options\Account](#request_options_account) $options )    
Возвращает информацию об аккаунте  

### Лиды
<a name="add_leads"></a>
#### addLeads
addLeads([ApiClub\AmoCRM\request\options\Lead[]](#request_options_lead) | [ApiClub\AmoCRM\request\options\Lead](#request_options_lead) $leads):array  
Функция, которая добавляет лиды и возвращает ассоциативный массив с id добавленных лидов.

#### Базовый пример
[Исходный код](example/lead/add/01_basic.php)
```php
<?

use ApiClub\AmoCRM;
use ApiClub\AmoCRM\request\options\Lead as ROLead;

// Путь к composer autoload
include_once "vendor/autoload.php";

// Домен и токен для подключения к AmoCRM
$domain = '';
$token  = '';

$amo = new AmoCRM($domain,$token);
$lead_options = new ROLead('Название лида');
$res = $amo->addLeads($lead_options); // [0]=>id созданного лида

```

<a name="update_leads"></a>
#### updateLeads
updateLeads([ApiClub\AmoCRM\request\options\Lead[]](#request_options_lead) | [ApiClub\AmoCRM\request\options\Lead](#request_options_lead) $leads):array


## Настройки
<a name="request_options_account"></a>
### ApiCLUB\AmoCRM\request\options\Account
Настройки для запроса:
- [account()](#account)

bool **$custom_fields** = false;    
Вернёт информацию по всем дополнительным полям в аккаунте    

bool **$users** = false;  
Вернёт информацию по всем пользователям в аккаунте  

bool **$pipelines** = false;  
Вернёт информацию по всем цифровым воронкам в аккаунте  

bool **$groups** = false;  
Вернёт информацию по всем группам пользователей в аккаунте  

bool **$note_types** = false;  
Вернёт информацию по всем типам дополнительных полей в аккаунте

bool **$task_types** = false;  
Вернёт информацию по всем типам задач в аккаунте  

bool **$free_users** = false;  
Вернёт информацию в том числе и по бесплатным пользователям  


<a name="request_options_lead"></a>
### ApiCLUB\AmoCRM\request\options\Lead
Настройки для запросов: 
- [addLeads()](#add_leads)
- [updateLeads()](#update_leads)


<a name="request_options_add_lead"></a>
### ApiCLUB\AmoCRM\request\options\AddLead

<a name="request_options_update_lead"></a>
### ApiCLUB\AmoCRM\request\options\UpdateLead
