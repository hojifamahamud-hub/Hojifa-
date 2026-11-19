<?php

namespace App\Http\Controllers\Admin;

class PricingPackageController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\PricingPackage::class;
    }

    protected function title(): string
    {
        return 'প্রাইসিং প্যাকেজ';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name_bn', 'label_bn' => 'প্যাকেজের নাম (বাংলা)', 'label_en' => 'Package name (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'name_en', 'label_bn' => 'প্যাকেজের নাম (ইংরেজি)', 'label_en' => 'Package name (EN)', 'type' => 'text'],
            ['name' => 'price', 'label_bn' => 'দাম (যেমন: $49)', 'label_en' => 'Price (e.g. $49)', 'type' => 'text', 'required' => true],
            ['name' => 'unit_bn', 'label_bn' => 'ইউনিট (বাংলা) — যেমন: / মাস', 'label_en' => 'Unit (BN) — e.g. / month', 'type' => 'text'],
            ['name' => 'unit_en', 'label_bn' => 'ইউনিট (ইংরেজি)', 'label_en' => 'Unit (EN)', 'type' => 'text'],
            ['name' => 'description_bn', 'label_bn' => 'সংক্ষিপ্ত বর্ণনা (বাংলা)', 'label_en' => 'Description (BN)', 'type' => 'textarea'],
            ['name' => 'description_en', 'label_bn' => 'সংক্ষিপ্ত বর্ণনা (ইংরেজি)', 'label_en' => 'Description (EN)', 'type' => 'textarea'],
            ['name' => 'features', 'label_bn' => 'ফিচারসমূহ (প্রতি লাইনে একটি)', 'label_en' => 'Features (one per line)', 'type' => 'json'],
            ['name' => 'badge_bn', 'label_bn' => 'ব্যাজ (বাংলা) — যেমন: সবচেয়ে জনপ্রিয়', 'label_en' => 'Badge (BN)', 'type' => 'text'],
            ['name' => 'badge_en', 'label_bn' => 'ব্যাজ (ইংরেজি)', 'label_en' => 'Badge (EN)', 'type' => 'text'],
            ['name' => 'featured', 'label_bn' => 'হাইলাইট করা (উঁচু কার্ড)', 'label_en' => 'Featured (raised card)', 'type' => 'boolean'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
