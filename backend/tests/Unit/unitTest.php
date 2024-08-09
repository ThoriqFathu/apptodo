<?php

namespace Tests\Unit;
use Tests\TestCase; 
use Illuminate\Support\Facades\Validator;
class unitTest extends TestCase
{
    public function test_name_is_required_and_max_255()
    {
        $validator = Validator::make(['formData' => ['name' => '']], [
            'formData.name' => 'required|string|max:255',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.name', $validator->errors()->messages());

        $validator = Validator::make(['formData' => ['name' => str_repeat('a', 256)]], [
            'formData.name' => 'required|string|max:255',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.name', $validator->errors()->messages());
    }

    public function test_username_is_required_unique_and_max_255()
    {
        $validator = Validator::make(['formData' => ['username' => '']], [
            'formData.username' => 'required|string|max:255|unique:users,username',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.username', $validator->errors()->messages());

        $validator = Validator::make(['formData' => ['username' => str_repeat('a', 256)]], [
            'formData.username' => 'required|string|max:255|unique:users,username',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.username', $validator->errors()->messages());
    }

    public function test_email_is_required_valid_and_unique()
    {
        $validator = Validator::make(['formData' => ['email' => '']], [
            'formData.email' => 'required|email|unique:users,email',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.email', $validator->errors()->messages());

        $validator = Validator::make(['formData' => ['email' => 'invalid-email']], [
            'formData.email' => 'required|email|unique:users,email',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('formData.email', $validator->errors()->messages());
    }

  
    public function test_todo_title_is_required_and_max_255()
    {
        $validator = Validator::make(['todos' => [['title' => '']]], [
            'todos.*.title' => 'required|string|max:255',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('todos.0.title', $validator->errors()->messages());

        $validator = Validator::make(['todos' => [['title' => str_repeat('a', 256)]]], [
            'todos.*.title' => 'required|string|max:255',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('todos.0.title', $validator->errors()->messages());
    }

    public function test_todo_category_is_required()
    {
        $validator = Validator::make(['todos' => [['category' => '']]], [
            'todos.*.category' => 'required',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('todos.0.category', $validator->errors()->messages());
    }
    public function test_api_get_kategori()
    {
        $response = $this->get('/api/kategori');

        $response->assertStatus(200);
    }
    public function test_post_json_data()
    {
        $response = $this->postJson('/api/save', [
            'formData' => [
                'name' => 'thoriqq',
                'username' => 'thoriqfathu',
                'email' => 'thoriq@gmail.com',
            ],
            'todos' => [
                [
                    'title' => 'Upload Data',
                    'category' => 2,
                ],
            ],
        ]);

        $response->assertStatus(200);
    }
}
