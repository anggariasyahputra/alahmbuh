<div>
    <div class="card">
        <div class="card-header">
            <h3>{{ $quiz->title }}</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <h4>Anda sudah mengerjakan quiz ini</h4>
                <p>Quiz ini telah Anda selesaikan sebelumnya.</p>
                <p>Setiap user hanya dapat mengerjakan quiz satu kali.</p>
            </div>

            <div class="mt-4">
                {{-- <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Kembali ke Daftar Quiz</a> --}}
            </div>
        </div>
    </div>
</div>
