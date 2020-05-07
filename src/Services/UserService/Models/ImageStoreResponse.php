<?php

namespace Ilma\Ecosystem\Services\UserService\Models;

use stdClass;

class ImageStoreResponse
{
    public $result;
    public $id;
    public $image;
    public $reason;

    public function unSerialize(stdClass $obj): ImageStoreResponse
    {
        $this->result = $obj->result;
        $this->id = $obj->id;
        $this->image = $obj->image;
        $this->reason = $obj->reason;
        return $this;
    }
}