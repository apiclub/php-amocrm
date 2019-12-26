<?

namespace ApiClub\AmoCRM\request\options;

class UpdateLead extends Lead {
    public function __construct(int $id, string $name , int $status_id = 0, int $updated_at = null) {
        parent::__construct($name, $status_id, $updated_at);
        $this->id = $id;
    }
}
