<?php

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('does not create a Author without a name field', function () {
    $response = $this->postJson('/api/v1/authors', []);
    $response->assertStatus(422);
});

it('can create a Author', function () {
    $attributes = Author::factory()->raw();
    $response = $this->postJson('/api/v1/authors', $attributes);
    $response->assertStatus(201)->assertJson(['message' => 'Author has been created']);
    $this->assertDatabaseHas('todos', $attributes);
});

it('can fetch a Author', function () {
    $author = Author::factory()->create();

    $response = $this->getJson("/api/v1/authors/{$author->id}");

    $data = [
        'message' => 'Retrieved Author',
        'todo' => [
            'id' => $author->id,
            'name' => $author->name,
            'surname' => $author->surname,
        ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

// it('can update a Author', function () {
//     $todo = Author::factory()->create();
//     $updatedTodo = ['name' => 'Updated Author'];
//     $response = $this->putJson("/api/v1/authors/{$todo->id}", $updatedTodo);
//     $response->assertStatus(200)->assertJson(['message' => 'Author has been updated']);
//     $this->assertDatabaseHas('todos', $updatedTodo);
// });

// it('can delete a Author', function () {
//     $todo = Author::factory()->create();
//     $response = $this->deleteJson("/api/v1/authors/{$todo->id}");
//     $response->assertStatus(200)->assertJson(['message' => 'Author has been deleted']);
//     $this->assertCount(0, Author::all());
// });
