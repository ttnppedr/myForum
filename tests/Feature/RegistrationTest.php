<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\User;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function confirming_an_invalid_token()
    {
        $response = $this->get(route('register.confirm', ['token' => 'invalid']))
            ->assertRedirect(route('threads'))
            ->assertSessionHas('flash', 'Unknow token.');
    }
}
