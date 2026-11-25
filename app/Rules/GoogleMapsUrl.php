<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GoogleMapsUrl implements ValidationRule
{
    /**
     * Pastikan URL hanya mengarah ke Google Maps, bukan sembarang URL
     * yang akan dimasukkan ke dalam iframe.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $host = strtolower((string) parse_url((string) $value, PHP_URL_HOST));
        $path = (string) parse_url((string) $value, PHP_URL_PATH);

        $isGoogleDomain = preg_match('/^(www\.)?google\.[a-z.]+$/', $host)
            || preg_match('/^maps\.google\.[a-z.]+$/', $host);

        $isShortLink = in_array($host, ['maps.app.goo.gl', 'goo.gl'], true);

        if (! $isGoogleDomain && ! $isShortLink) {
            $fail('Tautan peta harus berupa URL Google Maps.');
            return;
        }

        if ($isGoogleDomain && ! str_contains($path, '/maps')) {
            $fail('Tautan peta harus berupa URL Google Maps.');
        }
    }
}
