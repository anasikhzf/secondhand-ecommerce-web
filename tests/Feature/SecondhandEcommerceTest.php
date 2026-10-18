<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecondhandEcommerceTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SecondStore');
    }

    public function test_catalog_page_shows_products(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Katalog Barang Bekas');
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::first();
        if ($product) {
            $response = $this->get('/products/' . $product->slug);
            $response->assertStatus(200);
            $response->assertSee($product->name);
            $response->assertSee('Transparansi Catatan Minus');
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_cart_and_checkout_flow(): void
    {
        $product = Product::where('status', 'available')->first();
        $this->assertNotNull($product);

        // Add to cart
        $response = $this->post('/cart/add', ['id' => $product->id]);
        $response->assertRedirect('/cart');

        // Check cart page
        $cartPage = $this->get('/cart');
        $cartPage->assertStatus(200);
        $cartPage->assertSee($product->name);

        // Checkout process
        $checkoutResponse = $this->post('/checkout', [
            'customer_name' => 'Budi Tester',
            'customer_phone' => '081234567890',
            'customer_address' => 'Jl. Kebon Jeruk No 12, Jakarta',
            'customer_note' => 'Packing rapi ya',
        ]);

        $checkoutResponse->assertRedirect();
    }

    public function test_admin_auth_and_dashboard(): void
    {
        $user = User::first();
        $this->assertNotNull($user);

        // Access dashboard without auth should redirect
        $this->get('/admin')->assertRedirect(route('login'));

        // Login as admin
        $loginResponse = $this->post('/admin/login', [
            'username' => 'admin',
            'password' => '12345',
        ]);
        $loginResponse->assertRedirect('/admin');

        // Authenticated dashboard
        $this->actingAs($user)->get('/admin')->assertStatus(200)->assertSee('Dashboard');
    }
}
