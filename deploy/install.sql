-- ============================================================
-- Hojifa portfolio-agency Laravel site : MySQL installer
-- cPanel → MySQL Databases → DB তৈরি করুন → phpMyAdmin → Import
-- এই ফাইলে টেবিল + ডিফল্ট সেটিংস + অ্যাডমিন ইউজার + ডেমো কন্টেন্ট আছে।
-- ইমপোর্টের পর আর `php artisan migrate` চালানোর দরকার নেই।
-- ============================================================
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL PRIMARY KEY,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  INDEX `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL,
  `cancelled_at` INT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uuid` VARCHAR(255) NOT NULL UNIQUE,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL DEFAULT 'client',
  `status` VARCHAR(255) NOT NULL DEFAULT 'active',
  `phone` VARCHAR(255) NULL,
  `skills` TEXT NULL,
  `avatar` VARCHAR(255) NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  INDEX `sessions_user_id_index` (`user_id`),
  INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(255) NOT NULL UNIQUE,
  `value` LONGTEXT NULL,
  `group` VARCHAR(255) NOT NULL DEFAULT 'general',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `pages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `title_bn` VARCHAR(255) NULL,
  `title_en` VARCHAR(255) NULL,
  `content_bn` TEXT NULL,
  `content_en` TEXT NULL,
  `meta_title_bn` VARCHAR(255) NULL,
  `meta_title_en` VARCHAR(255) NULL,
  `meta_desc_bn` TEXT NULL,
  `meta_desc_en` TEXT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `services` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title_bn` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NULL,
  `description_bn` TEXT NULL,
  `description_en` TEXT NULL,
  `icon` VARCHAR(255) NULL,
  `features` JSON NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `skills` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name_bn` VARCHAR(255) NOT NULL,
  `name_en` VARCHAR(255) NULL,
  `category_bn` VARCHAR(255) NULL,
  `category_en` VARCHAR(255) NULL,
  `level` TINYINT UNSIGNED NOT NULL DEFAULT 80,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `responsibilities` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title_bn` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NULL,
  `description_bn` TEXT NULL,
  `description_en` TEXT NULL,
  `icon` VARCHAR(255) NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `portfolio_categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name_bn` VARCHAR(255) NOT NULL,
  `name_en` VARCHAR(255) NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `projects` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `portfolio_category_id` BIGINT UNSIGNED NULL,
  `title_bn` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `client` VARCHAR(255) NULL,
  `description_bn` TEXT NULL,
  `description_en` TEXT NULL,
  `before_after` JSON NULL,
  `metrics` JSON NULL,
  `live_url` VARCHAR(255) NULL,
  `featured` TINYINT(1) NOT NULL DEFAULT 0,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `projects_portfolio_category_id_foreign` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `project_images` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `project_id` BIGINT UNSIGNED NOT NULL,
  `path` VARCHAR(255) NOT NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `team_members` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `role_bn` VARCHAR(255) NULL,
  `role_en` VARCHAR(255) NULL,
  `photo` VARCHAR(255) NULL,
  `bio_bn` TEXT NULL,
  `bio_en` TEXT NULL,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  `socials` JSON NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `certificates` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title_bn` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NULL,
  `issuer` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `issued_at` DATE NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `photo` VARCHAR(255) NULL,
  `text_bn` TEXT NULL,
  `text_en` TEXT NULL,
  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `question_bn` VARCHAR(255) NOT NULL,
  `question_en` VARCHAR(255) NULL,
  `answer_bn` TEXT NULL,
  `answer_en` TEXT NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `stats` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `label_bn` VARCHAR(255) NOT NULL,
  `label_en` VARCHAR(255) NULL,
  `value` VARCHAR(255) NOT NULL,
  `sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title_bn` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `category_bn` VARCHAR(255) NULL,
  `category_en` VARCHAR(255) NULL,
  `excerpt_bn` TEXT NULL,
  `excerpt_en` TEXT NULL,
  `content_bn` LONGTEXT NULL,
  `content_en` LONGTEXT NULL,
  `image` VARCHAR(255) NULL,
  `meta_title_bn` VARCHAR(255) NULL,
  `meta_title_en` VARCHAR(255) NULL,
  `meta_desc_bn` TEXT NULL,
  `meta_desc_en` TEXT NULL,
  `views` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `published_at` TIMESTAMP NULL DEFAULT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `leads` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `type` VARCHAR(255) NOT NULL DEFAULT 'consult',
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  `budget` VARCHAR(255) NULL,
  `timeline` VARCHAR(255) NULL,
  `message` TEXT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'new',
  `admin_notes` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `ip` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `source` VARCHAR(255) NULL,
  `visits` INT UNSIGNED NOT NULL DEFAULT 1,
  `first_visited_at` TIMESTAMP NULL DEFAULT NULL,
  `last_visited_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `visitors_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NULL,
  `name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `type` VARCHAR(255) NOT NULL DEFAULT 'live',
  `unread` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `conversation_id` BIGINT UNSIGNED NOT NULL,
  `sender` VARCHAR(255) NOT NULL DEFAULT 'visitor',
  `body` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `assignee_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'assigned',
  `progress` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `due_date` DATE NULL,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `member_notes` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `tasks_assignee_id_foreign` FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `client_projects` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `category` VARCHAR(255) NULL,
  `budget` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `due_date` DATE NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `client_projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `client_project_id` BIGINT UNSIGNED NULL,
  `number` VARCHAR(255) NOT NULL UNIQUE,
  `amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `paid_amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `currency` VARCHAR(3) NOT NULL DEFAULT 'BDT',
  `status` VARCHAR(255) NOT NULL DEFAULT 'unpaid',
  `note` TEXT NULL,
  `due_date` DATE NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_client_project_id_foreign` FOREIGN KEY (`client_project_id`) REFERENCES `client_projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `invoice_id` BIGINT UNSIGNED NOT NULL,
  `method` VARCHAR(255) NOT NULL DEFAULT 'bkash',
  `amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `sender_number` VARCHAR(255) NULL,
  `trx_id` VARCHAR(255) NULL,
  `voucher_no` VARCHAR(255) NOT NULL UNIQUE,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `approved_at` TIMESTAMP NULL DEFAULT NULL,
  `admin_note` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `phone`, `skills`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Mahmud', 'admin@mahmudsupport.xyz', '2026-11-18 06:39:22', '$2y$12$pzQa2eKhCJ21i19G8w9EVufEMJZaaPYSIwdqAo.vBap3IYjDo05uK', 'admin', 'active', NULL, NULL, NULL, NULL, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (1, 'site_name_bn', 'মাহমুদ সাপোর্ট', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (2, 'site_name_en', 'Mahmud Support', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (3, 'tagline_bn', 'ডিজিটাল গ্রোথ পার্টনার', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (4, 'tagline_en', 'Digital Growth Partner', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (5, 'hero_badge_bn', '১০০+ প্রজেক্ট সম্পন্ন', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (6, 'hero_badge_en', '100+ Projects Delivered', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (7, 'hero_title_bn', 'আপনার বিজনেসকে ডিজিটালে সবার আগে নিয়ে যান', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (8, 'hero_title_en', 'Take Your Business First in the Digital Race', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (9, 'hero_subtitle_bn', 'ওয়েব ডেভেলপমেন্ট, মার্কেটিং অটোমেশন ও এআই-চালিত সমাধানে আমরা আপনার বিশ্বস্ত পার্টনার — আইডিয়া থেকে রেজাল্ট পর্যন্ত।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (10, 'hero_subtitle_en', 'Web development, marketing automation and AI-powered solutions — from idea to measurable results.', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (11, 'hero_cta_bn', 'ফ্রি কনসালটেন্সি নিন', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (12, 'hero_cta_en', 'Get Free Consultancy', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (13, 'hero_cta_url', '/requirement', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (14, 'contact_email', 'hello@mahmudsupport.xyz', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (15, 'address_bn', 'ঢাকা, বাংলাদেশ', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (16, 'address_en', 'Dhaka, Bangladesh', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (17, 'popup_mode', 'popup', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (18, 'popup_title_bn', 'নতুন অফার ও টিপস আপনার ইনবক্সে', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (19, 'popup_title_en', 'Offers & tips in your inbox', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (20, 'popup_text_bn', 'আপনার ইমেইল দিলে নির্বাচিত ক্লায়েন্টদের জন্য বিশেষ অফার ও মার্কেটিং টিপস পাঠানো হবে।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (21, 'popup_text_en', 'Share your email to receive exclusive offers and marketing tips.', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (22, 'payment_bank_info', 'International payment: Bank transfer / PayPal (details on request)', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (23, 'payment_note_bn', 'পেমেন্ট করার পর ভাউচার পেজ থেকে WhatsApp-এ কনফার্ম করুন।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (24, 'payment_note_en', 'After paying, confirm via WhatsApp from the voucher page.', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (25, 'ai_enabled', '0', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (26, 'ai_base_url', 'https://api.mistral.ai/v1', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (27, 'ai_model', 'mistral-small-latest', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (28, 'ai_system_prompt', 'আপনি একজন ডিজিটাল মার্কেটিং কনসালট্যান্ট। ছোট ও মাঝারি বিজনেসের জন্য বাংলা ও ইংরেজিতে বাস্তবসম্মত মার্কেটিং পরিকল্পনা, চ্যানেল আইডিয়া ও কনটেন্ট সাজেশন দিন।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (29, 'meta_title_bn', 'মাহমুদ সাপোর্ট — ডিজিটাল গ্রোথ পার্টনার', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (30, 'meta_title_en', 'Mahmud Support — Digital Growth Partner', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (31, 'meta_desc_bn', 'ওয়েব ডেভেলপমেন্ট, মার্কেটিং অটোমেশন ও এআই-চালিত সমাধান। আপনার বিজনেসের জন্য আজই ফ্রি কনসালটেন্সি নিন।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (32, 'meta_desc_en', 'Web development, marketing automation & AI solutions. Book your free consultancy today.', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (33, 'footer_text_bn', 'আপনার আইডিয়াকে ডিজিটাল সফলতায় রূপান্তরে আমরা আছি পাশে।', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (34, 'footer_text_en', 'We turn your ideas into digital success.', 'general', '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'ওয়েব ডেভেলপমেন্ট', 'Web Development', 'দ্রুত, সুরক্ষিত ও এসইও-বান্ধব ওয়েবসাইট ও ওয়েব অ্যাপ্লিকেশন।', 'Fast, secure and SEO-friendly websites and web applications.', '💻', '["Laravel \\/ WordPress","SEO \\u0985\\u09aa\\u09cd\\u099f\\u09bf\\u09ae\\u09be\\u0987\\u099c\\u09c7\\u09b6\\u09a8","\\u09b2\\u0997\\u0987\\u09a8 \\u0993 \\u09a1\\u09cd\\u09af\\u09be\\u09b6\\u09ac\\u09cb\\u09b0\\u09cd\\u09a1","\\u09e7 \\u09ac\\u099b\\u09b0 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f"]', 'web-development', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'ডিজিটাল মার্কেটিং', 'Digital Marketing', 'ফেসবুক, গুগল ও লিড-ফোকাসড মার্কেটিং ক্যাম্পেইন।', 'Facebook, Google and lead-focused marketing campaigns.', '📈', '["\\u09ab\\u09c7\\u09b8\\u09ac\\u09c1\\u0995 \\u0985\\u09cd\\u09af\\u09be\\u09a1\\u09b8","\\u0997\\u09c1\\u0997\\u09b2 \\u0985\\u09cd\\u09af\\u09be\\u09a1\\u09b8","\\u09b2\\u09bf\\u09a1 \\u09ae\\u09cd\\u09af\\u09be\\u0997\\u09a8\\u09c7\\u099f","\\u09b0\\u09bf\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\\u09bf\\u0982"]', 'digital-marketing', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'মার্কেটিং অটোমেশন', 'Marketing Automation', 'নিউটন/ফ্লোআপ টুল দিয়ে অটো লিড ক্যাপচার ও ফলো-আপ।', 'Automatic lead capture and follow-up with Newton/FlowUp tools.', '⚡', '["\\u09a8\\u09bf\\u0989\\u099f\\u09a8 \\u09b8\\u09c7\\u099f\\u0986\\u09aa","\\u09ab\\u09cd\\u09b2\\u09cb\\u0986\\u09aa \\u09ac\\u099f","\\u0987\\u09ae\\u09c7\\u0987\\u09b2 \\u0985\\u099f\\u09cb\\u09ae\\u09c7\\u09b6\\u09a8","WhatsApp \\u0987\\u09a8\\u09cd\\u099f\\u09bf\\u0997\\u09cd\\u09b0\\u09c7\\u09b6\\u09a8"]', 'marketing-automation', 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'এআই সমাধান', 'AI Solutions', 'এআই চ্যাটবট, কনটেন্ট জেনারেশন ও অটোমেটেড রিসার্চ।', 'AI chatbots, content generation and automated research.', '🤖', '["AI \\u099a\\u09cd\\u09af\\u09be\\u099f\\u09ac\\u099f","\\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u099c\\u09c7\\u09a8\\u09be\\u09b0\\u09c7\\u09b6\\u09a8","\\u0993\\u09af\\u09bc\\u09c7\\u09ac \\u09b0\\u09bf\\u09b8\\u09be\\u09b0\\u09cd\\u099a","\\u0995\\u09be\\u09b8\\u09cd\\u099f\\u09ae \\u099f\\u09c1\\u09b2"]', 'ai-solutions', 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (5, 'সার্ভার ও হোস্টিং', 'Server & Hosting', 'ভিপিএস সেটআপ, ডোমেইন-সার্ভার ম্যাপিং ও অ্যাকাউন্ট ক্রিয়েশন।', 'VPS setup, domain-server mapping and account creation.', '🛡️', '["VPS \\u09b8\\u09c7\\u099f\\u0986\\u09aa","DNS \\u0995\\u09a8\\u09ab\\u09bf\\u0997\\u09be\\u09b0\\u09c7\\u09b6\\u09a8","\\u0987\\u09ae\\u09c7\\u0987\\u09b2 \\u0985\\u09cd\\u09af\\u09be\\u0995\\u09be\\u0989\\u09a8\\u09cd\\u099f","\\u09a8\\u09bf\\u09b0\\u09be\\u09aa\\u09a4\\u09cd\\u09a4\\u09be"]', 'server-hosting', 4, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `services` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `features`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (6, 'ডেটা ও লিড সার্ভিস', 'Data & Lead Services', 'নির্ভুল ওয়েব রিসার্চ, ডেটা এন্ট্রি ও ভেরিফায়েড লিড সংগ্রহ।', 'Accurate web research, data entry and verified lead collection.', '🗃️', '["\\u0993\\u09af\\u09bc\\u09c7\\u09ac \\u09b0\\u09bf\\u09b8\\u09be\\u09b0\\u09cd\\u099a","\\u09a1\\u09c7\\u099f\\u09be \\u098f\\u09a8\\u09cd\\u099f\\u09cd\\u09b0\\u09bf","\\u09b2\\u09bf\\u09a1 \\u099c\\u09c7\\u09a8\\u09be\\u09b0\\u09c7\\u09b6\\u09a8","\\u0995\\u09cd\\u09af\\u09be\\u09ae\\u09cd\\u09aa\\u09c7\\u0987\\u09a8 \\u09a1\\u09c7\\u099f\\u09be"]', 'data-lead-services', 5, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'Laravel', 'Laravel', 'ওয়েব ফ্রেমওয়ার্ক', 'ওয়েব ফ্রেমওয়ার্ক', 90, 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'WordPress', 'WordPress', 'ওয়েব ফ্রেমওয়ার্ক', 'ওয়েব ফ্রেমওয়ার্ক', 88, 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'Meta Ads', 'Meta Ads', 'মার্কেটিং', 'মার্কেটিং', 92, 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'Google Ads', 'Google Ads', 'মার্কেটিং', 'মার্কেটিং', 85, 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (5, 'নিউটন / ফ্লোআপ', 'নিউটন / ফ্লোআপ', 'অটোমেশন', 'অটোমেশন', 90, 4, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (6, 'AI Tools', 'AI Tools', 'অটোমেশন', 'অটোমেশন', 88, 5, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (7, 'Data Entry', 'Data Entry', 'ডেটা সার্ভিস', 'ডেটা সার্ভিস', 95, 6, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `skills` (`id`, `name_bn`, `name_en`, `category_bn`, `category_en`, `level`, `sort`, `active`, `created_at`, `updated_at`) VALUES (8, 'Web Research', 'Web Research', 'ডেটা সার্ভিস', 'ডেটা সার্ভিস', 92, 7, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'নির্ধারিত সময়ে ডেলিভারি', 'On-time Delivery', 'প্রতিটা কাজ গবেষণা করে সময়ের ভেতরে সম্পন্ন করা হয়।', 'Every task is researched and delivered on time.', '⏱️', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'কোয়ালিটি ফার্স্ট', 'Quality First', 'ডেলিভারির আগে পুরোপুরি টেস্ট ও যাচাই করা হয়।', 'Everything is tested and verified before delivery.', '✅', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'সার্ভার ও টুল সাপোর্ট', 'Server & Tool Support', 'সার্ভার, ডোমেইন ও অ্যাকাউন্ট সেটআপে সম্পূর্ণ সাপোর্ট।', 'Full support for server, domain and account setup.', '🛰️', 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'স্বচ্ছ পেমেন্ট', 'Transparent Payments', 'ভাউচার-ভিত্তিক স্বচ্ছ পেমেন্ট ট্র্যাকিং।', 'Voucher-based transparent payment tracking.', '💳', 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (5, 'প্রথমে কনসালট, তারপর কাজ', 'Consult First, Work Later', 'প্রয়োজন বুঝে সঠিক সমাধান প্রস্তাব করা হয়।', 'The right solution is proposed after understanding the need.', '💬', 4, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `responsibilities` (`id`, `title_bn`, `title_en`, `description_bn`, `description_en`, `icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES (6, 'দ্রুত রেসপন্স', 'Fast Response', 'যেকোনো সমস্যায় WhatsApp ও লাইভ চ্যাটে দ্রুত রেসপন্স।', 'Quick response on WhatsApp and live chat for any issue.', '🚀', 5, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `portfolio_categories` (`id`, `name_bn`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'ওয়েব ডিজাইন', 'Web Design', 'web-design', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `portfolio_categories` (`id`, `name_bn`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'ডিজিটাল মার্কেটিং', 'Digital Marketing', 'digital-marketing', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `portfolio_categories` (`id`, `name_bn`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'অটোমেশন', 'Automation', 'automation', 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `portfolio_categories` (`id`, `name_bn`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'নলেজ প্ল্যাটফর্ম', 'Knowledge Platform', 'knowledge-platform', 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `projects` (`id`, `portfolio_category_id`, `title_bn`, `title_en`, `slug`, `client`, `description_bn`, `description_en`, `before_after`, `metrics`, `live_url`, `featured`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 1, 'এডুকেশন পোর্টাল', 'Education Portal', 'education-portal', 'Academic Client', 'কোর্স ম্যানেজমেন্ট ও স্টুডেন্ট লগইন সম্পন্ন এডুকেশন পোর্টাল।', NULL, NULL, '[{"label":"\\u09b2\\u09cb\\u09a1 \\u099f\\u09be\\u0987\\u09ae","value":"\\u09e8.\\u09e7s \\u2192 \\u09e6.\\u09efs"},{"label":"\\u099f\\u09cd\\u09b0\\u09be\\u09ab\\u09bf\\u0995","value":"+\\u09ea\\u09e6%"}]', NULL, 1, 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `projects` (`id`, `portfolio_category_id`, `title_bn`, `title_en`, `slug`, `client`, `description_bn`, `description_en`, `before_after`, `metrics`, `live_url`, `featured`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 2, 'ই-কমার্স মার্কেটিং', 'E-commerce Marketing', 'ecommerce-marketing', 'Fashion Brand', 'ফেসবুক অ্যাডস + ফানেল দিয়ে বিক্রি ৩ গুণ।', NULL, NULL, '[{"label":"ROAS","value":"5.2x"},{"label":"\\u09b2\\u09bf\\u09a1","value":"\\u09e7\\u09e8\\u09e6\\u09e6+"}]', NULL, 1, 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `projects` (`id`, `portfolio_category_id`, `title_bn`, `title_en`, `slug`, `client`, `description_bn`, `description_en`, `before_after`, `metrics`, `live_url`, `featured`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 3, 'ফ্লোআপ অটোমেশন বট', 'FlowUp Automation Bot', 'flowup-automation-bot', 'Marketing Agency', 'অটো লিড ক্যাপচার ও WhatsApp ফলো-আপ বট।', NULL, NULL, '[{"label":"\\u09b0\\u09c7\\u09b8\\u09aa\\u09a8\\u09cd\\u09b8 \\u099f\\u09be\\u0987\\u09ae","value":"-\\u09ed\\u09eb%"},{"label":"\\u0985\\u099f\\u09cb \\u09b2\\u09bf\\u09a1","value":"\\u09ee\\u09e6\\u09e6+"}]', NULL, 0, 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `projects` (`id`, `portfolio_category_id`, `title_bn`, `title_en`, `slug`, `client`, `description_bn`, `description_en`, `before_after`, `metrics`, `live_url`, `featured`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 4, 'নলেজ ব্লগ প্ল্যাটফর্ম', 'Knowledge Blog Platform', 'knowledge-blog-platform', 'Blog Network', 'প্রোগ্রামেটিক এসইও ব্লগ প্ল্যাটফর্ম।', NULL, NULL, '[{"label":"\\u09b0\\u200d\\u09cd\\u09af\\u09be\\u0999\\u09cd\\u0995 \\u0995\\u09b0\\u09be \\u09aa\\u09c7\\u099c","value":"\\u09e7\\u09ed\\u09e6+"}]', NULL, 0, 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `team_members` (`id`, `name`, `role_bn`, `role_en`, `photo`, `bio_bn`, `bio_en`, `email`, `phone`, `socials`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'Mahmud', 'প্রতিষ্ঠাতা ও লিড ডেভেলপার', 'Founder & Lead Developer', NULL, '৫+ বছরের এক্সপেরিয়েন্সে ওয়েব ডেভেলপমেন্ট ও এজেন্সি ম্যানেজমেন্ট।', '5+ years of web development and agency management experience.', 'hello@mahmudsupport.xyz', NULL, NULL, 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `certificates` (`id`, `title_bn`, `title_en`, `issuer`, `image`, `url`, `issued_at`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'Google Digital Marketing', 'Google Digital Marketing', 'Google', NULL, NULL, '2023-01-15 00:00:00', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `certificates` (`id`, `title_bn`, `title_en`, `issuer`, `image`, `url`, `issued_at`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'Meta Certified Marketing', 'Meta Certified Marketing', 'Meta', NULL, NULL, '2024-01-15 00:00:00', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `testimonials` (`id`, `name`, `role`, `company`, `photo`, `text_bn`, `text_en`, `rating`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'আহমেদ রহমান', 'ব্যবসায়ী', 'ভাই কিচেন', NULL, 'মার্কেটিং ফানেল সেটআপের পর বিক্রি ক্রমেই বাড়ছে। রেজাল্ট বাস্তব, রিপোর্টও স্বচ্ছ।', 'মার্কেটিং ফানেল সেটআপের পর বিক্রি ক্রমেই বাড়ছে। রেজাল্ট বাস্তব, রিপোর্টও স্বচ্ছ।', 5, 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `testimonials` (`id`, `name`, `role`, `company`, `photo`, `text_bn`, `text_en`, `rating`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'সারাত জাহান', 'CEO', 'Cartify BD', NULL, 'পেমেন্ট ও ডেভেলপমেন্ট দুইটাই প্রফেশনাল। জটিল কাজ সহজভাবে বুঝিয়ে দেন।', 'পেমেন্ট ও ডেভেলপমেন্ট দুইটাই প্রফেশনাল। জটিল কাজ সহজভাবে বুঝিয়ে দেন।', 5, 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `faqs` (`id`, `question_bn`, `question_en`, `answer_bn`, `answer_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'কাজ শুরু করতে কী লাগবে?', 'কাজ শুরু করতে কী লাগবে?', 'প্রথমে ফ্রি কনসালটেন্সি নিন। রিকোয়ারমেন্ট বুঝে টাইমলাইন ও কোটেশন দেওয়া হবে।', 'প্রথমে ফ্রি কনসালটেন্সি নিন। রিকোয়ারমেন্ট বুঝে টাইমলাইন ও কোটেশন দেওয়া হবে।', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `faqs` (`id`, `question_bn`, `question_en`, `answer_bn`, `answer_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'পেমেন্ট কীভাবে হয়?', 'পেমেন্ট কীভাবে হয়?', 'বিকাশ/নগদে পেমেন্ট করে ভাউচার পেজ থেকে WhatsApp-এ কনফার্ম করেন। অ্যাডমিন অ্যাপ্রুভ করলে ইনভয়েস আপডেট হয়।', 'বিকাশ/নগদে পেমেন্ট করে ভাউচার পেজ থেকে WhatsApp-এ কনফার্ম করেন। অ্যাডমিন অ্যাপ্রুভ করলে ইনভয়েস আপডেট হয়।', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `faqs` (`id`, `question_bn`, `question_en`, `answer_bn`, `answer_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'কাজের আপডেট কীভাবে পাব?', 'কাজের আপডেট কীভাবে পাব?', 'প্রতিটা ক্লায়েন্ট পাবেন লগইন-নির্ভর ড্যাশবোর্ড — প্রজেক্ট, ইনভয়েস ও পেমেন্ট সব এক জায়গায়।', 'প্রতিটা ক্লায়েন্ট পাবেন লগইন-নির্ভর ড্যাশবোর্ড — প্রজেক্ট, ইনভয়েস ও পেমেন্ট সব এক জায়গায়।', 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `faqs` (`id`, `question_bn`, `question_en`, `answer_bn`, `answer_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'কাস্টম ওয়েবসাইটে কত সময় লাগে?', 'কাস্টম ওয়েবসাইটে কত সময় লাগে?', 'সাধারণ পোর্টফোলিও সাইট ৩-৭ দিন, ড্যাশবোর্ড ও পেমেন্টসহ প্ল্যাটফর্ম ২-৪ সপ্তাহ।', 'সাধারণ পোর্টফোলিও সাইট ৩-৭ দিন, ড্যাশবোর্ড ও পেমেন্টসহ প্ল্যাটফর্ম ২-৪ সপ্তাহ।', 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `stats` (`id`, `label_bn`, `label_en`, `value`, `sort`, `active`, `created_at`, `updated_at`) VALUES (1, 'সম্পন্ন প্রজেক্ট', 'Projects Completed', '100+', 0, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `stats` (`id`, `label_bn`, `label_en`, `value`, `sort`, `active`, `created_at`, `updated_at`) VALUES (2, 'সন্তুষ্ট ক্লায়েন্ট', 'Happy Clients', '80+', 1, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `stats` (`id`, `label_bn`, `label_en`, `value`, `sort`, `active`, `created_at`, `updated_at`) VALUES (3, 'বছরের অভিজ্ঞতা', 'Years of Experience', '5+', 2, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `stats` (`id`, `label_bn`, `label_en`, `value`, `sort`, `active`, `created_at`, `updated_at`) VALUES (4, 'সাপোর্ট চ্যাট', 'Support Chats', '1000+', 3, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `posts` (`id`, `title_bn`, `title_en`, `slug`, `category_bn`, `category_en`, `excerpt_bn`, `excerpt_en`, `content_bn`, `content_en`, `image`, `meta_title_bn`, `meta_title_en`, `meta_desc_bn`, `meta_desc_en`, `views`, `published_at`, `active`, `created_at`, `updated_at`) VALUES (1, 'ছোট বিজনেসের জন্য ৭টি ডিজিটাল মার্কেটিং টিপস', 'ছোট বিজনেসের জন্য ৭টি ডিজিটাল মার্কেটিং টিপস', 'digital-marketing-tips', 'ডিজিটাল মার্কেটিং', 'Digital Marketing', 'ছোট বাজেটে শুরু করার সহজ ৭টি মার্কেটিং কৌশল।', 'ছোট বাজেটে শুরু করার সহজ ৭টি মার্কেটিং কৌশল।', 'ছোট বাজেটে শুরু করার সহজ ৭টি মার্কেটিং কৌশল।

বিস্তারিত পরামর্শের জন্য আমাদের সাথে যোগাযোগ করুন।', 'ছোট বাজেটে শুরু করার সহজ ৭টি মার্কেটিং কৌশল।

Contact us for a detailed consultation.', NULL, NULL, NULL, NULL, NULL, 0, '2026-11-11 06:39:22', 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `posts` (`id`, `title_bn`, `title_en`, `slug`, `category_bn`, `category_en`, `excerpt_bn`, `excerpt_en`, `content_bn`, `content_en`, `image`, `meta_title_bn`, `meta_title_en`, `meta_desc_bn`, `meta_desc_en`, `views`, `published_at`, `active`, `created_at`, `updated_at`) VALUES (2, 'লারাভেল ওয়েবসাইট কেন এসইও-তে ভালো করে?', 'লারাভেল ওয়েবসাইট কেন এসইও-তে ভালো করে?', 'laravel-seo', 'ওয়েব ডেভেলপমেন্ট', 'Web Development', 'দ্রুতগতি ও ক্লিন কোড কীভাবে র‍্যাঙ্কিং বাড়ায়।', 'দ্রুতগতি ও ক্লিন কোড কীভাবে র‍্যাঙ্কিং বাড়ায়।', 'দ্রুতগতি ও ক্লিন কোড কীভাবে র‍্যাঙ্কিং বাড়ায়।

বিস্তারিত পরামর্শের জন্য আমাদের সাথে যোগাযোগ করুন।', 'দ্রুতগতি ও ক্লিন কোড কীভাবে র‍্যাঙ্কিং বাড়ায়।

Contact us for a detailed consultation.', NULL, NULL, NULL, NULL, NULL, 0, '2026-11-04 06:39:22', 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `posts` (`id`, `title_bn`, `title_en`, `slug`, `category_bn`, `category_en`, `excerpt_bn`, `excerpt_en`, `content_bn`, `content_en`, `image`, `meta_title_bn`, `meta_title_en`, `meta_desc_bn`, `meta_desc_en`, `views`, `published_at`, `active`, `created_at`, `updated_at`) VALUES (3, 'WhatsApp অটোমেশনে লিড কনভার্সন বাড়ান', 'WhatsApp অটোমেশনে লিড কনভার্সন বাড়ান', 'whatsapp-automation', 'অটোমেশন', 'Automation', 'অটো ফলো-আপ দিয়ে হারানো লিড ফিরিয়ে আনুন।', 'অটো ফলো-আপ দিয়ে হারানো লিড ফিরিয়ে আনুন।', 'অটো ফলো-আপ দিয়ে হারানো লিড ফিরিয়ে আনুন।

বিস্তারিত পরামর্শের জন্য আমাদের সাথে যোগাযোগ করুন।', 'অটো ফলো-আপ দিয়ে হারানো লিড ফিরিয়ে আনুন।

Contact us for a detailed consultation.', NULL, NULL, NULL, NULL, NULL, 0, '2026-10-28 06:39:22', 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `pages` (`id`, `slug`, `title_bn`, `title_en`, `content_bn`, `content_en`, `meta_title_bn`, `meta_title_en`, `meta_desc_bn`, `meta_desc_en`, `active`, `created_at`, `updated_at`) VALUES (1, 'about', 'আমাদের সম্পর্কে', 'About Us', 'আমরা একটি এজেন্সি-টাইপ পার্সোনাল টিম — ওয়েব ডেভেলপমেন্ট, মার্কেটিং ও অটোমেশনে বিশেষজ্ঞ।', 'We are an agency-type personal team specializing in web development, marketing and automation.', NULL, NULL, NULL, NULL, 1, '2026-11-18 06:39:22', '2026-11-18 06:39:22');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '0001_01_02_000000_create_site_tables', 1);
