<?php

namespace App\Helpers;

use \Makeable\EloquentStatus\Status;

class RegistrationStatus extends Status {

    public function newAdded($query)
    {
        return $query->where('new', 1);
    }
}