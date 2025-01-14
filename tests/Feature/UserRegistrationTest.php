<?php

// tests/Feature/UserRegistrationTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_register_successfully()
        {
        $response = $this->post('/register', [
            'name' => 'Teszt Elek',
            'email' => 'teszt@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Ellenőrizzük, hogy a felhasználó bekerült az adatbázisba
        $this->assertDatabaseHas('users', [
            'email' => 'teszt@example.com',
        ]);

        // Ellenőrizzük, hogy átirányított a főoldalra
        $response->assertRedirect('/home');
    }
}
