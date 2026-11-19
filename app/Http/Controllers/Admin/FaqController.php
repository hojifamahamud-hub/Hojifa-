<?php

namespace App\Http\Controllers\Admin;

class FaqController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Faq::class;
    }

    protected function title(): string
    {
        return 'সাধারণ প্রশ্ন (FAQ)';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'question_bn', 'label_bn' => 'প্রশ্ন (বাংলা)', 'label_en' => 'Question (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'question_en', 'label_bn' => 'প্রশ্ন (ইংরেজি)', 'label_en' => 'Question (EN)', 'type' => 'text'],
            ['name' => 'answer_bn', 'label_bn' => 'উত্তর (বাংলা)', 'label_en' => 'Answer (BN)', 'type' => 'textarea'],
            ['name' => 'answer_en', 'label_bn' => 'উত্তর (ইংরেজি)', 'label_en' => 'Answer (EN)', 'type' => 'textarea'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
