@extends('layouts.sidebar')
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <x-page-header>
                <x-slot:title>Notifikasi</x-slot:title>
                <x-slot:subtitle>Kelola Notifikasi</x-slot:subtitle>
            </x-page-header>
            <div class="card-body p-0">
                <div id="notification-list" style="height: 500px; overflow-y: auto;">
                    @foreach($notifications as $notif)
                        <div class="p-3 border-bottom notif-item {{ $notif->category }}">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><strong>{{ $notif->title }}</strong></h6>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 text-secondary">{{ $notif->message }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection