<?php
namespace App\Core;

interface SessionInterface
{
    public static function start(): void;
    public static function set(string $key, $value): void;
    public static function get(string $key);
    public static function remove(string $key): void;
    public static function destroy(): void;

    public function setFlash(string $key, string $message): void;
    public function hasFlash(string $key): bool;
    public function getFlash(string $key): ?string;
    
}
