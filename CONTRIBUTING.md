# Contribution Guidelines
Agar Aplikasi ini bisa berjalan di komputer agan, butuh beberapa setingan awal menggunakan CLI (Command Line Interface). Yang pertama adalah mengupdate composer untuk mengambil semua dependencies pada aplikasi ini.
Kemudian melakukan setingan database yang dibuat baru di ```app/config/local/database.php```. Hal ini dilakukan untuk menghindari setingan database yang berbeda-beda pada masing-masing localhost komputer agan.
Setelah itu agan bisa melakukan database migration dan seeds untuk menyiapkan database tablenya. Perlu diperhatikan pembuatan database-nya sendiri harus dilakukan manual sesuai dengan setingan di ```app/config/local/database.php```.

#####Composer Update
``` composer update --no-script ```

#####Database
######Settings
- Untuk menghindari konflik antar setingan berbeda, silahkan buat folder baru bernama local di: ```app/config```
- Kemudian buat file baru didalamnya bernama ```database.php```
- Sehingga menjadi ```app/config/local/database.php```
- Copy isi file ```app/config/database.php```
- Kemudian paste di ```app/config/local/database.php```
- Ubah setingan database yang di ```app/config/local/database.php``` sesuai dengan setingan localhost anda.
note: default menggunakan MySQL.
Sebagai contoh, berikut adalah bagian dari ```app/config/local/database.php``` yang saya ubah:

```
			'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'ditemukan',
			'username'  => 'root',
			'password'  => 'root',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
```

sisanya adalah sama dengan yang di ```app/config/database.php```

######Migrations & Seeds
- Setelah melakukan konfigurasi koneksi dan pembuatan database, silahkan lakukan
```php artisan migrate:install```
kemudian
```php artisan migrate```
dan ```php artisan db:seed```.

#####Run App
Untuk menjalankan App, pada root aplikasi ini ketik ```php artisan serve```
Jika tidak menggunakan cara ini, maka harus mengakses ke folder public, contoh: http://localhost/ditemukan/public