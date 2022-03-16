Cara menjalankan:
<ol>
    <li>Buat database</li>
    <li>Buat .env file, dan atur database environtment berdasarkan database yang Anda punya</li>
    <li>Jalankan perintah <code>php artisan migrate</code> untuk membuat table</li>
    <li>Jalankan perintah <code>php artisan serve --port=8000</code> untuk menjalankan server. Harap perhatikan port, karena port disini akan digunakan untuk aplikasi consume api</li>
</ol>

Enpoint yang ada:
<ol>
    <li><code>/api/register</code> <b>Method: POST</b> Untuk register akun</li>
    <li><code>/api/login</code> <b>Method: POST</b> Untuk login</li>
    <li><code>/api/logout</code> <b>Method: POST</b> Untuk logout</li>
    <li><code>/api/blog</code> <b>Method: GET</b> Untuk menampilkan daftar blog yang ada</li>
    <li><code>/api/blog</code> <b>Method: POST</b> Untuk membuat daftar blog baru</li>
    <li><code>/api/blog/{id}</code> <b>Method: GET</b> Untuk menampilkan blog yang berdasarkan id</li>
    <li><code>/api/blog/{id}</code> <b>Method: PUT</b> Untuk mengupdate blog yang berdasarkan id</li>
    <li><code>/api/blog/{id}</code> <b>Method: DELETE</b> Untuk menghapus blog yang berdasarkan id</li>
</ol>

Untuk dokumentasi lengkap dapat dengan import IBID.postman_collection.json ke dalam postman
