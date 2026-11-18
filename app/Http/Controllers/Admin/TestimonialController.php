<?php

namespace App\Http\Controllers\Admin;

class TestimonialController extends CrudController
{
    protected function model(): string
    {
        return \App\Models\Testimonial::class;
    }

    protected function title(): string
    {
        return 'টেস্টিমোনিয়াল';
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label_bn' => 'নাম', 'label_en' => 'Name', 'type' => 'text', 'required' => true],
            ['name' => 'role', 'label_bn' => 'পদবি', 'label_en' => 'Role', 'type' => 'text'],
            ['name' => 'company', 'label_bn' => 'কোম্পানি', 'label_en' => 'Company', 'type' => 'text'],
            ['name' => 'photo', 'label_bn' => 'ছবি', 'label_en' => 'Photo', 'type' => 'image'],
            ['name' => 'text_bn', 'label_bn' => 'মন্তব্য (বাংলা)', 'label_en' => 'Text (BN)', 'type' => 'textarea'],
            ['name' => 'text_en', 'label_bn' => 'মন্তব্য (ইংরেজি)', 'label_en' => 'Text (EN)', 'type' => 'textarea'],
            ['name' => 'rating', 'label_bn' => 'রেটিং (১-৫)', 'label_en' => 'Rating (1-5)', 'type' => 'number'],
            ['name' => 'sort', 'label_bn' => 'সর্ট', 'label_en' => 'Sort', 'type' => 'number'],
            ['name' => 'active', 'label_bn' => 'দৃশ্যমান', 'label_en' => 'Active', 'type' => 'boolean'],
        ];
    }
}
