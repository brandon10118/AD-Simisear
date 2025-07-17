<?php

//db connection
function getDatabaseConnection(): PDO {
    $dsn = "pgsql:host={$_ENV['POSTGRES_HOST']};port={$_ENV['POSTGRES_PORT']};dbname={$_ENV['POSTGRES_DB']}";
    return new PDO($dsn, $_ENV['POSTGRES_USER'], $_ENV['POSTGRES_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}