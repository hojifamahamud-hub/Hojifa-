<?php

namespace App\Http\Controllers\Admin;

class PortfolioCategoryController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\PortfolioCategory::class;
    }

    protected function title(): string
    {
        return 'পোর্টফোলিও ক্যাটাগরি';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name_bn', 'label_bn' => 'নাম (বাংলা)', 'label_en' => 'Name (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'name_en', 'label_bn' => 'নাম (ইংরেজি)', 'label_en' => 'Name (EN)', 'type' => 'text'],
            ['name' => 'slug', 'label_bn' => 'স্লাগ (খালি রাখলে অটো)', 'label_en' => 'Slug (auto)', 'type' => 'text'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
