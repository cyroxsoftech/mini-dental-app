<?php

namespace App\Concerns;

use App\Models\Dentist;
use App\Models\User;
use App\Models\Central\User as CentralUser;

trait HasRole{

    public function isDentist(){
        return get_class($this) === Dentist::class;
    }

    public function isUser(){
        return get_class($this) === User::class;
    }

    public function isCentralUser(){
        return get_class($this) === CentralUser::class;
    }
}