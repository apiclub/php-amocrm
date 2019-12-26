<?
namespace ApiClub\AmoCRM\request\options;

class AddLead extends Lead {
    public function __construct(string $name) {
        parent::__construct($name);
    }
}

