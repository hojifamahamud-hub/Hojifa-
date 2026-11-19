<?php

namespace App\Http\Controllers\Admin;

class CalculatorItemController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\CalculatorItem::class;
    }

    protected function title(): string
    {
        return 'ক্যালকুলেটর সার্ভিস';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name_bn', 'label_bn' => 'সার্ভিসের নাম (বাংলা)', 'label_en' => 'Service name (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'name_en', 'label_bn' => 'সার্ভিসের নাম (ইংরেজি)', 'label_en' => 'Service name (EN)', 'type' => 'text'],
            ['name' => 'category_bn', 'label_bn' => 'ক্যাটাগরি (বাংলা) — যেমন: SEO', 'label_en' => 'Category (BN) — e.g. SEO', 'type' => 'text'],
            ['name' => 'category_en', 'label_bn' => 'ক্যাটাগরি (ইংরেজি)', 'label_en' => 'Category (EN)', 'type' => 'text'],
            ['name' => 'price', 'label_bn' => 'দাম ($)', 'label_en' => 'Price ($)', 'type' => 'number', 'required' => true],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
