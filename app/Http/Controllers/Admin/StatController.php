<?php

namespace App\Http\Controllers\Admin;

class StatController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Stat::class;
    }

    protected function title(): string
    {
        return 'স্ট্যাট কার্ড';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'label_bn', 'label_bn' => 'লেবেল (বাংলা)', 'label_en' => 'Label (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'label_en', 'label_bn' => 'লেবেল (ইংরেজি)', 'label_en' => 'Label (EN)', 'type' => 'text'],
            ['name' => 'value', 'label_bn' => 'মান (যেমন: 120+)', 'label_en' => 'Value (e.g. 120+)', 'type' => 'text', 'required' => true],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
