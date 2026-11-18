<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PortfolioCategory;
use App\Models\Post;
use App\Models\Project;
use App\Models\Responsibility;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@mahmudsupport.xyz')],
            [
                'name' => 'Mahmud',
                'password' => env('SEED_ADMIN_PASSWORD', 'Admin@12345'),
                'role' => User::ROLE_ADMIN,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $this->settings();
        $this->content();
    }

    private function settings(): void
    {
        $settings = [
            'site_name_bn' => 'মাহমুদ সাপোর্ট',
            'site_name_en' => 'Mahmud Support',
            'tagline_bn' => 'ডিজিটাল গ্রোথ পার্টনার',
            'tagline_en' => 'Digital Growth Partner',

            'hero_badge_bn' => '১০০+ প্রজেক্ট সম্পন্ন',
            'hero_badge_en' => '100+ Projects Delivered',
            'hero_title_bn' => 'আপনার বিজনেসকে ডিজিটালে সবার আগে নিয়ে যান',
            'hero_title_en' => 'Take Your Business First in the Digital Race',
            'hero_subtitle_bn' => 'ওয়েব ডেভেলপমেন্ট, মার্কেটিং অটোমেশন ও এআই-চালিত সমাধানে আমরা আপনার বিশ্বস্ত পার্টনার — আইডিয়া থেকে রেজাল্ট পর্যন্ত।',
            'hero_subtitle_en' => 'Web development, marketing automation and AI-powered solutions — from idea to measurable results.',
            'hero_cta_bn' => 'ফ্রি কনসালটেন্সি নিন',
            'hero_cta_en' => 'Get Free Consultancy',
            'hero_cta_url' => '/requirement',

            'contact_email' => 'hello@mahmudsupport.xyz',
            'address_bn' => 'ঢাকা, বাংলাদেশ',
            'address_en' => 'Dhaka, Bangladesh',

            'popup_mode' => 'popup',
            'popup_title_bn' => 'নতুন অফার ও টিপস আপনার ইনবক্সে',
            'popup_title_en' => 'Offers & tips in your inbox',
            'popup_text_bn' => 'আপনার ইমেইল দিলে নির্বাচিত ক্লায়েন্টদের জন্য বিশেষ অফার ও মার্কেটিং টিপস পাঠানো হবে।',
            'popup_text_en' => 'Share your email to receive exclusive offers and marketing tips.',

            'payment_bank_info' => 'International payment: Bank transfer / PayPal (details on request)',
            'payment_note_bn' => 'পেমেন্ট করার পর ভাউচার পেজ থেকে WhatsApp-এ কনফার্ম করুন।',
            'payment_note_en' => 'After paying, confirm via WhatsApp from the voucher page.',

            'ai_enabled' => '0',
            'ai_base_url' => 'https://api.mistral.ai/v1',
            'ai_model' => 'mistral-small-latest',
            'ai_system_prompt' => 'আপনি একজন ডিজিটাল মার্কেটিং কনসালট্যান্ট। ছোট ও মাঝারি বিজনেসের জন্য বাংলা ও ইংরেজিতে বাস্তবসম্মত মার্কেটিং পরিকল্পনা, চ্যানেল আইডিয়া ও কনটেন্ট সাজেশন দিন।',

            'meta_title_bn' => 'মাহমুদ সাপোর্ট — ডিজিটাল গ্রোথ পার্টনার',
            'meta_title_en' => 'Mahmud Support — Digital Growth Partner',
            'meta_desc_bn' => 'ওয়েব ডেভেলপমেন্ট, মার্কেটিং অটোমেশন ও এআই-চালিত সমাধান। আপনার বিজনেসের জন্য আজই ফ্রি কনসালটেন্সি নিন।',
            'meta_desc_en' => 'Web development, marketing automation & AI solutions. Book your free consultancy today.',

            'footer_text_bn' => 'আপনার আইডিয়াকে ডিজিটাল সফলতায় রূপান্তরে আমরা আছি পাশে।',
            'footer_text_en' => 'We turn your ideas into digital success.',
        ];

        foreach ($settings as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function content(): void
    {
        if (Service::query()->exists()) {
            return;
        }

        $services = [
            ['title_bn' => 'ওয়েব ডেভেলপমেন্ট', 'title_en' => 'Web Development', 'icon' => '💻', 'slug' => 'web-development',
                'description_bn' => 'দ্রুত, সুরক্ষিত ও এসইও-বান্ধব ওয়েবসাইট ও ওয়েব অ্যাপ্লিকেশন।',
                'description_en' => 'Fast, secure and SEO-friendly websites and web applications.',
                'features' => ['Laravel / WordPress', 'SEO অপ্টিমাইজেশন', 'লগইন ও ড্যাশবোর্ড', '১ বছর সাপোর্ট']],
            ['title_bn' => 'ডিজিটাল মার্কেটিং', 'title_en' => 'Digital Marketing', 'icon' => '📈', 'slug' => 'digital-marketing',
                'description_bn' => 'ফেসবুক, গুগল ও লিড-ফোকাসড মার্কেটিং ক্যাম্পেইন।',
                'description_en' => 'Facebook, Google and lead-focused marketing campaigns.',
                'features' => ['ফেসবুক অ্যাডস', 'গুগল অ্যাডস', 'লিড ম্যাগনেট', 'রিপোর্টিং']],
            ['title_bn' => 'মার্কেটিং অটোমেশন', 'title_en' => 'Marketing Automation', 'icon' => '⚡', 'slug' => 'marketing-automation',
                'description_bn' => 'নিউটন/ফ্লোআপ টুল দিয়ে অটো লিড ক্যাপচার ও ফলো-আপ।',
                'description_en' => 'Automatic lead capture and follow-up with Newton/FlowUp tools.',
                'features' => ['নিউটন সেটআপ', 'ফ্লোআপ বট', 'ইমেইল অটোমেশন', 'WhatsApp ইন্টিগ্রেশন']],
            ['title_bn' => 'এআই সমাধান', 'title_en' => 'AI Solutions', 'icon' => '🤖', 'slug' => 'ai-solutions',
                'description_bn' => 'এআই চ্যাটবট, কনটেন্ট জেনারেশন ও অটোমেটেড রিসার্চ।',
                'description_en' => 'AI chatbots, content generation and automated research.',
                'features' => ['AI চ্যাটবট', 'কনটেন্ট জেনারেশন', 'ওয়েব রিসার্চ', 'কাস্টম টুল']],
            ['title_bn' => 'সার্ভার ও হোস্টিং', 'title_en' => 'Server & Hosting', 'icon' => '🛡️', 'slug' => 'server-hosting',
                'description_bn' => 'ভিপিএস সেটআপ, ডোমেইন-সার্ভার ম্যাপিং ও অ্যাকাউন্ট ক্রিয়েশন।',
                'description_en' => 'VPS setup, domain-server mapping and account creation.',
                'features' => ['VPS সেটআপ', 'DNS কনফিগারেশন', 'ইমেইল অ্যাকাউন্ট', 'নিরাপত্তা']],
            ['title_bn' => 'ডেটা ও লিড সার্ভিস', 'title_en' => 'Data & Lead Services', 'icon' => '🗃️', 'slug' => 'data-lead-services',
                'description_bn' => 'নির্ভুল ওয়েব রিসার্চ, ডেটা এন্ট্রি ও ভেরিফায়েড লিড সংগ্রহ।',
                'description_en' => 'Accurate web research, data entry and verified lead collection.',
                'features' => ['ওয়েব রিসার্চ', 'ডেটা এন্ট্রি', 'লিড জেনারেশন', 'ক্যাম্পেইন ডেটা']],
        ];

        foreach ($services as $i => $service) {
            Service::create($service + ['sort' => $i]);
        }

        $skills = [
            ['Laravel', 'ওয়েব ফ্রেমওয়ার্ক', 90],
            ['WordPress', 'ওয়েব ফ্রেমওয়ার্ক', 88],
            ['Meta Ads', 'মার্কেটিং', 92],
            ['Google Ads', 'মার্কেটিং', 85],
            ['নিউটন / ফ্লোআপ', 'অটোমেশন', 90],
            ['AI Tools', 'অটোমেশন', 88],
            ['Data Entry', 'ডেটা সার্ভিস', 95],
            ['Web Research', 'ডেটা সার্ভিস', 92],
        ];
        foreach ($skills as $i => [$name, $category, $level]) {
            Skill::create([
                'name_bn' => $name,
                'name_en' => $name,
                'category_bn' => $category,
                'category_en' => $category,
                'level' => $level,
                'sort' => $i,
            ]);
        }

        $responsibilities = [
            ['নির্ধারিত সময়ে ডেলিভারি', 'On-time Delivery', 'প্রতিটা কাজ গবেষণা করে সময়ের ভেতরে সম্পন্ন করা হয়।', 'Every task is researched and delivered on time.'],
            ['কোয়ালিটি ফার্স্ট', 'Quality First', 'ডেলিভারির আগে পুরোপুরি টেস্ট ও যাচাই করা হয়।', 'Everything is tested and verified before delivery.'],
            ['সার্ভার ও টুল সাপোর্ট', 'Server & Tool Support', 'সার্ভার, ডোমেইন ও অ্যাকাউন্ট সেটআপে সম্পূর্ণ সাপোর্ট।', 'Full support for server, domain and account setup.'],
            ['স্বচ্ছ পেমেন্ট', 'Transparent Payments', 'ভাউচার-ভিত্তিক স্বচ্ছ পেমেন্ট ট্র্যাকিং।', 'Voucher-based transparent payment tracking.'],
            ['প্রথমে কনসালট, তারপর কাজ', 'Consult First, Work Later', 'প্রয়োজন বুঝে সঠিক সমাধান প্রস্তাব করা হয়।', 'The right solution is proposed after understanding the need.'],
            ['দ্রুত রেসপন্স', 'Fast Response', 'যেকোনো সমস্যায় WhatsApp ও লাইভ চ্যাটে দ্রুত রেসপন্স।', 'Quick response on WhatsApp and live chat for any issue.'],
        ];
        foreach ($responsibilities as $i => $item) {
            Responsibility::create([
                'title_bn' => $item[0],
                'title_en' => $item[1],
                'description_bn' => $item[2],
                'description_en' => $item[3],
                'icon' => ['⏱️', '✅', '🛰️', '💳', '💬', '🚀'][$i],
                'sort' => $i,
            ]);
        }

        $categories = [
            ['ওয়েব ডিজাইন', 'Web Design', 'web-design'],
            ['ডিজিটাল মার্কেটিং', 'Digital Marketing', 'digital-marketing'],
            ['অটোমেশন', 'Automation', 'automation'],
            ['নলেজ প্ল্যাটফর্ম', 'Knowledge Platform', 'knowledge-platform'],
        ];
        foreach ($categories as $i => [$bn, $en, $slug]) {
            PortfolioCategory::create(['name_bn' => $bn, 'name_en' => $en, 'slug' => $slug, 'sort' => $i]);
        }

        $projects = [
            ['portfolio_category_id' => 1, 'title_bn' => 'এডুকেশন পোর্টাল', 'title_en' => 'Education Portal', 'slug' => 'education-portal',
                'client' => 'Academic Client', 'description_bn' => 'কোর্স ম্যানেজমেন্ট ও স্টুডেন্ট লগইন সম্পন্ন এডুকেশন পোর্টাল।',
                'metrics' => [['label' => 'লোড টাইম', 'value' => '২.১s → ০.৯s'], ['label' => 'ট্রাফিক', 'value' => '+৪০%']],
                'featured' => true],
            ['portfolio_category_id' => 2, 'title_bn' => 'ই-কমার্স মার্কেটিং', 'title_en' => 'E-commerce Marketing', 'slug' => 'ecommerce-marketing',
                'client' => 'Fashion Brand', 'description_bn' => 'ফেসবুক অ্যাডস + ফানেল দিয়ে বিক্রি ৩ গুণ।',
                'metrics' => [['label' => 'ROAS', 'value' => '5.2x'], ['label' => 'লিড', 'value' => '১২০০+']],
                'featured' => true],
            ['portfolio_category_id' => 3, 'title_bn' => 'ফ্লোআপ অটোমেশন বট', 'title_en' => 'FlowUp Automation Bot', 'slug' => 'flowup-automation-bot',
                'client' => 'Marketing Agency', 'description_bn' => 'অটো লিড ক্যাপচার ও WhatsApp ফলো-আপ বট।',
                'metrics' => [['label' => 'রেসপন্স টাইম', 'value' => '-৭৫%'], ['label' => 'অটো লিড', 'value' => '৮০০+']]],
            ['portfolio_category_id' => 4, 'title_bn' => 'নলেজ ব্লগ প্ল্যাটফর্ম', 'title_en' => 'Knowledge Blog Platform', 'slug' => 'knowledge-blog-platform',
                'client' => 'Blog Network', 'description_bn' => 'প্রোগ্রামেটিক এসইও ব্লগ প্ল্যাটফর্ম।',
                'metrics' => [['label' => 'র‍্যাঙ্ক করা পেজ', 'value' => '১৭০+']]],
        ];
        foreach ($projects as $i => $project) {
            Project::create($project + ['sort' => $i]);
        }

        TeamMember::create([
            'name' => 'Mahmud',
            'role_bn' => 'প্রতিষ্ঠাতা ও লিড ডেভেলপার',
            'role_en' => 'Founder & Lead Developer',
            'bio_bn' => '৫+ বছরের এক্সপেরিয়েন্সে ওয়েব ডেভেলপমেন্ট ও এজেন্সি ম্যানেজমেন্ট।',
            'bio_en' => '5+ years of web development and agency management experience.',
            'email' => 'hello@mahmudsupport.xyz',
            'sort' => 0,
        ]);

        $certificates = [
            ['Google Digital Marketing', 'Google', '2023'],
            ['Meta Certified Marketing', 'Meta', '2024'],
        ];
        foreach ($certificates as $i => [$title, $issuer, $year]) {
            Certificate::create([
                'title_bn' => $title,
                'title_en' => $title,
                'issuer' => $issuer,
                'issued_at' => $year . '-01-15',
                'sort' => $i,
            ]);
        }

        $testimonials = [
            ['আহমেদ রহমান', 'ব্যবসায়ী', 'ভাই কিচেন', 'মার্কেটিং ফানেল সেটআপের পর বিক্রি ক্রমেই বাড়ছে। রেজাল্ট বাস্তব, রিপোর্টও স্বচ্ছ।', 5],
            ['সারাত জাহান', 'CEO', 'Cartify BD', 'পেমেন্ট ও ডেভেলপমেন্ট দুইটাই প্রফেশনাল। জটিল কাজ সহজভাবে বুঝিয়ে দেন।', 5],
        ];
        foreach ($testimonials as $i => [$name, $role, $company, $text, $rating]) {
            Testimonial::create([
                'name' => $name,
                'role' => $role,
                'company' => $company,
                'text_bn' => $text,
                'text_en' => $text,
                'rating' => $rating,
                'sort' => $i,
            ]);
        }

        $faqs = [
            ['কাজ শুরু করতে কী লাগবে?', 'প্রথমে ফ্রি কনসালটেন্সি নিন। রিকোয়ারমেন্ট বুঝে টাইমলাইন ও কোটেশন দেওয়া হবে।'],
            ['পেমেন্ট কীভাবে হয়?', 'বিকাশ/নগদে পেমেন্ট করে ভাউচার পেজ থেকে WhatsApp-এ কনফার্ম করেন। অ্যাডমিন অ্যাপ্রুভ করলে ইনভয়েস আপডেট হয়।'],
            ['কাজের আপডেট কীভাবে পাব?', 'প্রতিটা ক্লায়েন্ট পাবেন লগইন-নির্ভর ড্যাশবোর্ড — প্রজেক্ট, ইনভয়েস ও পেমেন্ট সব এক জায়গায়।'],
            ['কাস্টম ওয়েবসাইটে কত সময় লাগে?', 'সাধারণ পোর্টফোলিও সাইট ৩-৭ দিন, ড্যাশবোর্ড ও পেমেন্টসহ প্ল্যাটফর্ম ২-৪ সপ্তাহ।'],
        ];
        foreach ($faqs as $i => [$q, $a]) {
            Faq::create([
                'question_bn' => $q,
                'question_en' => $q,
                'answer_bn' => $a,
                'answer_en' => $a,
                'sort' => $i,
            ]);
        }

        $stats = [
            ['সম্পন্ন প্রজেক্ট', 'Projects Completed', '100+'],
            ['সন্তুষ্ট ক্লায়েন্ট', 'Happy Clients', '80+'],
            ['বছরের অভিজ্ঞতা', 'Years of Experience', '5+'],
            ['সাপোর্ট চ্যাট', 'Support Chats', '1000+'],
        ];
        foreach ($stats as $i => [$bn, $en, $value]) {
            Stat::create(['label_bn' => $bn, 'label_en' => $en, 'value' => $value, 'sort' => $i]);
        }

        $posts = [
            ['ছোট বিজনেসের জন্য ৭টি ডিজিটাল মার্কেটিং টিপস', 'digital-marketing-tips', 'ডিজিটাল মার্কেটিং', 'Digital Marketing',
                'ছোট বাজেটে শুরু করার সহজ ৭টি মার্কেটিং কৌশল।'],
            ['লারাভেল ওয়েবসাইট কেন এসইও-তে ভালো করে?', 'laravel-seo', 'ওয়েব ডেভেলপমেন্ট', 'Web Development',
                'দ্রুতগতি ও ক্লিন কোড কীভাবে র‍্যাঙ্কিং বাড়ায়।'],
            ['WhatsApp অটোমেশনে লিড কনভার্সন বাড়ান', 'whatsapp-automation', 'অটোমেশন', 'Automation',
                'অটো ফলো-আপ দিয়ে হারানো লিড ফিরিয়ে আনুন।'],
        ];
        foreach ($posts as $i => [$title, $slug, $cat, $catEn, $excerpt]) {
            Post::create([
                'title_bn' => $title,
                'title_en' => $title,
                'slug' => $slug,
                'category_bn' => $cat,
                'category_en' => $catEn,
                'excerpt_bn' => $excerpt,
                'excerpt_en' => $excerpt,
                'content_bn' => $excerpt . "\n\n" . 'বিস্তারিত পরামর্শের জন্য আমাদের সাথে যোগাযোগ করুন।',
                'content_en' => $excerpt . "\n\n" . 'Contact us for a detailed consultation.',
                'published_at' => now()->subDays(($i + 1) * 7),
            ]);
        }

        Page::create([
            'slug' => 'about',
            'title_bn' => 'আমাদের সম্পর্কে',
            'title_en' => 'About Us',
            'content_bn' => 'আমরা একটি এজেন্সি-টাইপ পার্সোনাল টিম — ওয়েব ডেভেলপমেন্ট, মার্কেটিং ও অটোমেশনে বিশেষজ্ঞ।',
            'content_en' => 'We are an agency-type personal team specializing in web development, marketing and automation.',
        ]);
    }
}
