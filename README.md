# php-amocrm
Статус: в разработке

## Запросы
<a name="account"></a>
account( [ApiCLUB\request\options\Account](#request_options_account) $options )  
Возвращает информацию об аккаунте


## Настройки
<a name="request_options_account"></a>
### ApiCLUB\request\options\Account
Настройки для запроса [account()](#account)

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
