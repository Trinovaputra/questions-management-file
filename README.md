<h1>README - Sistem Manajemen Materi Pembelajaran</h1>

<h2>1. Deskripsi Project</h2>
<p>
Project ini merupakan sistem manajemen materi pembelajaran berbasis Laravel.
Sistem memiliki dua role utama:
</p>

<ul>
  <li><strong>Admin</strong>: mengelola materi (CRUD)</li>
  <li><strong>Siswa</strong>: mengakses dan membaca materi</li>
</ul>

<p>Materi mendukung beberapa tipe:</p>
<ul>
  <li>PDF</li>
  <li>Gambar (Image)</li>
  <li>YouTube (embed link)</li>
</ul>

<hr>

<h2>2. Tech Stack</h2>
<ul>
  <li>Laravel 10+</li>
  <li>PHP 8.1+</li>
  <li>MySQL / MariaDB</li>
  <li>Laravel Sanctum (Authentication API)</li>
  <li>Bootstrap 5 (Frontend)</li>
  <li>JavaScript (Fetch API)</li>
</ul>

<hr>

<h2>3. Instalasi Project</h2>

<h3>3.1 Clone Repository</h3>
<pre><code>git clone https://github.com/username/nama-project.git
cd nama-project</code></pre>

<h3>3.2 Install Dependency</h3>
<pre><code>composer install
npm install</code></pre>

<h3>3.3 Copy Environment File</h3>
<pre><code>cp .env.example .env</code></pre>

<h3>3.4 Generate Application Key</h3>
<pre><code>php artisan key:generate</code></pre>

<hr>

<h2>4. Konfigurasi Database (.env)</h2>

<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<hr>

<h2>5. Migrasi Database</h2>
<pre><code>php artisan migrate</code></pre>

<hr>

<h2>6. Seeder (Data Awal)</h2>

<p>Jalankan seeder:</p>
<pre><code>php artisan db:seed</code></pre>

<p>Atau reset database sekaligus:</p>
<pre><code>php artisan migrate:fresh --seed</code></pre>

<hr>

<h2>7. Storage Link</h2>
<pre><code>php artisan storage:link</code></pre>

<p>
Digunakan agar file PDF, gambar, dan materi dapat diakses dari browser.
</p>

<hr>

<h2>8. Menjalankan Project</h2>

<h3>Jalankan Laravel</h3>
<pre><code>php artisan serve</code></pre>

<p>URL default:</p>
<pre><code>http://127.0.0.1:8000</code></pre>

<h3>Compile Asset (Opsional)</h3>

<p>Development:</p>
<pre><code>npm run dev</code></pre>

<p>Production:</p>
<pre><code>npm run build</code></pre>

<hr>

<h2>9. Fitur Utama</h2>

<h3>Admin</h3>
<ul>
  <li>Login admin</li>
  <li>Dashboard admin</li>
  <li>CRUD materi</li>
  <li>Upload file PDF / Image</li>
  <li>Embed YouTube</li>
  <li>Edit & delete materi</li>
</ul>

<h3>Siswa</h3>
<ul>
  <li>Login siswa</li>
  <li>Dashboard materi</li>
  <li>List materi</li>
  <li>Detail materi</li>
  <li>Preview PDF, image, dan YouTube embed</li>
</ul>

<hr>

<h2>10. Struktur Route</h2>

<h3>Web Routes</h3>
<ul>
  <li>/admin/dashboard</li>
  <li>/admin/materi</li>
  <li>/admin/materi/create</li>
  <li>/admin/materi/{id}</li>
  <li>/admin/materi/{id}/edit</li>
</ul>

<h3>API Routes</h3>
<ul>
  <li>GET /api/materi</li>
  <li>POST /api/materi</li>
  <li>PUT /api/materi/{id}</li>
  <li>DELETE /api/materi/{id}</li>
</ul>

<hr>

<h2>11. Struktur Database</h2>

<h3>tabel: materi</h3>
<ul>
  <li>id</li>
  <li>title</li>
  <li>description</li>
  <li>type (pdf/image/youtube)</li>
  <li>file_path</li>
  <li>youtube_url</li>
  <li>created_by</li>
  <li>timestamps</li>
</ul>

<hr>

<h2>12. Authentication</h2>
<ul>
  <li>Laravel Sanctum digunakan untuk autentikasi API</li>
  <li>Admin menggunakan middleware <code>admin</code></li>
  <li>User hanya dapat akses materi</li>
</ul>

<hr>

<h2>13. Catatan Penting</h2>
<ul>
  <li>Jalankan <code>php artisan storage:link</code></li>
  <li>Pastikan folder storage dapat diakses</li>
  <li>File upload dibatasi PDF/JPG/PNG</li>
  <li>YouTube harus link valid</li>
</ul>

<hr>

<h2>14. Troubleshooting</h2>

<h3>404 halaman admin</h3>
<ul>
  <li>Cek route web.php</li>
  <li>Cek middleware admin</li>
</ul>

<h3>File tidak tampil</h3>
<pre><code>php artisan storage:link</code></pre>

<h3>API error upload</h3>
<ul>
  <li>Pastikan CSRF token benar</li>
  <li>Header Accept: application/json</li>
</ul>
