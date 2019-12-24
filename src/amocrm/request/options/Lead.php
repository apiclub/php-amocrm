<?

namespace ApiClub\AmoCRM\request\options;


/**
 * Class Lead
 * @package ApiClub\AmoCRM
 */
class Lead {
    /** @var string  */
    var $name = '';
    /** @var int  */
    var $created_at = 0;
    /** @var int  */
    var $updated_at = 0;
    /** @var int  */
    var $status_id = 0;
    /** @var int  */
    var $pipeline_id = 0;
    /** @var int  */
    var $responsible_user_id = 0;
    /** @var int  */
    var $sale = 0;
    /** @var array  */
    var $tags = [];
    /** @var array  */
    var $contacts_id = null;
    /** @var int  */
    var $company_id = 0;
    /** @var array  */
    var $custom_fields = [];
    /** @var array  */
    var $catalog_elements_id = [];

    public function __construct(string $name = '',int $updated_at = null) {
        $this->name       = $name;
        if($updated_at) {
            $this->updated_at = $updated_at;
        }
    }

    public function prepare(){
        $res = [];
        if($c = trim($this->name))                     $res['name'] = $c;
        if($c = intval($this->created_at))             $res['created_at'] = $c;
        if($c = intval($this->updated_at))             $res['updated_at'] = $c;
        if($c = intval($this->status_id))              $res['status_id'] = $c;
        if($c = intval($this->pipeline_id))            $res['pipeline_id'] = $c;
        if($c = intval($this->responsible_user_id))    $res['responsible_user_id'] = $c;
        if($c = intval($this->sale))                   $res['sale'] = $c;
        if($c = count($this->tags))                    $res['tags'] = implode(",", $c);
        if($c = count($this->contacts_id))             $res['contacts_id'] = $c;
        if($c = intval($this->company_id))             $res['company_id'] = $c;
        if($c = count($this->custom_fields))           $res['custom_fields'] = $c;

        return $res;
    }
}
