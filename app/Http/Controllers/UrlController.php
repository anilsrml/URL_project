<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UrlShortenerService;

class UrlController extends Controller
{
    protected $urlShortenerService;

    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function shorten(Request $request)
    {
        $result = $this->urlShortenerService->shortenUrl($request->input('url'));

        return view('welcome', ['result' => $result]);
    }

    public function redirect($shortCode)
    {
        $originalUrl = $this->urlShortenerService->getOriginalUrl($shortCode);

        if ($originalUrl) {
            return redirect($originalUrl);
        }

        return abort(404);
    }
}
