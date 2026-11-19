<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public const GROUPS = ['brand', 'hero', 'home', 'pricing', 'contact', 'popup', 'payment', 'ai', 'seo', 'footer'];

    public const FIELDS = [
        ['group' => 'brand', 'key' => 'site_name_bn', 'type' => 'text', 'label_bn' => 'সাইটের নাম (বাংলা)', 'label_en' => 'Site name (BN)'],
        ['group' => 'brand', 'key' => 'site_name_en', 'type' => 'text', 'label_bn' => 'সাইটের নাম (ইংরেজি)', 'label_en' => 'Site name (EN)'],
        ['group' => 'brand', 'key' => 'tagline_bn', 'type' => 'text', 'label_bn' => 'ট্যাগলাইন (বাংলা)', 'label_en' => 'Tagline (BN)'],
        ['group' => 'brand', 'key' => 'tagline_en', 'type' => 'text', 'label_bn' => 'ট্যাগলাইন (ইংরেজি)', 'label_en' => 'Tagline (EN)'],
        ['group' => 'brand', 'key' => 'logo', 'type' => 'image', 'label_bn' => 'লোগো', 'label_en' => 'Logo'],
        ['group' => 'brand', 'key' => 'favicon', 'type' => 'image', 'label_bn' => 'ফেভিকন', 'label_en' => 'Favicon'],

        ['group' => 'hero', 'key' => 'hero_badge_bn', 'type' => 'text', 'label_bn' => 'হিরো ব্যাজ (বাংলা)', 'label_en' => 'Hero badge (BN)'],
        ['group' => 'hero', 'key' => 'hero_badge_en', 'type' => 'text', 'label_bn' => 'হিরো ব্যাজ (ইংরেজি)', 'label_en' => 'Hero badge (EN)'],
        ['group' => 'hero', 'key' => 'hero_title_bn', 'type' => 'text', 'label_bn' => 'হিরো শিরোনাম (বাংলা)', 'label_en' => 'Hero title (BN)'],
        ['group' => 'hero', 'key' => 'hero_title_en', 'type' => 'text', 'label_bn' => 'হিরো শিরোনাম (ইংরেজি)', 'label_en' => 'Hero title (EN)'],
        ['group' => 'hero', 'key' => 'hero_subtitle_bn', 'type' => 'textarea', 'label_bn' => 'হিরো উপশিরোনাম (বাংলা)', 'label_en' => 'Hero subtitle (BN)'],
        ['group' => 'hero', 'key' => 'hero_subtitle_en', 'type' => 'textarea', 'label_bn' => 'হিরো উপশিরোনাম (ইংরেজি)', 'label_en' => 'Hero subtitle (EN)'],
        ['group' => 'hero', 'key' => 'hero_cta_bn', 'type' => 'text', 'label_bn' => 'হিরো বাটন লেখা (বাংলা)', 'label_en' => 'Hero CTA label (BN)'],
        ['group' => 'hero', 'key' => 'hero_cta_en', 'type' => 'text', 'label_bn' => 'হিরো বাটন লেখা (ইংরেজি)', 'label_en' => 'Hero CTA label (EN)'],
        ['group' => 'hero', 'key' => 'hero_cta_url', 'type' => 'text', 'label_bn' => 'হিরো বাটন লিংক', 'label_en' => 'Hero CTA URL'],

        ['group' => 'home', 'key' => 'hero_eyebrow_bn', 'type' => 'text', 'label_bn' => 'হিরো উপরের ছোট লেখা (বাংলা)', 'label_en' => 'Hero eyebrow (BN)'],
        ['group' => 'home', 'key' => 'hero_eyebrow_en', 'type' => 'text', 'label_bn' => 'হিরো উপরের ছোট লেখা (ইংরেজি)', 'label_en' => 'Hero eyebrow (EN)'],
        ['group' => 'home', 'key' => 'hero_role_bn', 'type' => 'text', 'label_bn' => 'হিরো পদবি (বাংলা) — যেমন: ডিজিটাল মার্কেটিং এক্সপার্ট', 'label_en' => 'Hero role (BN)'],
        ['group' => 'home', 'key' => 'hero_role_en', 'type' => 'text', 'label_bn' => 'হিরো পদবি (ইংরেজি)', 'label_en' => 'Hero role (EN)'],
        ['group' => 'home', 'key' => 'hero_tags', 'type' => 'textarea', 'label_bn' => 'হিরো ট্যাগ (প্রতি লাইনে একটি) — SEO / SOCIAL MEDIA / BRANDING', 'label_en' => 'Hero tags (one per line)'],
        ['group' => 'home', 'key' => 'hero_image', 'type' => 'image', 'label_bn' => 'হিরো ছবি (খালি রাখলে SVG পোর্ট্রেট দেখাবে)', 'label_en' => 'Hero image (blank = SVG portrait)'],
        ['group' => 'home', 'key' => 'platforms', 'type' => 'textarea', 'label_bn' => 'প্ল্যাটফর্ম স্ট্রিপ (প্রতি লাইনে একটি)', 'label_en' => 'Platforms strip (one per line)'],
        ['group' => 'home', 'key' => 'about_heading_bn', 'type' => 'text', 'label_bn' => 'About শিরোনাম (বাংলা)', 'label_en' => 'About heading (BN)'],
        ['group' => 'home', 'key' => 'about_heading_en', 'type' => 'text', 'label_bn' => 'About শিরোনাম (ইংরেজি)', 'label_en' => 'About heading (EN)'],
        ['group' => 'home', 'key' => 'video_embed', 'type' => 'text', 'label_bn' => 'ভিডিও এমবেড URL (YouTube হলে ভিডিও দেখাবে)', 'label_en' => 'Video embed URL (shows player if YouTube)'],
        ['group' => 'home', 'key' => 'show_calculator', 'type' => 'boolean', 'label_bn' => 'হোমপেজে প্রাইসিং ক্যালকুলেটর দেখান', 'label_en' => 'Show pricing calculator on homepage'],
        ['group' => 'home', 'key' => 'show_meeting', 'type' => 'boolean', 'label_bn' => 'হোমপেজে মিটিং বুকিং দেখান', 'label_en' => 'Show meeting booking on homepage'],
        ['group' => 'home', 'key' => 'show_newsletter', 'type' => 'boolean', 'label_bn' => 'হোমপেজে নিউজলেটার দেখান', 'label_en' => 'Show newsletter on homepage'],
        ['group' => 'home', 'key' => 'show_faqs', 'type' => 'boolean', 'label_bn' => 'হোমপেজে FAQ দেখান', 'label_en' => 'Show FAQ on homepage'],

        ['group' => 'pricing', 'key' => 'currency', 'type' => 'text', 'label_bn' => 'মুদ্রা প্রতীক ($ / ৳)', 'label_en' => 'Currency symbol ($ / ৳)'],
        ['group' => 'pricing', 'key' => 'calc_discount_percent', 'type' => 'number', 'label_bn' => 'বান্ডেল ডিসকাউন্ট (%)', 'label_en' => 'Bundle discount (%)'],
        ['group' => 'pricing', 'key' => 'calc_discount_min_items', 'type' => 'number', 'label_bn' => 'ডিসকাউন্ট পেতে ন্যূনতম সার্ভিস সংখ্যা', 'label_en' => 'Min services for discount'],
        ['group' => 'pricing', 'key' => 'meeting_options', 'type' => 'textarea', 'label_bn' => 'মিটিং অপশন — ফরম্যাট: টাইটেল | বিবরণ | দাম (প্রতি লাইনে একটি)', 'label_en' => 'Meeting options — format: Title | description | price (one per line)'],

        ['group' => 'home', 'key' => 'sec_head', 'type' => 'heading', 'label_bn' => 'সেকশন শিরোনাম ও সাবটেক্সট — খালি রাখলে ডিফল্ট দেখাবে'],
        ['group' => 'home', 'key' => 'sec_achievements_title_bn', 'type' => 'text', 'label_bn' => 'Achievements শিরোনাম (বাংলা)', 'label_en' => 'Achievements title (BN)'],
        ['group' => 'home', 'key' => 'sec_achievements_title_en', 'type' => 'text', 'label_bn' => 'Achievements শিরোনাম (ইংরেজি)', 'label_en' => 'Achievements title (EN)'],
        ['group' => 'home', 'key' => 'sec_achievements_intro_bn', 'type' => 'textarea', 'label_bn' => 'Achievements সাবটেক্সট (বাংলা)', 'label_en' => 'Achievements intro (BN)'],
        ['group' => 'home', 'key' => 'sec_achievements_intro_en', 'type' => 'textarea', 'label_bn' => 'Achievements সাবটেক্সট (ইংরেজি)', 'label_en' => 'Achievements intro (EN)'],
        ['group' => 'home', 'key' => 'sec_skills_title_bn', 'type' => 'text', 'label_bn' => 'Skills শিরোনাম (বাংলা)', 'label_en' => 'Skills title (BN)'],
        ['group' => 'home', 'key' => 'sec_skills_title_en', 'type' => 'text', 'label_bn' => 'Skills শিরোনাম (ইংরেজি)', 'label_en' => 'Skills title (EN)'],
        ['group' => 'home', 'key' => 'sec_skills_intro_bn', 'type' => 'textarea', 'label_bn' => 'Skills সাবটেক্সট (বাংলা)', 'label_en' => 'Skills intro (BN)'],
        ['group' => 'home', 'key' => 'sec_skills_intro_en', 'type' => 'textarea', 'label_bn' => 'Skills সাবটেক্সট (ইংরেজি)', 'label_en' => 'Skills intro (EN)'],
        ['group' => 'home', 'key' => 'sec_services_title_bn', 'type' => 'text', 'label_bn' => 'Services শিরোনাম (বাংলা)', 'label_en' => 'Services title (BN)'],
        ['group' => 'home', 'key' => 'sec_services_title_en', 'type' => 'text', 'label_bn' => 'Services শিরোনাম (ইংরেজি)', 'label_en' => 'Services title (EN)'],
        ['group' => 'home', 'key' => 'sec_services_intro_bn', 'type' => 'textarea', 'label_bn' => 'Services সাবটেক্সট (বাংলা)', 'label_en' => 'Services intro (BN)'],
        ['group' => 'home', 'key' => 'sec_services_intro_en', 'type' => 'textarea', 'label_bn' => 'Services সাবটেক্সট (ইংরেজি)', 'label_en' => 'Services intro (EN)'],
        ['group' => 'home', 'key' => 'sec_pricing_title_bn', 'type' => 'text', 'label_bn' => 'Pricing শিরোনাম (বাংলা)', 'label_en' => 'Pricing title (BN)'],
        ['group' => 'home', 'key' => 'sec_pricing_title_en', 'type' => 'text', 'label_bn' => 'Pricing শিরোনাম (ইংরেজি)', 'label_en' => 'Pricing title (EN)'],
        ['group' => 'home', 'key' => 'sec_pricing_intro_bn', 'type' => 'textarea', 'label_bn' => 'Pricing সাবটেক্সট (বাংলা)', 'label_en' => 'Pricing intro (BN)'],
        ['group' => 'home', 'key' => 'sec_pricing_intro_en', 'type' => 'textarea', 'label_bn' => 'Pricing সাবটেক্সট (ইংরেজি)', 'label_en' => 'Pricing intro (EN)'],
        ['group' => 'home', 'key' => 'sec_calc_title_bn', 'type' => 'text', 'label_bn' => 'Calculator শিরোনাম (বাংলা)', 'label_en' => 'Calculator title (BN)'],
        ['group' => 'home', 'key' => 'sec_calc_title_en', 'type' => 'text', 'label_bn' => 'Calculator শিরোনাম (ইংরেজি)', 'label_en' => 'Calculator title (EN)'],
        ['group' => 'home', 'key' => 'sec_calc_intro_bn', 'type' => 'textarea', 'label_bn' => 'Calculator সাবটেক্সট (বাংলা)', 'label_en' => 'Calculator intro (BN)'],
        ['group' => 'home', 'key' => 'sec_calc_intro_en', 'type' => 'textarea', 'label_bn' => 'Calculator সাবটেক্সট (ইংরেজি)', 'label_en' => 'Calculator intro (EN)'],
        ['group' => 'home', 'key' => 'sec_portfolio_title_bn', 'type' => 'text', 'label_bn' => 'Portfolio শিরোনাম (বাংলা)', 'label_en' => 'Portfolio title (BN)'],
        ['group' => 'home', 'key' => 'sec_portfolio_title_en', 'type' => 'text', 'label_bn' => 'Portfolio শিরোনাম (ইংরেজি)', 'label_en' => 'Portfolio title (EN)'],
        ['group' => 'home', 'key' => 'sec_portfolio_intro_bn', 'type' => 'textarea', 'label_bn' => 'Portfolio সাবটেক্সট (বাংলা)', 'label_en' => 'Portfolio intro (BN)'],
        ['group' => 'home', 'key' => 'sec_portfolio_intro_en', 'type' => 'textarea', 'label_bn' => 'Portfolio সাবটেক্সট (ইংরেজি)', 'label_en' => 'Portfolio intro (EN)'],
        ['group' => 'home', 'key' => 'sec_case_title_bn', 'type' => 'text', 'label_bn' => 'Case Studies শিরোনাম (বাংলা)', 'label_en' => 'Case Studies title (BN)'],
        ['group' => 'home', 'key' => 'sec_case_title_en', 'type' => 'text', 'label_bn' => 'Case Studies শিরোনাম (ইংরেজি)', 'label_en' => 'Case Studies title (EN)'],
        ['group' => 'home', 'key' => 'sec_case_intro_bn', 'type' => 'textarea', 'label_bn' => 'Case Studies সাবটেক্সট (বাংলা)', 'label_en' => 'Case Studies intro (BN)'],
        ['group' => 'home', 'key' => 'sec_case_intro_en', 'type' => 'textarea', 'label_bn' => 'Case Studies সাবটেক্সট (ইংরেজি)', 'label_en' => 'Case Studies intro (EN)'],
        ['group' => 'home', 'key' => 'sec_testi_title_bn', 'type' => 'text', 'label_bn' => 'Testimonials শিরোনাম (বাংলা)', 'label_en' => 'Testimonials title (BN)'],
        ['group' => 'home', 'key' => 'sec_testi_title_en', 'type' => 'text', 'label_bn' => 'Testimonials শিরোনাম (ইংরেজি)', 'label_en' => 'Testimonials title (EN)'],
        ['group' => 'home', 'key' => 'sec_testi_intro_bn', 'type' => 'textarea', 'label_bn' => 'Testimonials সাবটেক্সট (বাংলা)', 'label_en' => 'Testimonials intro (BN)'],
        ['group' => 'home', 'key' => 'sec_testi_intro_en', 'type' => 'textarea', 'label_bn' => 'Testimonials সাবটেক্সট (ইংরেজি)', 'label_en' => 'Testimonials intro (EN)'],
        ['group' => 'home', 'key' => 'sec_video_title_bn', 'type' => 'text', 'label_bn' => 'Video শিরোনাম (বাংলা)', 'label_en' => 'Video title (BN)'],
        ['group' => 'home', 'key' => 'sec_video_title_en', 'type' => 'text', 'label_bn' => 'Video শিরোনাম (ইংরেজি)', 'label_en' => 'Video title (EN)'],
        ['group' => 'home', 'key' => 'sec_video_intro_bn', 'type' => 'textarea', 'label_bn' => 'Video সাবটেক্সট (বাংলা)', 'label_en' => 'Video intro (BN)'],
        ['group' => 'home', 'key' => 'sec_video_intro_en', 'type' => 'textarea', 'label_bn' => 'Video সাবটেক্সট (ইংরেজি)', 'label_en' => 'Video intro (EN)'],
        ['group' => 'home', 'key' => 'sec_insights_title_bn', 'type' => 'text', 'label_bn' => 'Insights শিরোনাম (বাংলা)', 'label_en' => 'Insights title (BN)'],
        ['group' => 'home', 'key' => 'sec_insights_title_en', 'type' => 'text', 'label_bn' => 'Insights শিরোনাম (ইংরেজি)', 'label_en' => 'Insights title (EN)'],
        ['group' => 'home', 'key' => 'sec_insights_intro_bn', 'type' => 'textarea', 'label_bn' => 'Insights সাবটেক্সট (বাংলা)', 'label_en' => 'Insights intro (BN)'],
        ['group' => 'home', 'key' => 'sec_insights_intro_en', 'type' => 'textarea', 'label_bn' => 'Insights সাবটেক্সট (ইংরেজি)', 'label_en' => 'Insights intro (EN)'],
        ['group' => 'home', 'key' => 'sec_faq_title_bn', 'type' => 'text', 'label_bn' => 'FAQ শিরোনাম (বাংলা)', 'label_en' => 'FAQ title (BN)'],
        ['group' => 'home', 'key' => 'sec_faq_title_en', 'type' => 'text', 'label_bn' => 'FAQ শিরোনাম (ইংরেজি)', 'label_en' => 'FAQ title (EN)'],
        ['group' => 'home', 'key' => 'sec_faq_intro_bn', 'type' => 'textarea', 'label_bn' => 'FAQ সাবটেক্সট (বাংলা)', 'label_en' => 'FAQ intro (BN)'],
        ['group' => 'home', 'key' => 'sec_faq_intro_en', 'type' => 'textarea', 'label_bn' => 'FAQ সাবটেক্সট (ইংরেজি)', 'label_en' => 'FAQ intro (EN)'],
        ['group' => 'home', 'key' => 'sec_meeting_title_bn', 'type' => 'text', 'label_bn' => 'Meeting শিরোনাম (বাংলা)', 'label_en' => 'Meeting title (BN)'],
        ['group' => 'home', 'key' => 'sec_meeting_title_en', 'type' => 'text', 'label_bn' => 'Meeting শিরোনাম (ইংরেজি)', 'label_en' => 'Meeting title (EN)'],
        ['group' => 'home', 'key' => 'sec_meeting_intro_bn', 'type' => 'textarea', 'label_bn' => 'Meeting সাবটেক্সট (বাংলা)', 'label_en' => 'Meeting intro (BN)'],
        ['group' => 'home', 'key' => 'sec_meeting_intro_en', 'type' => 'textarea', 'label_bn' => 'Meeting সাবটেক্সট (ইংরেজি)', 'label_en' => 'Meeting intro (EN)'],
        ['group' => 'home', 'key' => 'sec_news_title_bn', 'type' => 'text', 'label_bn' => 'Newsletter শিরোনাম (বাংলা)', 'label_en' => 'Newsletter title (BN)'],
        ['group' => 'home', 'key' => 'sec_news_title_en', 'type' => 'text', 'label_bn' => 'Newsletter শিরোনাম (ইংরেজি)', 'label_en' => 'Newsletter title (EN)'],
        ['group' => 'home', 'key' => 'sec_news_intro_bn', 'type' => 'textarea', 'label_bn' => 'Newsletter সাবটেক্সট (বাংলা)', 'label_en' => 'Newsletter intro (BN)'],
        ['group' => 'home', 'key' => 'sec_news_intro_en', 'type' => 'textarea', 'label_bn' => 'Newsletter সাবটেক্সট (ইংরেজি)', 'label_en' => 'Newsletter intro (EN)'],
        ['group' => 'home', 'key' => 'sec_contact_title_bn', 'type' => 'text', 'label_bn' => 'Contact শিরোনাম (বাংলা)', 'label_en' => 'Contact title (BN)'],
        ['group' => 'home', 'key' => 'sec_contact_title_en', 'type' => 'text', 'label_bn' => 'Contact শিরোনাম (ইংরেজি)', 'label_en' => 'Contact title (EN)'],
        ['group' => 'home', 'key' => 'sec_contact_intro_bn', 'type' => 'textarea', 'label_bn' => 'Contact সাবটেক্সট (বাংলা)', 'label_en' => 'Contact intro (BN)'],
        ['group' => 'home', 'key' => 'sec_contact_intro_en', 'type' => 'textarea', 'label_bn' => 'Contact সাবটেক্সট (ইংরেজি)', 'label_en' => 'Contact intro (EN)'],
        ['group' => 'home', 'key' => 'about_head', 'type' => 'heading', 'label_bn' => 'About সেকশনের বিস্তারিত লেখা'],
        ['group' => 'home', 'key' => 'about_intro_bn', 'type' => 'textarea', 'label_bn' => 'About সাবটেক্সট (বাংলা)', 'label_en' => 'About intro (BN)'],
        ['group' => 'home', 'key' => 'about_intro_en', 'type' => 'textarea', 'label_bn' => 'About সাবটেক্সট (ইংরেজি)', 'label_en' => 'About intro (EN)'],
        ['group' => 'home', 'key' => 'about_body_bn', 'type' => 'textarea', 'label_bn' => 'About প্যারাগ্রাফ (বাংলা) — প্রতি লাইনে এক প্যারাগ্রাফ', 'label_en' => 'About paragraphs (BN), one per line'],
        ['group' => 'home', 'key' => 'about_body_en', 'type' => 'textarea', 'label_bn' => 'About প্যারাগ্রাফ (ইংরেজি) — প্রতি লাইনে এক প্যারাগ্রাফ', 'label_en' => 'About paragraphs (EN), one per line'],
        ['group' => 'home', 'key' => 'about_drives_bn', 'type' => 'textarea', 'label_bn' => 'What drives me চেক আইটেম (বাংলা) — প্রতি লাইনে একটি', 'label_en' => 'What drives me items (BN), one per line'],
        ['group' => 'home', 'key' => 'about_drives_en', 'type' => 'textarea', 'label_bn' => 'What drives me চেক আইটেম (ইংরেজি) — প্রতি লাইনে একটি', 'label_en' => 'What drives me items (EN), one per line'],
        ['group' => 'home', 'key' => 'banner_head', 'type' => 'heading', 'label_bn' => 'CTA ব্যানার (Services ও Portfolio-র নিচে)'],
        ['group' => 'home', 'key' => 'services_banner_title_bn', 'type' => 'text', 'label_bn' => 'Services ব্যানার শিরোনাম (বাংলা)', 'label_en' => 'Services banner title (BN)'],
        ['group' => 'home', 'key' => 'services_banner_title_en', 'type' => 'text', 'label_bn' => 'Services ব্যানার শিরোনাম (ইংরেজি)', 'label_en' => 'Services banner title (EN)'],
        ['group' => 'home', 'key' => 'services_banner_text_bn', 'type' => 'textarea', 'label_bn' => 'Services ব্যানার লেখা (বাংলা)', 'label_en' => 'Services banner text (BN)'],
        ['group' => 'home', 'key' => 'services_banner_text_en', 'type' => 'textarea', 'label_bn' => 'Services ব্যানার লেখা (ইংরেজি)', 'label_en' => 'Services banner text (EN)'],
        ['group' => 'home', 'key' => 'portfolio_banner_title_bn', 'type' => 'text', 'label_bn' => 'Portfolio ব্যানার শিরোনাম (বাংলা)', 'label_en' => 'Portfolio banner title (BN)'],
        ['group' => 'home', 'key' => 'portfolio_banner_title_en', 'type' => 'text', 'label_bn' => 'Portfolio ব্যানার শিরোনাম (ইংরেজি)', 'label_en' => 'Portfolio banner title (EN)'],
        ['group' => 'home', 'key' => 'portfolio_banner_text_bn', 'type' => 'textarea', 'label_bn' => 'Portfolio ব্যানার লেখা (বাংলা)', 'label_en' => 'Portfolio banner text (BN)'],
        ['group' => 'home', 'key' => 'portfolio_banner_text_en', 'type' => 'textarea', 'label_bn' => 'Portfolio ব্যানার লেখা (ইংরেজি)', 'label_en' => 'Portfolio banner text (EN)'],
        ['group' => 'home', 'key' => 'video_text_bn', 'type' => 'textarea', 'label_bn' => 'ভিডিও প্যানেল লেখা (বাংলা) — ভিডিও সেট না থাকলে', 'label_en' => 'Video panel text (BN) for fallback'],
        ['group' => 'home', 'key' => 'video_text_en', 'type' => 'textarea', 'label_bn' => 'ভিডিও প্যানেল লেখা (ইংরেজি)', 'label_en' => 'Video panel text (EN)'],

        ['group' => 'contact', 'key' => 'contact_email', 'type' => 'text', 'label_bn' => 'ইমেইল', 'label_en' => 'Email'],
        ['group' => 'contact', 'key' => 'contact_phone', 'type' => 'text', 'label_bn' => 'ফোন', 'label_en' => 'Phone'],
        ['group' => 'contact', 'key' => 'contact_whatsapp', 'type' => 'text', 'label_bn' => 'হোয়াটসঅ্যাপ নাম্বার (8801xxx)', 'label_en' => 'WhatsApp number (8801xxx)'],
        ['group' => 'contact', 'key' => 'address_bn', 'type' => 'text', 'label_bn' => 'ঠিকানা (বাংলা)', 'label_en' => 'Address (BN)'],
        ['group' => 'contact', 'key' => 'address_en', 'type' => 'text', 'label_bn' => 'ঠিকানা (ইংরেজি)', 'label_en' => 'Address (EN)'],
        ['group' => 'contact', 'key' => 'facebook_url', 'type' => 'text', 'label_bn' => 'ফেসবুক', 'label_en' => 'Facebook'],
        ['group' => 'contact', 'key' => 'linkedin_url', 'type' => 'text', 'label_bn' => 'লিংকডইন', 'label_en' => 'LinkedIn'],
        ['group' => 'contact', 'key' => 'github_url', 'type' => 'text', 'label_bn' => 'গিটহাব', 'label_en' => 'GitHub'],
        ['group' => 'contact', 'key' => 'youtube_url', 'type' => 'text', 'label_bn' => 'ইউটিউব', 'label_en' => 'YouTube'],
        ['group' => 'contact', 'key' => 'x_url', 'type' => 'text', 'label_bn' => 'এক্স (টুইটার)', 'label_en' => 'X (Twitter)'],

        ['group' => 'popup', 'key' => 'popup_mode', 'type' => 'select', 'options' => ['off', 'popup', 'gate'], 'label_bn' => 'ইমেইল পপআপ মোড', 'label_en' => 'Email popup mode'],
        ['group' => 'popup', 'key' => 'popup_title_bn', 'type' => 'text', 'label_bn' => 'পপআপ শিরোনাম (বাংলা)', 'label_en' => 'Popup title (BN)'],
        ['group' => 'popup', 'key' => 'popup_title_en', 'type' => 'text', 'label_bn' => 'পপআপ শিরোনাম (ইংরেজি)', 'label_en' => 'Popup title (EN)'],
        ['group' => 'popup', 'key' => 'popup_text_bn', 'type' => 'textarea', 'label_bn' => 'পপআপ লেখা (বাংলা)', 'label_en' => 'Popup text (BN)'],
        ['group' => 'popup', 'key' => 'popup_text_en', 'type' => 'textarea', 'label_bn' => 'পপআপ লেখা (ইংরেজি)', 'label_en' => 'Popup text (EN)'],

        ['group' => 'payment', 'key' => 'payment_bkash_number', 'type' => 'text', 'label_bn' => 'বিকাশ নাম্বার', 'label_en' => 'bKash number'],
        ['group' => 'payment', 'key' => 'payment_nagad_number', 'type' => 'text', 'label_bn' => 'নগদ নাম্বার', 'label_en' => 'Nagad number'],
        ['group' => 'payment', 'key' => 'payment_bank_info', 'type' => 'textarea', 'label_bn' => 'ব্যাংক/আন্তর্জাতিক পেমেন্ট তথ্য', 'label_en' => 'Bank / international payment info'],
        ['group' => 'payment', 'key' => 'payment_note_bn', 'type' => 'textarea', 'label_bn' => 'পেমেন্ট নোট (বাংলা)', 'label_en' => 'Payment note (BN)'],
        ['group' => 'payment', 'key' => 'payment_note_en', 'type' => 'textarea', 'label_bn' => 'পেমেন্ট নোট (ইংরেজি)', 'label_en' => 'Payment note (EN)'],

        ['group' => 'ai', 'key' => 'ai_enabled', 'type' => 'boolean', 'label_bn' => 'এআই অ্যাসিস্ট্যান্ট চালু', 'label_en' => 'Enable AI assistant'],
        ['group' => 'ai', 'key' => 'ai_base_url', 'type' => 'text', 'label_bn' => 'এআই বেইজ URL', 'label_en' => 'AI base URL'],
        ['group' => 'ai', 'key' => 'ai_api_key', 'type' => 'text', 'label_bn' => 'এআই API কী', 'label_en' => 'AI API key'],
        ['group' => 'ai', 'key' => 'ai_model', 'type' => 'text', 'label_bn' => 'এআই মডেল', 'label_en' => 'AI model'],
        ['group' => 'ai', 'key' => 'ai_system_prompt', 'type' => 'textarea', 'label_bn' => 'এআই সিস্টেম প্রম্পট', 'label_en' => 'AI system prompt'],

        ['group' => 'seo', 'key' => 'meta_title_bn', 'type' => 'text', 'label_bn' => 'SEO শিরোনাম (বাংলা)', 'label_en' => 'Meta title (BN)'],
        ['group' => 'seo', 'key' => 'meta_title_en', 'type' => 'text', 'label_bn' => 'SEO শিরোনাম (ইংরেজি)', 'label_en' => 'Meta title (EN)'],
        ['group' => 'seo', 'key' => 'meta_desc_bn', 'type' => 'textarea', 'label_bn' => 'SEO বিবরণ (বাংলা)', 'label_en' => 'Meta description (BN)'],
        ['group' => 'seo', 'key' => 'meta_desc_en', 'type' => 'textarea', 'label_bn' => 'SEO বিবরণ (ইংরেজি)', 'label_en' => 'Meta description (EN)'],
        ['group' => 'seo', 'key' => 'meta_keywords', 'type' => 'text', 'label_bn' => 'SEO কীওয়ার্ড', 'label_en' => 'Meta keywords'],

        ['group' => 'footer', 'key' => 'footer_text_bn', 'type' => 'textarea', 'label_bn' => 'ফুটার লেখা (বাংলা)', 'label_en' => 'Footer text (BN)'],
        ['group' => 'footer', 'key' => 'footer_text_en', 'type' => 'textarea', 'label_bn' => 'ফুটার লেখা (ইংরেজি)', 'label_en' => 'Footer text (EN)'],
    ];

    public function edit()
    {
        return view('admin.settings', [
            'fields' => self::FIELDS,
            'groups' => self::GROUPS,
        ]);
    }

    public function update(Request $request)
    {
        foreach (self::FIELDS as $field) {
            $type = $field['type'];
            $key = $field['key'] ?? null;

            if ($type === 'heading' || $key === null) {
                continue;
            }

            if ($type === 'boolean') {
                Setting::set($key, $request->boolean($key) ? '1' : '', $field['group']);
            } elseif ($type === 'image') {
                if ($request->hasFile($key)) {
                    $request->validate([$key => ['image', 'max:4096']]);
                    Setting::set($key, $request->file($key)->storePublicly('uploads', 'public'), $field['group']);
                }
            } else {
                $value = $request->input($key);
                Setting::set($key, is_array($value) ? null : $value, $field['group']);
            }
        }

        clear_settings_cache();

        return redirect()->route('admin.settings.edit')->with('success', __('site.admin.settings_saved'));
    }
}
