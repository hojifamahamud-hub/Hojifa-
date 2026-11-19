<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->string('price', 30);
            $table->string('unit_bn')->nullable();
            $table->string('unit_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->text('description_en')->nullable();
            $table->json('features')->nullable();
            $table->string('badge_bn')->nullable();
            $table->string('badge_en')->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('calculator_items', function (Blueprint $table) {
            $table->id();
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->string('category_bn')->nullable();
            $table->string('category_en')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('meeting_type')->nullable()->after('timeline');
            $table->date('preferred_date')->nullable()->after('meeting_type');
        });

        $settings = [
            'currency' => '$',
            'calc_discount_percent' => '10',
            'calc_discount_min_items' => '3',
            'meeting_options' => "Free Consultation | 15 min · Quick chat about your project needs | Free\nStrategy Session | 30 min · In-depth marketing strategy discussion | \$25\nProject Kickoff | 60 min · Full planning session for your project | \$49",
            'platforms' => "Freelancer\nPeoplePerHour\nGuru\nToptal\n99designs\nDesignCrowd\nFiverr",
        ];

        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value, 'group' => 'pricing']);
        }

        Setting::firstOrCreate(['key' => 'site_name_bn'], ['value' => 'Avishek Sarkar', 'group' => 'brand']);
        Setting::firstOrCreate(['key' => 'site_name_en'], ['value' => 'Avishek Sarkar', 'group' => 'brand']);

        $packages = [
            ['name_bn' => 'স্টার্টার', 'name_en' => 'Starter', 'price' => '$49', 'unit_bn' => '/ প্রজেক্ট', 'unit_en' => '/ project',
                'description_bn' => 'শুরু করা ছোট ব্যবসার জন্য পারফেক্ট', 'description_en' => 'Perfect for small businesses getting started',
                'features' => ['Social Media Setup (2 Platforms)', 'Basic SEO Audit', '5 Social Media Posts', 'Basic Analytics Report', '1 Revision Round'], 'featured' => false, 'sort' => 1],
            ['name_bn' => 'প্রফেশনাল', 'name_en' => 'Professional', 'price' => '$99', 'unit_bn' => '/ মাস', 'unit_en' => '/ month',
                'description_bn' => 'গ্রোয়িং ব্যবসার জন্য সেরা', 'description_en' => 'Best for growing businesses',
                'badge_bn' => 'সবচেয়ে জনপ্রিয়', 'badge_en' => 'MOST POPULAR',
                'features' => ['Full Social Media Management', 'Complete SEO Optimization', '15 Social Media Posts/Month', 'Google Ads Management', 'Monthly Analytics Report', 'Pinterest Marketing', '1 Revision Round'], 'featured' => true, 'sort' => 2],
            ['name_bn' => 'এন্টারপ্রাইজ', 'name_en' => 'Enterprise', 'price' => '$149', 'unit_bn' => '/ মাস', 'unit_en' => '/ month',
                'description_bn' => 'সম্পূর্ণ ডিজিটাল মার্কেটিং সমাধান', 'description_en' => 'Complete digital marketing solution',
                'features' => ['Everything in Professional', 'Website Design & Development', '30 Social Media Posts/Month', 'Video Content Creation', 'Email Marketing Automation', 'B2B Lead Generation', 'Dedicated Account Manager', 'Unlimited Revisions'], 'featured' => false, 'sort' => 3],
        ];

        foreach ($packages as $package) {
            \App\Models\PricingPackage::create([...$package, 'active' => true]);
        }

        $items = [
            ['SEO Audit & Report', 'SEO', 15], ['Full SEO Optimization', 'SEO', 79], ['Keyword Research', 'SEO', 25],
            ['Social Media Setup', 'Social Media', 19], ['Social Media Management', 'Social Media', 59], ['Social Media Ads', 'Social Media', 49],
            ['Pinterest Marketing', 'Social Media', 35], ['Google Ads Management', 'Advertising', 69],
            ['Landing Page Design', 'Web Design', 59], ['Full Website Design', 'Web Design', 149],
            ['Logo & Brand Identity', 'Design', 35], ['Video Content (5 videos)', 'Content', 59],
            ['Email Marketing Setup', 'Marketing', 49], ['B2B Lead Generation', 'Marketing', 69],
        ];

        foreach ($items as $i => [$name, $category, $price]) {
            \App\Models\CalculatorItem::create([
                'name_bn' => $name, 'name_en' => $name,
                'category_bn' => $category, 'category_en' => $category,
                'price' => $price, 'sort' => $i + 1, 'active' => true,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('calculator_items');
        Schema::dropIfExists('pricing_packages');

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['meeting_type', 'preferred_date']);
        });
    }
};
