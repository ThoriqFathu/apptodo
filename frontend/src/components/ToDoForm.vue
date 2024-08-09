<template>
	<!-- <div class="content-wrapper"> -->
	<div class="container">
		<!-- <h1>HHHHHHH</h1> -->
		<div class="p-4" style="margin: auto">
			<!-- Logo -->
			<div class="text-center" style="margin-top: -40px">
				<img src="logo.png" alt="Logo" style="height: 200px" />
			</div>

			<!-- Form Inputs -->
			<div class="row mb-3" style="margin-top: -50px">
				<div class="col-md-4">
					<label for="name" style="font-weight: normal"
						>Nama</label
					>
					<input
						v-model="formData.name"
						type="text"
						id="name"
						class="form-control"
						placeholder="Nama"
					/>
				</div>
				<div class="col-md-4">
					<label for="username" style="font-weight: normal"
						>Username</label
					>
					<input
						v-model="formData.username"
						type="text"
						id="username"
						class="form-control"
						placeholder="Username"
					/>
				</div>
				<div class="col-md-4">
					<label for="email" style="font-weight: normal"
						>Email</label
					>
					<input
						v-model="formData.email"
						type="email"
						id="email"
						class="form-control"
						placeholder="Email"
					/>
				</div>
			</div>

			<!-- To Do List -->
			<div>
				<div class="row" style="margin-top: 50px">
					<div class="col-md-8"><h4>To Do List</h4></div>
					<div class="col-md-4 text-right">
						<button
							type="button"
							class="btn btn-light custom-button mb-3"
							@click="addTodo"
						>
							<i class="fas fa-plus"></i> Tambah To Do
						</button>
					</div>
				</div>

				<div v-for="(todo, index) in todos" :key="index">
					<div class="row">
						<div class="col-md-8">
							<label
								class="form-label"
								for="judul"
								style="font-weight: normal"
								>Judul To Do
							</label>
						</div>
						<div class="col-md-3">
							<label
								class="form-label"
								for="kategori"
								style="font-weight: normal"
								>Kategori
							</label>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-8">
							<input
								id="judul"
								type="text"
								class="form-control"
								v-model="todo.title"
								placeholder="Contoh : Perbaikan api master"
							/>
						</div>
						<div class="col-md-3">
							<select
								v-model="todo.category"
								class="form-control"
							>
								<option
									v-for="category in categories"
									:key="category.id"
									:value="category.id"
								>
									{{ category.name }}
								</option>
							</select>
						</div>
						<div class="col-md-1 text-right">
							<button
								type="button"
								class="btn btn-danger"
								@click="confirmDelete(index)"
							>
								<i class="fas fa-trash"></i>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Submit Button -->
			<button
				@click="saveTodo()"
				type="button"
				class="btn btn-success save-button"
			>
				SIMPAN
			</button>
		</div>
	</div>
	<!-- </div> -->
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
	data() {
		return {
			formData: {
				name: "",
				username: "",
				email: "",
			},
			todos: [{ title: "", category: 1 }],
			categories: [],
			errors: {},
		};
	},
	created() {
		this.fetchCategories();
	},
	methods: {
		async saveTodo() {
			// Mengumpulkan data dari form dan todos
			const dataToSave = {
				formData: this.formData,
				todos: this.todos,
			};

			// Tampilkan data di konsol
			// console.log("Data yang akan disimpan:", dataToSave);
			try {
				const response = await axios.post(
					"http://127.0.0.1:8000/api/save",
					dataToSave
				);
				console.log("Respons dari server:", response.data);
				Swal.fire({
					title: "Berhasil!",
					text: "To Do berhasil disimpan..",
					icon: "success",
					confirmButtonText: "Selesai",
					confirmButtonColor: "#28a745",
				});
			} catch (error) {
				// Tangani error
				if (error.response && error.response.status === 422) {
					// Menyimpan pesan error dari server
					this.errors = error.response.data.errors;
					console.log(error.response.data.errors);
					Swal.fire(
						"Gagal menyimpan!",
						"Pastikan isi semua form input.",
						"error"
					);
				} else {
					// Tangani error lainnya
					Swal.fire(
						"Terjadi kesalahan!",
						"Silakan coba lagi nanti.",
						"error"
					);
				}
			}
		},
		addTodo() {
			this.todos.push({ title: "", category: 1 });
			// console.log(this.todos);
		},
		async confirmDelete(index) {
			// Menampilkan SweetAlert2 dengan opsi konfirmasi
			const result = await Swal.fire({
				title: "Apakah Anda yakin?",
				text: "To do yang dihapus tidak dapat dikembalikan",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Hapus",
				cancelButtonText: "Batal",
				customClass: {
					confirmButton: "custom-confirm-button",
					cancelButton: "custom-cancel-button",
				},
			});

			// Mengecek hasil konfirmasi
			if (result.isConfirmed) {
				this.removeTodo(index);
				Swal.fire({
					title: "Berhasil!",
					text: "To Do berhasil dihapus..",
					icon: "success",
					confirmButtonText: "Selesai",
					confirmButtonColor: "#28a745",
				});
			}
		},
		removeTodo(index) {
			this.todos.splice(index, 1);
		},
		async fetchCategories() {
			try {
				const response = await axios.get(
					"http://127.0.0.1:8000/api/kategori"
				);
				this.categories = response.data.data;
			} catch (error) {
				console.error(
					"There was an error fetching the categories!",
					error
				);
			}
		},
	},
};
</script>

<style>
.custom-button {
	background-color: #ffcccc;
	border-color: #ffcccc;
	color: #e60000;
}
.custom-button:hover {
	background-color: #ff9999;
}
.save-button {
	width: 100%;
	background-color: #28a745;
	color: #fff;
}

.custom-confirm-button {
	border: none !important; /* Menghilangkan border tombol konfirmasi */
	box-shadow: none !important; /* Menghilangkan bayangan tombol jika ada */
	background-color: #e8677e !important; /* Warna latar belakang tombol konfirmasi */
	color: #fff !important; /* Warna teks tombol konfirmasi */
}

.custom-cancel-button {
	border: none !important; /* Menghilangkan border tombol batal */
	box-shadow: none !important; /* Menghilangkan bayangan tombol jika ada */
	background-color: rgb(
		227,
		227,
		227
	) !important; /* Warna latar belakang tombol batal */
	color: #6f6c6c !important; /* Warna teks tombol batal */
}
</style>
