<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiMarketingAssistant
{
    public function answering(): bool
    {
        return (bool) setting('ai_enabled') && (string) setting('ai_api_key') !== '';
    }

    public function respond(string $userMessage, array $history = []): string
    {
        $userMessage = trim(mb_substr($userMessage, 0, 2000));

        if (!$this->answering()) {
            return $this->fallback($userMessage);
        }

        try {
            $payload = [
                'model' => (string) (setting('ai_model') ?: 'gpt-4o-mini'),
                'messages' => array_merge(
                    [['role' => 'system', 'content' => (string) setting('ai_system_prompt', $this->defaultPrompt())]],
                    collect($history)->take(-6)
                        ->map(fn ($m) => ['role' => $m['role'] ?? 'user', 'content' => mb_substr((string) ($m['content'] ?? ''), 0, 1500)])
                        ->values()->all(),
                    [['role' => 'user', 'content' => $userMessage]]
                ),
                'max_tokens' => 700,
                'temperature' => 0.7,
            ];

            $response = Http::withToken((string) setting('ai_api_key'))
                ->timeout(45)
                ->acceptJson()
                ->post(rtrim((string) (setting('ai_base_url') ?: 'https://api.openai.com/v1'), '/').'/chat/completions', $payload);

            $reply = $response->json('choices.0.message.content');

            return is_string($reply) && trim($reply) !== ''
                ? trim($reply)
                : $this->fallback($userMessage);
        } catch (\Throwable $e) {
            report($e);

            return $this->fallback($userMessage);
        }
    }

    protected function defaultPrompt(): string
    {
        $services = \App\Models\Service::active()->orderBy('sort')->pluck('title_en')->all();
        $serviceList = implode(', ', $services ?: ['Web design', 'Marketing automation']);

        return <<<TXT
        You are the AI marketing consultant embedded in a digital agency portfolio website.
        Business profile: digital design & web development agency. Core services: {$serviceList}.
        Reply in the language the visitor used (Bangla for Bangla, English otherwise).
        Give 2-4 practical, specific marketing ideas tailored to the visitor's business,
        then invite them to submit the "Request Custom Work" form or take a free consultancy.
        Keep replies under 180 words, warm and concrete. Never promise pricing.
        TXT;
    }

    protected function fallback(string $message): string
    {
        $isBangla = preg_match('/[\x{0980}-\x{09FF}]/u', $message) === 1;
        $services = \App\Models\Service::active()->orderBy('sort')->limit(4)->pluck('title_bn')->all();
        $serviceList = implode(', ', $services ?: ['ওয়েব ডিজাইন', 'মার্কেটিং']);

        if ($isBangla) {
            return "আপনার ব্যবসার জন্য এখনই ৩টা কাজের আইডিয়া:\n"
                ."১) সোশ্যাল মিডিয়ায় সপ্তাহে ৩টা কনটেন্ট পোস্ট করুন — সমস্যা-সমাধান ফরম্যাটে।\n"
                ."২) Google Business Profile খুলে রিভিউ কালেকশন চালু করুন।\n"
                ."৩) একটা ল্যান্ডিং পেজ বানিয়ে WhatsApp/ফর্মে লিড নিন।\n\n"
                ."আমরা করি: {$serviceList}। বিস্তারিত জানতে \"কাস্টম কাজ রিকোয়েস্ট\" ফর্ম পূরণ করুন — ২৪ ঘণ্টায় ফ্রি প্রপোজাল।";
        }

        return "Here are 3 quick ideas for your business:\n"
            ."1) Post 3 content items a week on social media in a problem-solution format.\n"
            ."2) Set up a Google Business Profile and start collecting reviews.\n"
            ."3) Launch a landing page that captures leads via WhatsApp or a form.\n\n"
            ."We offer: {$serviceList}. Fill the \"Request Custom Work\" form and get a free proposal within 24 hours.";
    }
}
