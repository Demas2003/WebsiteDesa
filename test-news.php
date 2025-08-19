<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'trengguli',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Check for published news
$news = Capsule::table('news')->where('status', 'published')->first();

if ($news) {
    echo "Found published news:\n";
    echo "Title: " . $news->title . "\n";
    echo "Slug: " . $news->slug . "\n";
    echo "URL: http://trengguli.id/berita/" . $news->slug . "\n";
} else {
    echo "No published news found. Creating sample...\n";
    
    // Create sample news
    $slug = 'berita-sample-' . date('Y-m-d');
    $id = Capsule::table('news')->insertGetId([
        'title' => 'Berita Sample untuk Testing',
        'slug' => $slug,
        'content' => '<p>Ini adalah konten berita sample untuk testing tampilan baru.</p><p>Konten ini berisi beberapa paragraf untuk memastikan tampilan "read more" bekerja dengan baik.</p><ul><li>Poin pertama</li><li>Poin kedua</li><li>Poin ketiga</li></ul><p>Semoga tampilan baru ini lebih menarik dan user-friendly!</p>',
        'image' => 'news/sample.jpg',
        'status' => 'published',
        'published_at' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    
    echo "Sample news created with ID: $id\n";
    echo "URL: http://trengguli.id/berita/$slug\n";
}
