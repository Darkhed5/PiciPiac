<?php

// tests/Feature/ProductCreationTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_product()
    {
        // Létrehozunk egy felhasználót és bejelentkeztetjük
        $user = User::factory()->create();

        $this->actingAs($user);

        // Termék hozzáadás kísérlete
        $response = $this->post('/products', [
            'name' => 'Friss Alma',
            'description' => 'Finom és ropogós alma.',
            'price' => 500,
            'quantity' => 10,
        ]);

        // Ellenőrizzük, hogy a termék bekerült az adatbázisba
        $this->assertDatabaseHas('products', [
            'name' => 'Friss Alma',
            'description' => 'Finom és ropogós alma.',
            'price' => 500,
            'quantity' => 10,
        ]);

        // Ellenőrizzük, hogy átirányított a terméklistára
        $response->assertRedirect('/products');
    }

    /** @test */
    public function guest_cannot_create_product()
    {
        // Bejelentkezés nélküli termék hozzáadás
        $response = $this->post('/products', [
            'name' => 'Friss Körte',
            'description' => 'Édes körte.',
            'price' => 400,
            'quantity' => 5,
        ]);

        // Ellenőrizzük, hogy átirányított a bejelentkező oldalra
        $response->assertRedirect('/login');

        // Ellenőrizzük, hogy a termék nem került az adatbázisba
        $this->assertDatabaseMissing('products', [
            'name' => 'Friss Körte',
        ]);
    }

    /** @test */
    public function product_creation_fails_with_missing_fields()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Hiányzó kötelező mező (nincs név megadva)
        $response = $this->post('/products', [
            'description' => 'Valami leírás.',
            'price' => 300,
            'quantity' => 2,
        ]);

        // Ellenőrizzük, hogy hibát kapunk a név mezőre
        $response->assertSessionHasErrors('name');

        // Ellenőrizzük, hogy a termék nem került az adatbázisba
        $this->assertDatabaseMissing('products', [
            'description' => 'Valami leírás.',
        ]);
    }
}
