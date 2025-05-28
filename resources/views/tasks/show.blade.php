<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Detail Tugas: {{ $tugas->judul_tugas }}</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        h1 { color: #0056b3; }
        .task-detail { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px; margin: 20px 0; }
        .task-detail p { margin: 10px 0; }
        .task-detail strong { color: #333; }
        .status-belum-selesai { color: #d9534f; font-weight: bold; }
        .status-selesai { color: #5cb85c; font-weight: bold; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Detail Tugas</h1>

    <div class="task-detail">
        <p><strong>Judul:</strong> {{ $tugas->judul_tugas }}</p>
        <p><strong>Deskripsi:</strong> {{ $tugas->deskripsi ?? '-' }}</p>
        <p><strong>Status:</strong> <span class="status-{{ Str::slug($tugas->status) }}">{{ $tugas->status }}</span></p>
        <p><strong>Dibuat:</strong> {{ $tugas->created_at->format('d M Y H:i') }}</p>
        <p><strong>Terakhir Diperbarui:</strong> {{ $tugas->updated_at->format('d M Y H:i') }}</p>
    </div>

    <a href="{{ route('tasks.index') }}" class="back-link">Kembali ke Daftar Tugas</a>
</body>
</html>