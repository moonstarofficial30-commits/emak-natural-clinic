<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\News;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'doctors' => Doctor::count(),
            'services' => Service::count(),
            'appointments_pending' => Appointment::where('status', 'pending')->count(),
            'appointments_today' => Appointment::whereDate('appointment_date', today())->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'published_news' => News::published()->count(),
        ];

        $recentAppointments = Appointment::with(['doctor', 'department'])
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'recentMessages'));
    }
}
