<?php

// tests/Feature/UserLoginTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        // Létrehozunk egy felhasználót az adatbázisban
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => bcrypt('password'),
        ]);

        // Bejelentkezési kísérlet helyes adatokkal
        $response = $this->post('/login', [
            'email' => 'teszt@example.com',
            'password' => 'password',
        ]);

        // Ellenőrizzük, hogy sikeres a bejelentkezés és átirányít a főoldalra
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => bcrypt('password'),
        ]);

        // Hibás jelszóval próbál bejelentkezni
        $response = $this->post('/login', [
            'email' => 'teszt@example.com',
            'password' => 'wrongpassword',
        ]);

        // Ellenőrizzük, hogy nem sikerült a bejelentkezés
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_nonexistent_email()
    {
        // Nem létező email-címmel próbálkozunk
        $response = $this->post('/login', [
            'email' => 'nemletezo@example.com',
            'password' => 'password',
        ]);

        // Ellenőrizzük, hogy nem sikerült a bejelentkezés
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

