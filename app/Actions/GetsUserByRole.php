<?php

namespace App\Actions;

use Illuminate\Support\Collection;

interface GetsUserByRole
{
    public function __invoke($roleDescription):Collection;
}