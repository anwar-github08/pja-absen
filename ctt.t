# tampilkan gambar ketika upload
# tambah edit jam
# cara relasi dengan id null
# dihalaman admin, data absen bisa ditampilkan sesui tanggal
# jika pilih tanggal yang sama, kasih validasi
# jika jabatan kosong. tombol simpan disable pada akses kunjungan
# kasih admin pada index
# buat form mengelola data kunjungan
# cara buka kamera hp laravel
# select2

/user view/
# datatables
# loading selama page diload
# login untuk hak akses
# ketika sudah absen, kasih alert sudah absen

/admin view/
# datatables
# detail pada kunjungan
# export pdf dan excel
# relasi jika data dihapus
# * login untuk admin
# masalah karyawan admin
# hak akses untuk login admin/authorization
# hak akses untuk akses kunjungan
# fungsi hapus data pda admin->unlink image
# hapus data kunjungan+unlink
# kasih error reporting pada hapus absen
# membuat data izin,export dan hapus
# jam kerja simpan ke absen belum selesai
# kurang kondisi istirahat
# jika kondisi fix, kasih juga ke report

/other/
lokasi kurang akurat

relasi: jika jabatan dihapus, data karyawan berdasar jabatan akan kehapus
jika karyawan dihapus, semua data yang ada id karyawan akan kehapus


/kondisi datang/
jam datang = 07.30
jam sebelum datang = 06.00
jam setelah datang = 08.00
karyawan datang = 07.20

jika karyawan datang < jam datang and karyawan datang > jam sebelum datang -> lebih awal jam datang - karyawan datang

jika karyawan datang > jam datang and karyawan datang <= jam setelah datang -> terlambat karyawan datang - jam datang


/kondisi istirahat/
jam istirahat keluar = 12.00
jam istirahat masuk = 13.00
jam sebelum istirahat = 11.30
jam setelah istirahat = 13.30

karyawan istirahat keluar = 12.30
karyawan istirahat masuk = 13.00


/kondisi pulang/
jam pulang = 16.30
jam sebelum pulang = 16.00
jam setelah pulang = 21.00
karyawan pulang = 20.00

jika karyawan pulang < jam pulang and karyawan pulang > jam sebelum pulang -> pulang lebih awal jam pulang - karyawan pulang

jika karyawan pulang > jam pulang and karyawan pulang <= jam setelah pulang -> pulang terlambat karyawan pulang - jam pulang
