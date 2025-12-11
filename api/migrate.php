<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run migrations and seeders
$kernel->call('migrate:fresh', ['--force' => true]);
$kernel->call('db:seed', ['DatabaseSeeder', '--force' => true]);

echo "Migration and seeding completed!";
