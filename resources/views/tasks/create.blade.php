<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas Baru</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        h1 { color: #0056b3; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 500px; margin: 20px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: calc(100% - 22px); padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button[type="submit"] { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; }
            button[type="submit"]:hover { background-color: #0056b3; }
.error-message { color: red; font-size: 0.9em; margin-top: -10px; margin-bottom: 10px; }
.back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
.back-link:hover { text-decoration: underline; }
.validation-errors { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
</style>
</head>
<body>
<h1>Tambah Tugas Baru</h1>

    @if ($errors->any())
        <div class="validation-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf <label for="judul_tugas">Judul Tugas:</label>
        <input type="text" id="judul_tugas" name="judul_tugas" value="{{ old('judul_tugas') }}" required>
        @error('judul_tugas')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Simpan Tugas</button>
    </form>

    <a href="{{ route('tasks.index') }}" class="back-link">Kembali ke Daftar Tugas</a>
</body>
</html>