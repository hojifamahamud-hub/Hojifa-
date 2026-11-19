<?php

namespace App\Http\Controllers\Admin;

class ResponsibilityController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Responsibility::class;
    }

    protected function title(): string
    {
        return 'আমাদের রেসপন্সিবিলিটি';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title_bn', 'label_bn' => 'শিরোনাম (বাংলা)', 'label_en' => 'Title (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'title_en', 'label_bn' => 'শিরোনাম (ইংরেজি)', 'label_en' => 'Title (EN)', 'type' => 'text'],
            ['name' => 'icon', 'label_bn' => 'আইকন (emoji)', 'label_en' => 'Icon (emoji)', 'type' => 'text'],
            ['name' => 'description_bn', 'label_bn' => 'বিবরণ (বাংলা)', 'label_en' => 'Description (BN)', 'type' => 'textarea'],
            ['name' => 'description_en', 'label_bn' => 'বিবরণ (ইংরেজি)', 'label_en' => 'Description (EN)', 'type' => 'textarea'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
