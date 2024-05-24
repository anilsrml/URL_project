<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UrlShortenerService
{
    public function validateUrl($url)
    {
        $validator = Validator::make(['url' => $url], [
            'url' => 'required|url'
        ]);

        return $validator->passes();
    }

    public function generateShortCode()
    {
        return Str::random(12);
    }

    public function shortenUrl($originalUrl)
    {
        if (!$this->validateUrl($originalUrl)) {
            return ['error' => 'Invalid URL'];
        }

        $url = Url::where('original_url', $originalUrl)->first();

        if ($url) {
            return ['short_code' => $url->short_code];
        }

        $shortCode = $this->generateShortCode();
        Url::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);

        return ['short_code' => $shortCode];
    }

    public function getOriginalUrl($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->first();

        if ($url) {
            return $url->original_url;
        }

        return null;
    }
}
