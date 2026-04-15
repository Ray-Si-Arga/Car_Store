{{-- Notifikasi Global --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.6/dist/simple-notify.min.css">
<script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.6/dist/simple-notify.min.js"></script>

{{-- Toast Global: Cukup panggil session()->flash('toast', [...]) dari controller manapun --}}
@if(session('toast'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Notify({
                status: '{{ session("toast.status", "info") }}',
                title: '{{ session("toast.title", "Notifikasi") }}',
                text: '{{ session("toast.text", "") }}',
                effect: 'slide',
                speed: 400,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 4000,
                position: 'right top'
            });
        });
    </script>
@endif

@stack('scripts')

{{-- Proses pemanggilan di controller--}}
{{-- return redirect()->back()->with('toast', [
'status' => 'success',
'title' => 'Berhasil!',
'text' => 'Pesanan telah disimpan.',
]); --}}