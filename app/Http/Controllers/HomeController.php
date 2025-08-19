<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Profile;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
            
        $galleries = Gallery::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();
            
        $services = Service::where('status', 'active')
            ->orderBy('order')
            ->get();

        return view('home', compact('profile', 'news', 'galleries', 'services'));
    }

    public function news()
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('news', compact('news'));
    }

    // public function newsDetail($slug)
    // {
    //     $news = News::where('slug', $slug)
    //         ->where('is_published', true)
    //         ->firstOrFail();

    //     $relatedNews = News::where('is_published', true)
    //         ->where('id', '!=', $news->id)
    //         ->latest()
    //         ->take(3)
    //         ->get();

    //     return view('news-detail-new', compact('news', 'relatedNews'));
    // }

    public function newsDetail($slug)
{
    $news = News::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    // Tambahkan view count
    $news->increment('view_count');

    $relatedNews = News::where('is_published', true)
        ->where('id', '!=', $news->id)
        ->latest()
        ->take(3)
        ->get();

    $profile = \App\Models\Profile::first();

    return view('news-detail-new', compact('news', 'relatedNews', 'profile'));
}

    public function gallery()
    {
        $galleries = Gallery::where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('gallery', compact('galleries'));
    }
}
