<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Faq;
use App\Models\PortfolioCategory;
use App\Models\Post;
use App\Models\Project;
use App\Models\Responsibility;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'services' => Service::active()->orderBy('sort')->limit(6)->get(),
            'skills' => Skill::active()->orderBy('sort')->get()->groupBy('category_bn'),
            'responsibilities' => Responsibility::active()->orderBy('sort')->get(),
            'featuredProjects' => Project::with('category')->where('featured', true)->active()->limit(3)->get(),
            'portfolios' => Project::with('category')->active()->orderBy('sort')->limit(6)->get(),
            'categories' => PortfolioCategory::active()->orderBy('sort')->get(),
            'team' => TeamMember::active()->orderBy('sort')->limit(4)->get(),
            'certificates' => Certificate::active()->orderBy('sort')->get(),
            'testimonials' => Testimonial::active()->orderBy('sort')->get(),
            'faqs' => Faq::active()->orderBy('sort')->get(),
            'stats' => Stat::active()->orderBy('sort')->get(),
            'posts' => Post::active()->whereNotNull('published_at')->latest('published_at')->limit(3)->get(),
        ]);
    }
}
