<?php
// composer require vlucas/phpdotenv

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// echo getenv('S3_BUCKET');
echo $_ENV['S3_BUCKET'];
echo $_SERVER['S3_BUCKET'];

// echo getenv('PATH');
