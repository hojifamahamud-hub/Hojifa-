<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Page;
use App\Models\Stat;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('about', [
            'page' => Page::where('slug', 'about')->where('active', true)->first(),
            'team' => TeamMember::active()->orderBy('sort')->get(),
            'certificates' => Certificate::active()->orderBy('sort')->get(),
            'stats' => Stat::active()->orderBy('sort')->get(),
        ]);
    }
}
