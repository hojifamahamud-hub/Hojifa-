<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;

class LocaleController extends Controller
{
    public function __invoke(string $locale)
    {
        abort_unless(in_array($locale, SetLocale::SUPPORTED, true), 404);

        return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
    }
}
