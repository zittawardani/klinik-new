<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokter;


class DokterTest extends TestCase
{

     /**
     * Test metode get all
     */
    public function test_get_all() {

    // Kirim permintaan GET ke route index dokter
    $response = $this->get(route('dokter.index'));


    // Periksa status respon 200 OK
    $response->assertStatus(200);

    // Periksa tampilan view yang digunakan
    $response->assertViewIs('backend.dokter.index');

    // Periksa bahwa data dokter tersedia dalam view
    $response->assertViewHas('dokter');

    // Periksa bahwa judul halaman adalah 'Dokter'
    $response->assertViewHas('title', 'Dokter');
    }

    /**
     * Test metode store
     */
    public function test_store()
    {
        $file = UploadedFile::fake()->image('729444704.png', 500, 500);
        
        // Tambah data
        $data = [
            'sip' => '9837487347',
            'nama_dokter' => 'Dr. Adi',
            'spesialis' => 'Syaraf',
            'foto_dokter' => $file,
            'jadwal' => [
                ['hari' => 'Senin', 'sesi' => 'Pagi'],
                ['hari' => 'Selasa', 'sesi' => 'Siang'],
            ],
        ];

        $response = $this->post(route('dokter.store'), $data);

        $response->assertRedirect(route('dokter.index'));
        $response->assertSessionHas('success', 'Data berhasil ditambahkan');

        $this->assertDatabaseHas('dokters', [
            'sip' => '9837487347',
            'nama_dokter' => 'Dr. Adi',
            'spesialis' => 'Syaraf',
        ]);

        // Periksa apakah gambar tersimpan di direktori yang tepat
        $storedFileName = Dokter::latest()->first()->foto_dokter;

    }

    /**
     * Test metode edit
     */
    public function test_edit() {
        
        // Buat dokter baru menggunakan factory
        $dokter = Dokter::factory()->create();
    
        // Simulasikan penyimpanan sementara untuk menguji upload file
        Storage::fake('public');
    
        // Buat file gambar palsu untuk di-upload
        $file = UploadedFile::fake()->image('1729444704.png', 500, 500); // Hanya menggunakan nama file
    
        // Data baru untuk diperbarui
        $data = [
            'sip' => '987654321',
            'nama_dokter' => 'Dokter Lama',
            'spesialis' => 'Spesialis',
            'foto_dokter' => $file,
            'jadwal' => [
                ['hari' => 'Selasa', 'sesi' => 'Siang'],
            ],
        ];

        // Kirim permintaan PUT ke rute update dokter
        $response = $this->post(route('dokter.update', $dokter->id), $data);
    
        // Periksa bahwa pengguna diarahkan kembali ke halaman dokter
        $response->assertRedirect(route('dokter.index'));
        $response->assertSessionHas('success', 'Data berhasil di update');
    
        // Periksa bahwa data dokter telah diperbarui di database
        $this->assertDatabaseHas('dokters', [
            'id' => $dokter->id,
            'sip' => '987654321',
            'nama_dokter' => 'Dokter Lama',
            'spesialis' => 'Spesialis',
        ]);
    }
    
    /**
     * Test metode delete
     */
    public function test_delete() {
        
            // Membuat data dokter secara manual tanpa factory
            $dokter = Dokter::factory()->create();

            // Simpan file gambar di storage palsu
            Storage::disk('public')->put('dokter\1729444704.png', 'dummy_content');
    
            // Pastikan file gambar tersimpan di storage
            Storage::disk('public')->assertExists('dokter\1729444704.png');
    
            // Kirim permintaan delete
            $response = $this->get(route('dokter.delete', $dokter->id));
    
            // Pastikan redirect ke halaman index dokter dengan pesan success
            $response->assertRedirect(route('dokter.index'));
            $response->assertSessionHas('success', 'Data berhasil di delete');
    
            // Verifikasi data dokter telah dihapus dari database
            $this->assertDatabaseMissing('dokters', [
                'id' => $dokter->id,
            ]);
    
            // Pastikan gambar telah dihapus dari storage
            Storage::disk('public')->assertMissing('storage\app\public\dokter\1729444704.png');
    }
}
