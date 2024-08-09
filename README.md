# Todo List Application

Aplikasi Todo List dengan Vue.js (frontend) dan Laravel (backend).

## Prasyarat

Sebelum memulai, pastikan Anda sudah menginstal perangkat lunak berikut:

-    [Node.js](https://nodejs.org/) (versi LTS terbaru) - untuk frontend
-    [npm](https://www.npmjs.com/) atau [yarn](https://yarnpkg.com/) - untuk manajemen paket frontend
-    [PHP](https://www.php.net/) (versi 7.4 atau lebih tinggi) - untuk backend
-    [Composer](https://getcomposer.org/) - untuk manajemen paket PHP
-    [PostgresSQL](https://www.postgresql.org/) atau database lain yang Anda gunakan

## Instalasi

-    **Clone Repository:**

     ```bash
     git clone https://github.com/ThoriqFathu/apptodo.git
     ```

### Backend (Laravel)

-    **Set up backend:**

     ```bash
     cd apptodo
     cd backend
     composer install
     # konfigurasi file .env (set Database)
     cp .env.example .env
     #----------------------
     php artisan migrate
     php artisan key:generate
     ```

### Frontend (Vue)

-    **Set up forntend:**

     ```bash
     cd apptodo
     cd forntend
     npm install
     npm install axios

     ```

## Running App

1. **Menjalankan server Laravel (backend):**

     ```bash
     php artisan serve

     ```

2. **Menjalankan server Vue (frontend):**

     ```bash
     npm run serve

     ```

## Testing App

-    **Menjalankan testing di backend:**

     ```bash
     php artisan test

     ```

## Link Postman Dokumentasi API

-    [DOK API](https://documenter.getpostman.com/view/37247580/2sA3s1pYFJ)
