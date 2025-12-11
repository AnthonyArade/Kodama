<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run migrations and seeders
$kernel->call('migrate', ['--force' => true]);
$kernel->call('db:seed', ['--force' => true]);

echo "Migration and seeding completed!";
