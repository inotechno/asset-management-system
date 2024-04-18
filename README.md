# Asset Management System

## Deskripsi
Asset Management System adalah aplikasi manajemen aset yang dibangun menggunakan Laravel 8 sebagai backend, MySQL sebagai basis data, dan jQuery untuk interaksi antarmuka pengguna. Aplikasi ini dirancang untuk membantu perusahaan dalam mengelola aset mereka, termasuk informasi master data, aset, transaksi, dan laporan.

## Fitur
### Master Data
1. **Karyawan:** Pengelolaan informasi karyawan termasuk data pribadi, jabatan, dan informasi kontak.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/6cd50586-2bba-4e0e-a0ea-a5366fd7c1cd)

2. **Regional:** Penyimpanan data regional yang digunakan dalam konteks perusahaan.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/25108f40-ed6c-4405-b08a-b943ca4070ac)

3. **Perusahaan:** Manajemen data perusahaan termasuk informasi kontak dan alamat.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/d1060c27-7454-4418-8f7b-eba00ba9e33a)

4. **Divisi:** Penyimpanan informasi tentang divisi atau departemen dalam perusahaan.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/27b16497-38d6-4421-bb2f-625771751b6a)


### Aset
1. **Kategori:** Pengelompokan aset berdasarkan kategori tertentu untuk memudahkan manajemen dan pencarian.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/7502535e-5e07-4d34-82cf-c8e90b7bc11d)

2. **Supplier:** Manajemen informasi tentang pemasok atau supplier aset.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/5d849ad0-ca1e-43fa-bf76-5f2e55a124a1)

3. **Aset:** Penyimpanan informasi rinci tentang aset, termasuk data spesifikasi dan status.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/261cf444-4a75-4a7a-b5c7-9bfad53301c5)

### Transaksi
1. **Tambah Transaksi In/Out:** Pengguna dapat melakukan transaksi masuk (penerimaan aset) atau keluar (pemindahan atau pengembalian aset).
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/b242618e-526d-48b1-83c3-5b92b412917a)

2. **Daftar Transaksi:** Daftar riwayat transaksi termasuk informasi aset yang terlibat, tanggal transaksi, dan keterangan.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/43878e92-77a9-4091-b2f0-617515e997db)


### Monitoring
1. **Per Aset:** Monitoring tentang status dan riwayat transaksi untuk setiap aset.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/2d834793-616f-49c7-953a-aab29cae6447)

2. **Per Karyawan:** Monitoring tentang aset yang dikelola oleh karyawan tertentu.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/9b94d371-9953-40e3-bf92-1204f7b7ea0e)

3. **Per Perusahaan:** Monitoring tentang aset yang dimiliki oleh perusahaan dan riwayat transaksinya.
![gambar](https://github.com/inotechno/asset-management-system/assets/151206616/37639029-4fc6-4217-a493-1c93e6bf6ccd)


## Teknologi yang Digunakan
- Laravel 8: Framework PHP yang kuat untuk pengembangan aplikasi web.
- MySQL: Sistem manajemen basis data relasional untuk menyimpan data.
- jQuery: Library JavaScript untuk membuat interaksi antarmuka pengguna yang dinamis.

## Cara Penggunaan
1. Pastikan PHP dan MySQL telah terpasang di komputer lokal Anda.
2. Clone repositori ini ke komputer Anda.
3. Konfigurasikan koneksi basis data MySQL di file `.env`.
4. Jalankan `composer install` untuk menginstal dependensi PHP.
5. Jalankan `php artisan migrate` untuk membuat tabel-tabel yang diperlukan di dalam basis data.
6. Buka aplikasi di browser Anda dan mulailah mengelola aset perusahaan Anda!

## Kontribusi
Kami mengundang kontribusi dalam bentuk laporan bug, permintaan fitur, atau pengembangan lebih lanjut. Silakan berkontribusi untuk membuat Asset Management System lebih baik!

Terima kasih
