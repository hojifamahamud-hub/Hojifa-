<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Route as RouteFacade;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $urls = [
            route('home'), route('services'), route('about'), route('contact'),
            route('requirement.show'), route('blog.index'), route('portfolio.index'),
            route('membership.show'),
        ];

        foreach (PortfolioCategory::active()->get() as $category) {
            $urls[] = route('portfolio.index', $category->slug);
        }

        foreach (Project::active()->get() as $project) {
            $urls[] = route('portfolio.show', $project);
        }

        foreach (Post::active()->get() as $post) {
            $urls[] = route('blog.show', $post);
        }

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
