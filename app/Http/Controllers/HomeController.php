<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Profile;
use App\Models\Potential;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        
        $news = News::published()
            ->orderByDesc('published_at')
            ->take(3)
            ->get();
        
        $potentials = Potential::all();
            
        $galleries = Gallery::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();
            
        $services = Service::where('status', 'active')
            ->orderBy('order')
            ->get();

        return view('home', compact('profile', 'news','potentials', 'galleries', 'services'));
    }

    public function news()
    {
        $news = News::published()
            ->orderByDesc('published_at')
            ->paginate(9);

        $profile = Profile::first();

        return view('news', compact('news', 'profile'));
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
    $news = News::published()
        ->where('slug', $slug)
        ->firstOrFail();

    // Tambahkan view count
    $news->increment('view_count');

    $relatedNews = News::published()
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

        $profile = Profile::first();

        return view('gallery', compact('galleries', 'profile'));
    }
    

    public function potentialDetail($id)
{
    $potential = Potential::findOrFail($id);
    $profile = Profile::first();
    
    // Tambahkan view count jika diperlukan
    // $potential->increment('view_count');
    
    return view('potential-detail', compact('potential', 'profile'));
}

public function allPotentials()
{
    $potentials = Potential::orderBy('id', 'desc')->paginate(9);
    $profile = Profile::first();
    
    return view('potential-all', compact('potentials', 'profile'));
}

}
