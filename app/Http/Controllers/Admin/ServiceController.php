<?php

namespace App\Http\Controllers\Admin;

class ServiceController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Service::class;
    }

    protected function title(): string
    {
        return 'সার্ভিস';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title_bn', 'label_bn' => 'শিরোনাম (বাংলা)', 'label_en' => 'Title (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'title_en', 'label_bn' => 'শিরোনাম (ইংরেজি)', 'label_en' => 'Title (EN)', 'type' => 'text'],
            ['name' => 'slug', 'label_bn' => 'স্লাগ (খালি রাখলে অটো)', 'label_en' => 'Slug (auto)', 'type' => 'text'],
            ['name' => 'icon', 'label_bn' => 'আইকন (emoji)', 'label_en' => 'Icon (emoji)', 'type' => 'text'],
            ['name' => 'description_bn', 'label_bn' => 'বিবরণ (বাংলা)', 'label_en' => 'Description (BN)', 'type' => 'textarea'],
            ['name' => 'description_en', 'label_bn' => 'বিবরণ (ইংরেজি)', 'label_en' => 'Description (EN)', 'type' => 'textarea'],
            ['name' => 'features', 'label_bn' => 'ফিচারসমূহ (প্রতি লাইনে একটি)', 'label_en' => 'Features (one per line)', 'type' => 'json'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
