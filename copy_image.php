<?php
// Script to copy the image from Downloads to the public/images directory

// Create the images directory if it doesn't exist
$targetDir = __DIR__ . '/public/images';
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
    echo "Created directory: {$targetDir}\n";
}

// Source file path
$sourceFile = 'C:/Users/Acer/Downloads/warehouse-staff-wearing-uniform-loading-parcel-box-checking-product-from-warehouse-delivery-logistic/inventory.jpg';

// Target file path
$targetFile = $targetDir . '/inventory.jpg';

// Copy the file
if (file_exists($sourceFile)) {
    if (copy($sourceFile, $targetFile)) {
        echo "Successfully copied image to: {$targetFile}\n";
    } else {
        echo "Failed to copy the image. Check permissions.\n";
    }
} else {
    echo "Source file not found: {$sourceFile}\n";
}

echo "Done!\n";