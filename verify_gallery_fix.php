<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Models\Galeri;

$galeris = Galeri::latest()->get();

echo "Gallery Images - Verified URLs:\n\n";

foreach ($galeris as $galeri) {
    $url = \Illuminate\Support\Facades\Storage::disk('public')->url($galeri->image);
    $fileExists = file_exists(storage_path('app/public/' . $galeri->image));
    
    echo "ID: {$galeri->id}\n";
    echo "Title: {$galeri->title}\n";
    echo "Image Path in DB: {$galeri->image}\n";
    echo "Generated URL: {$url}\n";
    echo "File Exists: " . ($fileExists ? 'YES ✓' : 'NO ✗') . "\n";
    echo "File Size: " . filesize(storage_path('app/public/' . $galeri->image)) . " bytes\n";
    echo "\n";
}
?>
