<?

namespace ApiClub\AmoCRM\request\options;

class Account {
    /** @var bool Вернёт информацию по всем дополнительным полям в аккаунте */
    var $custom_fields = false;
    /** @var bool Вернёт информацию по всем пользователям в аккаунте */
    var $users = false;
    /** @var bool Вернёт информацию по всем цифровым воронкам в аккаунте */
    var $pipelines = false;
    /** @var bool Вернёт информацию по всем группам пользователей в аккаунте */
    var $groups = false;
    /** @var bool Вернёт информацию по всем типам дополнительных полей в аккаунте */
    var $note_types = false;
    /** @var bool Вернёт информацию по всем типам задач в аккаунте */
    var $task_types = false;
    /** @var bool Вернёт информацию в том числе и по бесплатным пользователям */
    var $free_users = false;

    public function __construct(bool $custom_fields = false,
                                bool $users         = false,
                                bool $pipelines     = false,
                                bool $groups        = false,
                                bool $note_types    = false,
                                bool $task_types    = false,
                                bool $free_users    = false) {
        $this->custom_fields = $custom_fields;
        $this->users         = $users;
        $this->pipelines     = $pipelines;
        $this->groups        = $groups;
        $this->note_types    = $note_types;
        $this->task_types    = $task_types;
        $this->free_users    = $free_users;
    }

}
