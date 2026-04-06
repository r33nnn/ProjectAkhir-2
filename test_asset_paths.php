<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Models\Galeri;

$galeris = Galeri::all();

echo "Testing asset() helper:\n\n";

foreach ($galeris as $g) {
    $imagePath = $g->image;
    
    // Method 1: Using asset() helper
    $url1 = asset('storage/' . $imagePath);
    
    // Method 2: Direct path
    $url2 = '/storage/' . $imagePath;
    
    // Method 3: Using Storage facade
    $url3 = \Illuminate\Support\Facades\Storage::disk('public')->url($imagePath);
    
    echo "Record ID {$g->id}:\n";
    echo "  asset():        $url1\n";
    echo "  Direct path:    $url2\n";
    echo "  Storage URL:    $url3\n";
    echo "\n";
}
?>
