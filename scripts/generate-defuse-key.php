<?php
/**
 * gen-defuse-key.php
 * Generates a new Defuse encryption key.
 */

$pharFile = __DIR__ . '/defuse-crypto.phar';

// Download PHAR if missing
if (!file_exists($pharFile)) {
    echo "Downloading defuse-crypto.phar...\n";
    $url = 'https://github.com/defuse/php-encryption/releases/latest/download/defuse-crypto.phar';
    $content = file_get_contents($url);
    if ($content === false) {
        die("Failed to download PHAR from $url\n");
    }
    file_put_contents($pharFile, $content);
    echo "Downloaded successfully.\n";
}

// Load PHAR
require 'phar://' . $pharFile;

use Defuse\Crypto\Key;

// Generate and print key
echo Key::createNewRandomKey()->saveToAsciiSafeString() . PHP_EOL;