# Sistem Manajemen Catatan Pengguna

Aplikasi API ini bertujuan memberikan layanan manajemen catatan pengguna dengan menggunakan endpoint-endpoint API yang memfasilitasi registrasi pengguna, otentikasi, dan manajemen catatan. Dengan menggunakan API ini, pengguna dapat mendaftarkan akun, masuk ke dalam sistem, dan mengelola catatan pribadi mereka. Berikut adalah deskripsi lebih lanjut tentang fitur dan fungsionalitas API:

## Daftar Isi

- [Pengguna (Users)](#pengguna-users)
- [Catatan (Notes)](#catatan-notes)
- [Otentikasi dan Otorisasi](#otentikasi-dan-otorisasi)
- [API Endpoints](#api-endpoints)
- [Contoh Aliran Kerja Pengguna](#contoh-aliran-kerja-pengguna)

## Pengguna (Users)

- **Registrasi dan Masuk:**
  - Pengguna harus membuat akun untuk mengakses sistem, dengan menyediakan informasi seperti nama, alamat email, dan kata sandi.
  - Setiap pengguna dapat masuk ke dalam sistem dengan kredensial mereka.

- **Informasi Profil:**
  - Setiap pengguna memiliki informasi profil termasuk nama, alamat email, dan kata sandi.

- **Kumpulan Catatan Pribadi:**
  - Setiap pengguna memiliki kumpulan catatan yang hanya dapat diakses oleh mereka sendiri.

## Catatan (Notes)

- **Atribut Catatan:**
  - Setiap catatan memiliki atribut seperti judul, isi, tanggal dibuat, dan pengguna yang membuat catatan tersebut.

- **Manajemen Catatan:**
  - Catatan dapat disimpan, diperbarui, atau dihapus oleh pemiliknya.

## Otentikasi dan Otorisasi

- **Otentikasi Pengguna:**
  - Pengguna harus masuk ke dalam akun mereka menggunakan kredensial mereka untuk mengakses catatan mereka.

- **Otorisasi Akses Catatan:**
  - Otorisasi dilakukan untuk memastikan bahwa hanya pemilik catatan yang memiliki akses untuk mengedit atau menghapus catatan mereka.

## API Endpoints

| Metode | Endpoint                | Deskripsi                                         |
|--------|-------------------------|---------------------------------------------------|
| POST   | `/api/users`            | Mendaftarkan pengguna baru dan mengelola informasi profil pengguna. |
| POST   | `/api/login`            | Otentikasi pengguna yang sudah terdaftar.          |
| GET    | `/api/notes`            | Mendapatkan daftar catatan pengguna yang dimiliki. |
| POST   | `/api/notes`            | Membuat catatan baru.                              |
| GET    | `/api/notes/{note_id}`  | Mendapatkan detail catatan berdasarkan ID.         |
| PUT    | `/api/notes/{note_id}`  | Memperbarui catatan berdasarkan ID.                |
| DELETE | `/api/notes/{note_id}`  | Menghapus catatan berdasarkan ID.                  |

### Contoh Penggunaan Endpoint

- **Mendaftar Pengguna Baru:**
curl -X POST https://api.example.com/api/users -d '{"nama": "Nama Pengguna", "email": "pengguna@example.com", "sandi": "kata_sandi"}'

- **Otentikasi Pengguna:**
curl -X POST https://api.example.com/api/login -d '{"email": "pengguna@example.com", "sandi": "kata_sandi"}'

- **Membuat Catatan Baru:**
curl -X POST -H "Authorization: Bearer <token>" https://api.example.com/api/notes -d '{"judul": "Judul Catatan", "isi": "Isi catatan..."}'

- **Membuat Catatan Baru:**
curl -X PUT -H "Authorization: Bearer <token>" https://api.example.com/api/notes/1 -d '{"judul": "Judul Baru", "isi": "Isi catatan yang diperbarui..."}'

- **Menghapus Catatan:**
curl -X DELETE -H "Authorization: Bearer <token>" https://api.example.com/api/notes/1

Silakan sesuaikan contoh penggunaan endpoint dengan metode dan endpoint yang sebenarnya yang digunakan dalam API Anda. Pastikan untuk memberikan informasi yang cukup untuk memandu pengguna melalui penggunaan endpoint secara praktis.

## Parameter Request

### Parameter Query

- `param1`: Deskripsi parameter 1.
- `param2`: Deskripsi parameter 2.

### Parameter Body (Contoh Permintaan)

```json
{
  "param1": "nilai1",
  "param2": "nilai2"
}
