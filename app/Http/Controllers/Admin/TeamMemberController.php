<?php

namespace App\Http\Controllers\Admin;

class TeamMemberController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\TeamMember::class;
    }

    protected function title(): string
    {
        return 'টিম মেম্বার';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label_bn' => 'নাম', 'label_en' => 'Name', 'type' => 'text', 'required' => true],
            ['name' => 'role_bn', 'label_bn' => 'পদবি (বাংলা)', 'label_en' => 'Role (BN)', 'type' => 'text'],
            ['name' => 'role_en', 'label_bn' => 'পদবি (ইংরেজি)', 'label_en' => 'Role (EN)', 'type' => 'text'],
            ['name' => 'photo', 'label_bn' => 'ছবি', 'label_en' => 'Photo', 'type' => 'image'],
            ['name' => 'bio_bn', 'label_bn' => 'জীবনবৃত্তান্ত (বাংলা)', 'label_en' => 'Bio (BN)', 'type' => 'textarea'],
            ['name' => 'bio_en', 'label_bn' => 'জীবনবৃত্তান্ত (ইংরেজি)', 'label_en' => 'Bio (EN)', 'type' => 'textarea'],
            ['name' => 'email', 'label_bn' => 'ইমেইল', 'label_en' => 'Email', 'type' => 'text'],
            ['name' => 'phone', 'label_bn' => 'ফোন', 'label_en' => 'Phone', 'type' => 'text'],
            ['name' => 'socials', 'label_bn' => 'সোশ্যাল লিংক (প্রতি লাইনে একটি URL)', 'label_en' => 'Socials (one URL per line)', 'type' => 'json'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
