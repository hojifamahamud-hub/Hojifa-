<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Responsibility;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function services()
    {
        return view('services', [
            'services' => Service::active()->orderBy('sort')->get(),
            'skills' => Skill::active()->orderBy('sort')->get()->groupBy('category_bn'),
            'responsibilities' => Responsibility::active()->orderBy('sort')->get(),
            'page' => Page::where('slug', 'services')->where('active', true)->first(),
        ]);
    }
}
