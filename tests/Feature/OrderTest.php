<?php

test('can place an order', function () {
    $user = \App\Models\User::factory()->create();

    $this->actingAs($user);

    $product = \App\Models\Product::factory()->create([
        'price' => 100,
    ]);

    $response = $this->postJson('/api/orders', [
        'products' => [
            ['id' => $product->id, 'quantity' => 2],
        ],
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'total' => 200,
        ]);
});

test('cant place an order with invalid product', function () {
    $user = \App\Models\User::factory()->create();

    $this->actingAs($user);

    $response = $this->postJson('/api/orders', [
        'products' => [
            ['id' => 83752875, 'quantity' => 2],
        ],
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors('products.0.id');
});

test('can place an order with multiple products', function () {
    $user = \App\Models\User::factory()->create();

    $this->actingAs($user);

    $product = \App\Models\Product::factory()->create([
        'price' => 100,
    ]);

    $product2 = \App\Models\Product::factory()->create([
        'price' => 100,
    ]);

    $response = $this->postJson('/api/orders', [
        'products' => [
            ['id' => $product->id, 'quantity' => 2],
            ['id' => $product2->id, 'quantity' => 1],
        ],
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'total' => 300,
        ]);
});
