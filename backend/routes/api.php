<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Models\TasksModel;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('/kategori', function(){
	$categories = KategoriModel::all();
	return response()->json([
		"msg" => "GET CATEGORIES",
		"data" => $categories
	]);
});




Route::post('/save', function (Request $request) {
	// Aturan validasi
	$validatedData = $request->validate([
		'formData.name' => 'required|string|max:255',
		'formData.username' => 'required|string|max:255|unique:users,username',
		'formData.email' => 'required|email|unique:users,email',
		'todos.*.title' => 'required|string|max:255',
		'todos.*.category' => 'required',
	 ], [
		'formData.username.unique' => 'Username sudah terdaftar.',
		'formData.email.unique' => 'Email sudah terdaftar.',
	 ]);
  
	 // Simpan data ke database
	 $user = UserModel::create([
		'name' => $validatedData['formData']['name'],
		'username' => $validatedData['formData']['username'],
		'email' => $validatedData['formData']['email'],
	 ]);
  
	//  // Simpan todos ke database, jika perlu
	 foreach ($validatedData['todos'] as $todo) {
		// Contoh menyimpan todos
		TasksModel::create([
		    'user_id' => $user->id,
		    'category_id' => $todo['category'],
		    'description' => $todo['title'],
		    'created_by' => $user->id,
		]);
	 }
	$data = $request->all();

	return response()->json(['message' => 'Data berhasil disimpan!', 'data' => $data]);
});