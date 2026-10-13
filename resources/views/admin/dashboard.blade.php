@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Specialists</div>
                        <div class="fs-3 fw-bold">{{ $stats['doctors'] }}</div>
                    </div>
                    <i class="bi bi-person-badge fs-1 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card" style="border-left-color: var(--ek-leaf);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Pending Appointments</div>
                        <div class="fs-3 fw-bold">{{ $stats['appointments_pending'] }}</div>
                    </div>
                    <i class="bi bi-hourglass-split fs-1 text-danger opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Appointments Today</div>
                        <div class="fs-3 fw-bold">{{ $stats['appointments_today'] }}</div>
                    </div>
                    <i class="bi bi-calendar2-day fs-1 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Services</div>
                        <div class="fs-3 fw-bold">{{ $stats['services'] }}</div>
                    </div>
                    <i class="bi bi-clipboard2-pulse fs-1 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card" style="border-left-color: var(--ek-leaf);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Unread Messages</div>
                        <div class="fs-3 fw-bold">{{ $stats['unread_messages'] }}</div>
                    </div>
                    <i class="bi bi-envelope-exclamation fs-1 text-danger opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="ek-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Published News</div>
                        <div class="fs-3 fw-bold">{{ $stats['published_news'] }}</div>
                    </div>
                    <i class="bi bi-newspaper fs-1 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Recent Appointments</h6>
                    <a href="{{ route('admin.appointments.index') }}" class="small">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Patient</th><th>Specialist</th><th>Date</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse ($recentAppointments as $a)
                                <tr>
                                    <td>{{ $a->full_name }}</td>
                                    <td>{{ $a->doctor?->name ?? '—' }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($a->appointment_date)->format('d M Y') }}</td>
                                    <td><span class="badge badge-{{ $a->status }} text-capitalize">{{ $a->status }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted">No appointments yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Recent Messages</h6>
                    <a href="{{ route('admin.messages.index') }}" class="small">View all</a>
                </div>
                @forelse ($recentMessages as $m)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <div>
                            <div class="fw-semibold small">{{ $m->name }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($m->subject, 30) }}</div>
                        </div>
                        @if (! $m->is_read)
                            <span class="badge bg-danger align-self-start">New</span>
                        @endif
                    </div>
                @empty
                    <p class="text-muted small mb-0">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
