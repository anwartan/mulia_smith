<?php

namespace App\Services\Contract;

interface GoldService
{
    public function getGolds();

    public function fetchGoldPrice();
}
