## Web API Vehicles Management
Web API ini dapat memanajemen kendaraan yang ada di perusahaan yang terdiri dari 2 tipe, yaitu kendaraan angkutan barang dan angkutan orang. Web API ini juga dapat memonitoring mulai dari konsumsi BBM, jadwal service, dan riwayat pemakaian kendaraan. Untuk dapat memakai kendaraan, pegawai (employee) diwajibkan untuk melakukan pemesanan terlebih dahulu ke pool atau bagian pengelola kendaraan (admin) dan pemakaian kendaraan harus diketahui atau disetujui oleh masing - masing atasan (spv admin dan spv employee).

## Additional Information
 - Database version Mysql 8.0.30
 - Laravel framework version 10
 - PHP version 8.1.10
 - API Documentation : click here 👋(https://documenter.getpostman.com/view/23104540/2s93RNzb44)

## Login Access
 - Superadmin
    * email    : superadmin@gmail.com
    * password : rahasia

- Admin 1
  - email    : admin1@gmail.com
  - password : rahasia
  
- Admin 2
  - email    : admin2@gmail.com
  - password : rahasia
  
- Spv Admin 1
  - email    : spv_admin1@gmail.com
  - password : rahasia
  
- Spv Admin 2
  - email    : spv_admin2@gmail.com
  - password : rahasia

- Spv Employee 1
  - email    : spv_employee1@gmail.com
  - password : rahasia
  
- Spv Employee 2
  - email    : spv_employee2@gmail.com
  - password : rahasia

## Pre-requisite
1. Setelah cloning, copy paste file .env.example di path yang sama
2. Rename file hasil copy tadi menjadi .env
3. Jalankan composer install
   ```
   composer install
   ```
4. Lalu, generate key untuk aplikasi
   ```
   php artisan key:generate
   ```
5. Kemudian, generate JWT Secret untuk login security
   ```
   php artisan jwt:secret
   ```
6. Buat database di phpmyadmin
7. Isi DB_DATABASE pada file .env dengan nama database yang telah dibuat
8. Jalankan migrasi dan seedernya 
   ```
   php artisan migrate:fresh --seed
   ```
9. Setelah selesai, jalankan serve
   ```
   php artisan serve
   ```
10. Uji coba atau testing menggunakan postman, insomnia, dan API Tools lainnya.

