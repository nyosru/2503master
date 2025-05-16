<?php

namespace Tests\Feature\Livewire\Leed\Action;

use App\Livewire\Leed\Action\GetButton;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GetButtonTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(GetButton::class)
            ->assertStatus(200);
    }
}
