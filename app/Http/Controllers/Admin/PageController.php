<?php

namespace App\Http\Controllers\Admin;

class PageController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Page::class;
    }

    protected function title(): string
    {
        return 'স্ট্যাটিক পেজ';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title_bn', 'label_bn' => 'শিরোনাম (বাংলা)', 'label_en' => 'Title (BN)', 'type' => 'text'],
            ['name' => 'title_en', 'label_bn' => 'শিরোনাম (ইংরেজি)', 'label_en' => 'Title (EN)', 'type' => 'text'],
            ['name' => 'slug', 'label_bn' => 'স্লাগ (ইংরেজি, আবশ্যক)', 'label_en' => 'Slug (required)', 'type' => 'text', 'required' => true],
            ['name' => 'content_bn', 'label_bn' => 'কনটেন্ট (বাংলা)', 'label_en' => 'Content (BN)', 'type' => 'textarea'],
            ['name' => 'content_en', 'label_bn' => 'কনটেন্ট (ইংরেজি)', 'label_en' => 'Content (EN)', 'type' => 'textarea'],
            ['name' => 'meta_title_bn', 'label_bn' => 'SEO শিরোনাম (বাংলা)', 'label_en' => 'Meta title (BN)', 'type' => 'text'],
            ['name' => 'meta_title_en', 'label_bn' => 'SEO শিরোনাম (ইংরেজি)', 'label_en' => 'Meta title (EN)', 'type' => 'text'],
            ['name' => 'meta_desc_bn', 'label_bn' => 'SEO বিবরণ (বাংলা)', 'label_en' => 'Meta description (BN)', 'type' => 'textarea'],
            ['name' => 'meta_desc_en', 'label_bn' => 'SEO বিবরণ (ইংরেজি)', 'label_en' => 'Meta description (EN)', 'type' => 'textarea'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
