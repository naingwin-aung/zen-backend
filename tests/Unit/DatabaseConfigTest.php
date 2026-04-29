<?php

use Tests\TestCase;

uses(TestCase::class);

test('database configuration falls back to postgres', function () {
    putenv('DB_CONNECTION');
    unset($_ENV['DB_CONNECTION'], $_SERVER['DB_CONNECTION']);

    $databaseConfig = require base_path('config/database.php');

    expect($databaseConfig['default'])->toBe('pgsql')
        ->and($databaseConfig['connections']['pgsql']['driver'])->toBe('pgsql');
});
