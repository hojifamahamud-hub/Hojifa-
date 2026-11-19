<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->text('content_bn')->nullable();
            $table->text('content_en')->nullable();
            $table->string('meta_title_bn')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_desc_bn')->nullable();
            $table->text('meta_desc_en')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title_bn');
            $table->string('title_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->text('description_en')->nullable();
            $table->string('icon')->nullable();
            $table->json('features')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->string('category_bn')->nullable();
            $table->string('category_en')->nullable();
            $table->unsignedTinyInteger('level')->default(80);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('responsibilities', function (Blueprint $table) {
            $table->id();
            $table->string('title_bn');
            $table->string('title_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->text('description_en')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('portfolio_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title_bn');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->text('description_bn')->nullable();
            $table->text('description_en')->nullable();
            $table->json('before_after')->nullable();
            $table->json('metrics')->nullable();
            $table->string('live_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_bn')->nullable();
            $table->string('role_en')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio_bn')->nullable();
            $table->text('bio_en')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->json('socials')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title_bn');
            $table->string('title_en')->nullable();
            $table->string('issuer')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->date('issued_at')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('company')->nullable();
            $table->string('photo')->nullable();
            $table->text('text_bn')->nullable();
            $table->text('text_en')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question_bn');
            $table->string('question_en')->nullable();
            $table->text('answer_bn')->nullable();
            $table->text('answer_en')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('label_bn');
            $table->string('label_en')->nullable();
            $table->string('value');
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_bn');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('category_bn')->nullable();
            $table->string('category_en')->nullable();
            $table->text('excerpt_bn')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_bn')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title_bn')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_desc_bn')->nullable();
            $table->text('meta_desc_en')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('consult');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('source')->nullable();
            $table->unsignedInteger('visits')->default(1);
            $table->timestamp('first_visited_at')->nullable();
            $table->timestamp('last_visited_at')->nullable();
            $table->timestamps();
        });

        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('type')->default('live');
            $table->boolean('unread')->default(true);
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->cascadeOnDelete();
            $table->string('sender')->default('visitor');
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignee_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('assigned');
            $table->unsignedTinyInteger('progress')->default(0);
            $table->date('due_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('member_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('client_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('budget', 12, 2)->default(0);
            $table->string('status')->default('pending');
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('number')->unique();
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->string('currency', 3)->default('BDT');
            $table->string('status')->default('unpaid');
            $table->text('note')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('method')->default('bkash');
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('sender_number')->nullable();
            $table->string('trx_id')->nullable();
            $table->string('voucher_no')->unique();
            $table->string('status')->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['payments', 'invoices', 'client_projects', 'tasks', 'messages', 'conversations',
                  'visitors', 'leads', 'posts', 'stats', 'faqs', 'testimonials', 'certificates',
                  'team_members', 'project_images', 'projects', 'portfolio_categories',
                  'responsibilities', 'skills', 'services', 'pages', 'settings'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
