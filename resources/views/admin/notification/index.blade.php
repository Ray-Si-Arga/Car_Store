@extends('layouts.sidebar')
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pusat Notifikasi Real-time</h5>
                <span class="badge bg-primary" id="notif-count">New</span>
            </div>
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