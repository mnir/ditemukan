# Contribution Guidelines

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

######Migrations & Seeds
- Setelah melakukan konfigurasi koneksi dan pembuatan database, silahkan lakukan
```php artisan migrate:install```
kemudian
```php artisan migrate```
dan ```php artisan db:seed```.