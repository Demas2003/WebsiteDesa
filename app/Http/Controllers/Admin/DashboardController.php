<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'newsCount' => News::count(),
            'galleryCount' => Gallery::count(),
            'servicesCount' => Service::count(),
            'visitorCount' => 0, // Akan diimplementasikan nanti dengan sistem tracking pengunjung
            'recentNews' => News::latest()->take(5)->get(),
            'recentGallery' => Gallery::latest()->take(6)->get(),
        ]);
    }
}
