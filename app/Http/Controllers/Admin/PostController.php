<?php

namespace App\Http\Controllers\Admin;

class PostController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Post::class;
    }

    protected function title(): string
    {
        return 'ব্লগ পোস্ট';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title_bn', 'label_bn' => 'শিরোনাম (বাংলা)', 'label_en' => 'Title (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'title_en', 'label_bn' => 'শিরোনাম (ইংরেজি)', 'label_en' => 'Title (EN)', 'type' => 'text'],
            ['name' => 'slug', 'label_bn' => 'স্লাগ (খালি রাখলে অটো)', 'label_en' => 'Slug (auto)', 'type' => 'text'],
            ['name' => 'category_bn', 'label_bn' => 'ক্যাটাগরি (বাংলা)', 'label_en' => 'Category (BN)', 'type' => 'text'],
            ['name' => 'category_en', 'label_bn' => 'ক্যাটাগরি (ইংরেজি)', 'label_en' => 'Category (EN)', 'type' => 'text'],
            ['name' => 'image', 'label_bn' => 'ছবি', 'label_en' => 'Image', 'type' => 'image'],
            ['name' => 'excerpt_bn', 'label_bn' => 'সারসংক্ষেপ (বাংলা)', 'label_en' => 'Excerpt (BN)', 'type' => 'textarea'],
            ['name' => 'excerpt_en', 'label_bn' => 'সারসংক্ষেপ (ইংরেজি)', 'label_en' => 'Excerpt (EN)', 'type' => 'textarea'],
            ['name' => 'content_bn', 'label_bn' => 'বিস্তারিত লেখা (বাংলা)', 'label_en' => 'Content (BN)', 'type' => 'textarea'],
            ['name' => 'content_en', 'label_bn' => 'বিস্তারিত লেখা (ইংরেজি)', 'label_en' => 'Content (EN)', 'type' => 'textarea'],
            ['name' => 'meta_title_bn', 'label_bn' => 'SEO শিরোনাম (বাংলা)', 'label_en' => 'Meta title (BN)', 'type' => 'text'],
            ['name' => 'meta_title_en', 'label_bn' => 'SEO শিরোনাম (ইংরেজি)', 'label_en' => 'Meta title (EN)', 'type' => 'text'],
            ['name' => 'meta_desc_bn', 'label_bn' => 'SEO বিবরণ (বাংলা)', 'label_en' => 'Meta description (BN)', 'type' => 'textarea'],
            ['name' => 'meta_desc_en', 'label_bn' => 'SEO বিবরণ (ইংরেজি)', 'label_en' => 'Meta description (EN)', 'type' => 'textarea'],
            ['name' => 'published_at', 'label_bn' => 'প্রকাশের তারিখ', 'label_en' => 'Published at', 'type' => 'date'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
