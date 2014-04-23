# Contribution Guidelines

#####Composer Update
``` composer update --no-script ```

#####Database
- Untuk menghindari konflik antar setingan berbeda, silahkan buat file di ```app/config/local/database.php``` kemudian copy-paste file ```app/config/database.php``` dengan setingan database lokal anda. File ini akan meng-overide file ```app/config/database.php```.

- Setelah melakukan konfigurasi koneksi dan pembuatan database, silahkan lakukan ```php artisan migrate:install``` kemudian ```php artisan migrate``` dan ```php artisan db:seed```.