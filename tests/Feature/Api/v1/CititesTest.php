<?php

namespace Tests\Feature\Api\v1;

use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CititesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function get_all_cities()
    {
        $this->withoutExceptionHandling();
//dd( array_rand(\App\Models\Merchant::MERCHANT_TYPES),(\App\Models\Merchant::MERCHANT_TYPES)[array_rand(\App\Models\Merchant::MERCHANT_TYPES)]);
    }
}
