<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .feedback-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-control, .form-control:focus {
            background-color: #f0f0f0;
            border: none;
            box-shadow: none;
        }
        .btn-cancel {
            color: #6c757d;
            border: none;
            background: none;
        }
        .btn-submit {
            background-color: #20a0a0;
            color: white;
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="feedback-container mt-5 p-4 mb-5">
    <h4>Kirim Feedback</h4>
    <p class="text-muted">Masukkan data sesuai dengan data yang Anda masukkan ketika pendaftaran konsultasi</p>
    
    <form action="{{ route('feedback.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 text-start">
            <label for="feedbackType" class="form-label">Dokter</label>
            <select class="form-select" name="id_dokter" id="feedbackType" aria-label="Pilih jenis feedback">
                <option selected disabled>Pilih Dokter</option>
                @foreach ($dokter as $dokters)
                    <option value="{{ $dokters->id }}">{{ $dokters->nama_dokter }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 text-start">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK">
        </div>
        <div class="mb-3 text-start">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama_pasien" id="name" placeholder="Masukkan Nama">
        </div>
        <div class="mb-3 text-start">
            <label for="comment" class="form-label">Penilaian</label>
            <textarea class="form-control" name="komentar" id="comment" rows="3" placeholder="Masukkan Komentar"></textarea>
        </div>
        
        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-cancel">Batal</button>
            <button type="submit" class="btn btn-submit px-4">Kirim</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
