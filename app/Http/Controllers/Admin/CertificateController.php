<?php

namespace App\Http\Controllers\Admin;

class CertificateController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Certificate::class;
    }

    protected function title(): string
    {
        return 'সার্টিফিকেট';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title_bn', 'label_bn' => 'শিরোনাম (বাংলা)', 'label_en' => 'Title (BN)', 'type' => 'text', 'required' => true],
            ['name' => 'title_en', 'label_bn' => 'শিরোনাম (ইংরেজি)', 'label_en' => 'Title (EN)', 'type' => 'text'],
            ['name' => 'issuer', 'label_bn' => 'ইস্যুকারী', 'label_en' => 'Issuer', 'type' => 'text'],
            ['name' => 'image', 'label_bn' => 'ছবি', 'label_en' => 'Image', 'type' => 'image'],
            ['name' => 'url', 'label_bn' => 'ভেরিফিকেশন লিংক', 'label_en' => 'Verification URL', 'type' => 'text'],
            ['name' => 'issued_at', 'label_bn' => 'ইস্যুর তারিখ', 'label_en' => 'Issued at', 'type' => 'date'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
