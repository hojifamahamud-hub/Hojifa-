<?php

namespace App\Http\Controllers\Admin;

class SkillController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Skill::class;
    }

    protected function title(): string
    {
        return 'স্কিল';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name_bn', 'label_bn' => 'নাম (বাংলা)', 'label_en' => 'Name (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'name_en', 'label_bn' => 'নাম (ইংরেজি)', 'label_en' => 'Name (EN)', 'type' => 'text'],
            ['name' => 'category_bn', 'label_bn' => 'ক্যাটাগরি (বাংলা)', 'label_en' => 'Category (BN)', 'type' => 'text'],
            ['name' => 'category_en', 'label_bn' => 'ক্যাটাগরি (ইংরেজি)', 'label_en' => 'Category (EN)', 'type' => 'text'],
            ['name' => 'level', 'label_bn' => 'লেভেল (০-১০০)', 'label_en' => 'Level (0-100)', 'type' => 'number'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
