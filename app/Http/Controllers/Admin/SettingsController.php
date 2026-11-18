<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public const GROUPS = ['brand', 'hero', 'contact', 'popup', 'payment', 'ai', 'seo', 'footer'];

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
            $key = $field['key'];
            $type = $field['type'];

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
