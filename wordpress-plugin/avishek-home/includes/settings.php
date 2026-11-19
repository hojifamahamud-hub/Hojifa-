<?php

defined('ABSPATH') || exit;

function as_home_field_specs()
{
    return [
        ['type' => 'heading', 'key' => null, 'label' => '🎨 Hero (উপরের অংশ)'],
        ['type' => 'text', 'key' => 'hero_name', 'label' => 'নাম (Gradient টেক্সট)', 'default' => 'Avishek Sarkar'],
        ['type' => 'text', 'key' => 'hero_eyebrow', 'label' => 'উপরের ছোট লেখা (eyebrow)', 'default' => 'Digital Marketing Professional'],
        ['type' => 'text', 'key' => 'hero_role', 'label' => 'পেশা / ট্যাগলাইন', 'default' => 'Freelance Digital Marketing Expert & Designer'],
        ['type' => 'textarea', 'key' => 'hero_subtitle', 'label' => 'হিরো সাব-টেক্সট', 'rows' => 2, 'default' => 'Helping brands grow with data-driven SEO, social media marketing, creative design and a results-first approach. 3+ years of hands-on experience.'],
        ['type' => 'lines', 'key' => 'hero_tags', 'label' => 'ট্যাগ', 'rows' => 4, 'hint' => 'প্রতি লাইনে একটা ট্যাগ', 'default' => "SEO OPTIMIZATION\nSOCIAL MEDIA MARKETING\nPINTEREST MARKETING\nGRAPHIC DESIGN\nWEB DESIGN"],
        ['type' => 'url', 'key' => 'hero_image', 'label' => 'হিরো ছবির URL (খালি রাখলে ইলাস্ট্রেশন দেখাবে)', 'default' => ''],
        ['type' => 'text', 'key' => 'hero_cta_text', 'label' => 'বাটনের লেখা', 'default' => 'Start Your Project'],
        ['type' => 'url', 'key' => 'hero_cta_url', 'label' => 'বাটনের লিংক', 'default' => '#contact'],

        ['type' => 'heading', 'key' => null, 'label' => '🌐 প্ল্যাটফর্ম ও অর্জন'],
        ['type' => 'lines', 'key' => 'platforms', 'label' => 'প্ল্যাটফর্ম তালিকা', 'rows' => 4, 'hint' => 'প্রতি লাইনে একটা প্ল্যাটফর্মের নাম', 'default' => "FACEBOOK\nINSTAGRAM\nPINTEREST\nLINKEDIN\nGOOGLE ADS\nTIKTOK\nYOUTUBE"],
        ['type' => 'text', 'key' => 'achievements_title', 'label' => 'অর্জন সেকশনের শিরোনাম', 'default' => 'Numbers Take Our Back'],
        ['type' => 'textarea', 'key' => 'achievements_intro', 'label' => 'অর্জনের ইনট্রো', 'rows' => 2, 'default' => 'Real, measurable results from 3+ years of digital marketing and design work.'],
        ['type' => 'lines', 'key' => 'achievements', 'label' => 'অর্জন কার্ড', 'rows' => 4, 'hint' => 'ফরম্যাট: <code>মান|লেবেল|ইমোজি</code> — যেমন <code>120+|Projects Completed|💼</code>', 'default' => "120+|Projects Completed|💼\n98%|Client Satisfaction|👥\n3+|Years Experience|🏆\n100%|Client Satisfaction|📈"],

        ['type' => 'heading', 'key' => null, 'label' => '🙋 About অংশ'],
        ['type' => 'text', 'key' => 'about_eyebrow', 'label' => 'Eyebrow', 'default' => 'Get to know me'],
        ['type' => 'text', 'key' => 'about_heading', 'label' => 'শিরোনাম', 'default' => 'About Freelancer Avishek'],
        ['type' => 'textarea', 'key' => 'about_intro', 'label' => 'ইনট্রো (সেকশনের নিচে বর্ণনা)', 'rows' => 2, 'default' => 'A dedicated digital marketing and graphic design expert from Bangladesh with a passion for helping businesses succeed online.'],
        ['type' => 'text', 'key' => 'about_greeting', 'label' => 'পরিচিতির হেডিং', 'default' => "Hi, I'm Avishek Sarkar!"],
        ['type' => 'lines', 'key' => 'about_body', 'label' => 'মূল লেখা (প্রতি লাইন = এক প্যারাগ্রাফ)', 'rows' => 4, 'default' => "I'm a passionate Digital Marketing professional from Bangladesh with 3+ years of hands-on experience helping businesses transform their online presence.\nMy expertise spans SEO, Social Media Marketing, Pinterest Marketing, Brand Identity Design, and comprehensive Digital Marketing Strategy.\nI believe in data-driven approaches and creative solutions that not only look great but deliver measurable results for my clients."],
        ['type' => 'lines', 'key' => 'about_drives', 'label' => 'What drives me (তালিকা)', 'rows' => 4, 'default' => "Delivering measurable ROI for every client\nStaying ahead of digital marketing trends\nBuilding long-term partnerships, not just projects\nContinuously learning and adapting to new challenges"],
        ['type' => 'lines', 'key' => 'about_cards', 'label' => 'ডান পাশের ৪টা কার্ড', 'rows' => 4, 'hint' => 'ফরম্যাট: <code>শিরোনাম|লেখা|ইমোজি</code>', 'default' => "Education|Bachelor of Business Administration (BBA) from National University, Bangladesh (2024–2025)|🎓\nExperience|3+ years of professional experience in digital marketing and graphic design|🏆\nMission|Helping businesses grow through strategic digital marketing and creative design|🎯\nPassion|Delivering exceptional results and building lasting client relationships|❤️"],

        ['type' => 'heading', 'key' => null, 'label' => '📊 Skills সেকশন'],
        ['type' => 'text', 'key' => 'skills_title', 'label' => 'শিরোনাম', 'default' => 'My Skills'],
        ['type' => 'textarea', 'key' => 'skills_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Expertise across different digital marketing and design disciplines.'],
        ['type' => 'lines', 'key' => 'skills', 'label' => 'স্কিল তালিকা', 'rows' => 8, 'hint' => 'ফরম্যাট: <code>নাম|শতকরা</code>', 'default' => "SEO Optimization|95\nSocial Media Marketing|92\nGraphic Design|90\nPinterest Marketing|88\nWebsite Design|85\nGoogle Ads|82\nVideo Editing|80\nB2B Lead Generation|78"],

        ['type' => 'heading', 'key' => null, 'label' => '🧰 Services সেকশন'],
        ['type' => 'text', 'key' => 'services_title', 'label' => 'শিরোনাম', 'default' => 'My Services'],
        ['type' => 'textarea', 'key' => 'services_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Comprehensive digital solutions to help your business grow and thrive in the digital landscape.'],
        ['type' => 'lines', 'key' => 'services', 'label' => 'সার্ভিস তালিকা', 'rows' => 12, 'hint' => 'ফরম্যাট: <code>টাইটেল|বর্ণনা|ফিচার১,ফিচার২,ফিচার৩|ইমোজি</code>', 'default' => "Digital Marketing Strategy|Comprehensive digital marketing strategies to boost your online presence and drive sustainable growth through data-driven campaigns and multi-channel optimization.|Market Research & Analysis,Campaign Strategy Development,Multi-Channel Marketing,Performance Analytics,ROI Optimization,Competitor Analysis|📈\nBrand Identity & Logo Design|Creating unique and memorable brand identities that capture your essence and make a lasting impression.|Logo Design & Concepts,Brand Identity Systems,Color Palette Development,Typography Selection,Brand Guidelines,Business Card Design|🎨\nSocial Media Marketing|Strategic social media management across all platforms to build engagement, grow your following, and convert social traffic.|Content Strategy & Creation,Community Management,Paid Social Advertising,Influencer Outreach,Social Media Analytics,Platform Optimization|📱\nSEO Optimization|Comprehensive SEO strategies to improve your website's visibility on search engines.|Keyword Research & Strategy,On-Page SEO Optimization,Technical SEO Audits,Link Building Campaigns,Local SEO,SEO Content Writing|🔍\nVideo Production & Editing|Professional video editing and production services for promotional content.|Video Editing & Post-Production,Motion Graphics & Animation,Color Grading & Correction,Audio Enhancement,Subtitles & Captions,Social Media Video Formats|🎬\nPinterest Marketing Specialist|Specialized Pinterest marketing strategies to drive high-quality traffic.|Pinterest SEO Optimization,Pin Design & Creation,Board Strategy Development,Rich Pins Implementation,Pinterest Analytics,Seasonal Campaign Planning|📌\nGraphic Design Services|Creative graphic design solutions for print and digital media.|Marketing Material Design,Web Graphics & Banners,Infographic Creation,Print Design,Social Media Graphics,Presentation Design|✒️\nAnalytics & Data Insights|Comprehensive analytics setup and reporting to track your digital marketing performance.|Google Analytics Setup,Conversion Tracking,Performance Reporting,Data Visualization,KPI Monitoring,Growth Insights|📊\nPaid Advertising Management|Expert management of paid advertising campaigns across platforms.|Google Ads Management,Facebook & Instagram Ads,Campaign Optimization,A/B Testing,Audience Targeting,Budget Management|🎯\nEmail Marketing Automation|Strategic email marketing campaigns and automation sequences.|Email Campaign Design,Automation Sequences,List Building Strategies,A/B Testing,Performance Analytics,Newsletter Management|✉️\nWebsite Design & Development|Modern, responsive website design and development that converts visitors into customers.|Responsive Web Design,Landing Page Creation,E-commerce Development,Website Optimization,Mobile-First Design,CMS Integration|🖥️\nE-commerce Optimization|Complete e-commerce solutions to maximize online sales.|Store Setup & Configuration,Product Page Optimization,Conversion Rate Optimization,Shopping Cart Recovery,Payment Integration,Inventory Management|🛒"],
        ['type' => 'text', 'key' => 'services_banner_title', 'label' => 'নিচের ব্যানারের শিরোনাম', 'default' => 'Ready to Transform Your Business?'],
        ['type' => 'textarea', 'key' => 'services_banner_text', 'label' => 'ব্যানারের লেখা', 'rows' => 2, 'default' => "Let's work together to create something amazing and achieve your digital goals."],

        ['type' => 'heading', 'key' => null, 'label' => '💳 Pricing প্যাকেজ'],
        ['type' => 'text', 'key' => 'pricing_title', 'label' => 'শিরোনাম', 'default' => 'Pricing Packages'],
        ['type' => 'textarea', 'key' => 'pricing_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Flexible pricing plans tailored to your business needs and budget.'],
        ['type' => 'lines', 'key' => 'pricing', 'label' => 'প্যাকেজ তালিকা', 'rows' => 6, 'hint' => 'ফরম্যাট: <code>নাম|দাম|/ period|বর্ণনা|ফিচার১;ফিচার২;...|featured(1/0)</code>', 'default' => "Starter|$49|/ project|Perfect for small businesses getting started|Social Media Setup (2 Platforms);Basic SEO Audit;5 Social Media Posts;Basic Analytics Report;1 Revision Round|0\nProfessional|$99|/ month|Best for growing businesses|Full Social Media Management;Complete SEO Optimization;15 Social Media Posts/Month;Google Ads Management;Monthly Analytics Report;Pinterest Marketing;1 Revision Round|1\nEnterprise|$149|/ month|Complete digital marketing solution|Everything in Professional;Website Design & Development;30 Social Media Posts/Month;Video Content Creation;Email Marketing Automation;B2B Lead Generation;Dedicated Account Manager;Unlimited Revisions|0"],
        ['type' => 'text', 'key' => 'currency', 'label' => 'মুদ্রার প্রতীক', 'default' => '$'],

        ['type' => 'heading', 'key' => null, 'label' => '🧮 প্রাইস ক্যালকুলেটর'],
        ['type' => 'text', 'key' => 'calc_title', 'label' => 'শিরোনাম', 'default' => 'Custom Pricing Calculator'],
        ['type' => 'textarea', 'key' => 'calc_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Pick the services you need and get an instant price estimate. Bundle 3+ services for a discount!'],
        ['type' => 'lines', 'key' => 'calc', 'label' => 'ক্যালকুলেটর আইটেম', 'rows' => 14, 'hint' => 'ফরম্যাট: <code>নাম|ক্যাটাগরি|দাম</code>', 'default' => "SEO Audit & Report|SEO|15\nFull SEO Optimization|SEO|79\nKeyword Research|SEO|25\nSocial Media Setup|Social Media|19\nSocial Media Management|Social Media|59\nSocial Media Ads|Social Media|49\nPinterest Marketing|Social Media|35\nGoogle Ads Management|Advertising|69\nLanding Page Design|Web Design|59\nFull Website Design|Web Design|149\nLogo & Brand Identity|Design|35\nVideo Content (5 videos)|Content|59\nEmail Marketing Setup|Marketing|49\nB2B Lead Generation|Marketing|69"],
        ['type' => 'number', 'key' => 'calc_discount_percent', 'label' => 'বান্ডল ডিসকাউন্ট (%)', 'default' => '10'],
        ['type' => 'number', 'key' => 'calc_discount_min_items', 'label' => 'ডিসকাউন্ট পেতে কমপক্ষে আইটেম', 'default' => '3'],
        ['type' => 'textarea', 'key' => 'calc_note', 'label' => 'নিচের ছোট নোট', 'rows' => 1, 'default' => 'An estimate only. Final scope and pricing can be discussed together.'],

        ['type' => 'heading', 'key' => null, 'label' => '🖼️ পোর্টফোলিও'],
        ['type' => 'text', 'key' => 'portfolio_title', 'label' => 'শিরোনাম', 'default' => 'My Portfolio'],
        ['type' => 'textarea', 'key' => 'portfolio_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'A showcase of my latest work and successful projects across different digital domains.'],
        ['type' => 'lines', 'key' => 'portfolio', 'label' => 'প্রজেক্ট তালিকা', 'rows' => 9, 'hint' => 'ফরম্যাট: <code>টাইটেল|বর্ণনা|ক্যাটাগরি|ইমোজি</code>', 'default' => "Premium Brand Logo Collection|Designed 15+ striking brand identities across tech, fashion & food industries.|Graphic Design|🎨\nE-commerce SEO & Traffic Boost|Transformed an online fashion store's organic traffic by 250%.|SEO|📈\nB2B SaaS Social Media Launch|Built a B2B SaaS brand from zero to 25K+ followers.|Social Media|📱\nPinterest Growth & Traffic Machine|Scaled a lifestyle brand's Pinterest from scratch to 2M+ monthly impressions.|Social Media|📌\nCorporate Video Production Suite|Produced 25+ high-quality corporate videos.|Graphic Design|🎬\nFull Digital Transformation (E-com)|Took a local retail store fully online — delivering 450% ROI.|Digital Marketing|🛍️\nRestaurant Chain Rebrand|Modernized brand identity for a 15-location restaurant chain.|Graphic Design|🍽️\nHealthcare Local SEO Domination|Drove a medical practice to #1 rankings for 20+ local keywords.|SEO|🏥\nBeauty Brand Influencer Campaign|Partnered with 25 influencers reaching 2M+ audience.|Social Media|✨"],
        ['type' => 'text', 'key' => 'portfolio_banner_title', 'label' => 'ব্যানারের শিরোনাম', 'default' => 'Like What You See?'],
        ['type' => 'textarea', 'key' => 'portfolio_banner_text', 'label' => 'ব্যানারের লেখা', 'rows' => 2, 'default' => "These are just a few examples of my work. Let's discuss how I can bring your next project to life."],

        ['type' => 'heading', 'key' => null, 'label' => '📋 কেস স্টাডি'],
        ['type' => 'text', 'key' => 'case_title', 'label' => 'শিরোনাম', 'default' => 'Case Studies'],
        ['type' => 'textarea', 'key' => 'case_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => "Real results from real clients — see how I've helped businesses grow."],
        ['type' => 'lines', 'key' => 'cases', 'label' => 'কেস স্টাডি তালিকা', 'rows' => 4, 'hint' => 'ফরম্যাট: <code>ক্লায়েন্ট|টাইটেল|Challenge|Solution|মান:লেবেল,মান:লেবেল,...</code>', 'default' => "FASHION BRAND|E-commerce SEO Overhaul|Low organic traffic and poor search rankings for competitive keywords.|Complete technical SEO audit, on-page optimization, keyword strategy, and link building campaign.|+250%:Organic Traffic,Top 3:Keyword Rankings,+180%:Conversions,500+:New Customers\nTECH STARTUP|Social Media Growth Campaign|No social media presence and zero brand awareness in the target market.|Multi-platform social media strategy with content creation, paid ads, and community management.|500K+:Reach,15%:Engagement,200+:Leads,350%:ROI\nLIFESTYLE BRAND|Pinterest Marketing Strategy|Underutilized Pinterest channel with minimal website traffic from social sources.|Strategic pin design, keyword-optimized boards, and consistent scheduling with analytics tracking.|+400%:Website Traffic,2M+:Monthly Impressions,10K+:Pin Saves,+220%:Revenue Growth"],

        ['type' => 'heading', 'key' => null, 'label' => '💬 টেস্টিমোনিয়াল'],
        ['type' => 'text', 'key' => 'testi_title', 'label' => 'শিরোনাম', 'default' => 'Client Testimonials'],
        ['type' => 'textarea', 'key' => 'testi_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'What my clients say about working with Freelancer Avishek.'],
        ['type' => 'lines', 'key' => 'testimonials', 'label' => 'রিভিউ তালিকা', 'rows' => 6, 'hint' => 'ফরম্যাট: <code>কোট|নাম|পদ|রেটিং(১-৫)</code>', 'default' => "Avishek created a logo that perfectly captures our brand essence. The professionalism and creativity exceeded our expectations!|Sarah Johnson|CEO, TechNova Inc.|5\nOur organic traffic and sales have skyrocketed! Avishek's SEO expertise transformed our online business completely.|Michael Chen|Owner, Fashion Forward Boutique|5\nPinterest is now our top traffic source! Avishek's expertise in Pinterest marketing is truly unmatched.|Emma Williams|Founder, Cozy Home Living|5\nAvishek helped us build a powerful social presence from scratch. The leads and brand awareness we gained are invaluable.|David Park|CEO, CloudSync Solutions|5\nAvishek saved our business. The digital transformation exceeded all expectations and continues to drive growth.|Lisa Martinez|Owner, Local Retail Store|5\nWe're now fully booked weeks in advance! Avishek's local SEO expertise transformed our practice.|Dr. Amanda Foster|Medical Director, Family Health|5"],

        ['type' => 'heading', 'key' => null, 'label' => '🎬 ভিডিও সেকশন'],
        ['type' => 'text', 'key' => 'video_title', 'label' => 'শিরোনাম', 'default' => 'Video Introduction'],
        ['type' => 'textarea', 'key' => 'video_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Get to know my approach to helping businesses grow.'],
        ['type' => 'url', 'key' => 'video_embed', 'label' => 'ইউটিউব লিংক (খালি রাখলে গ্রেটিংস কার্ড দেখাবে)', 'default' => ''],
        ['type' => 'textarea', 'key' => 'video_text', 'label' => 'ভিডিও কার্ডের লেখা', 'rows' => 2, 'default' => 'Digital marketing, thoughtful design, and measurable results — explore my work and get in touch to discuss your goals.'],

        ['type' => 'heading', 'key' => null, 'label' => '🔗 ফ্রিল্যান্স প্রোফাইল'],
        ['type' => 'text', 'key' => 'profiles_title', 'label' => 'শিরোনাম', 'default' => 'Freelance Profiles'],
        ['type' => 'textarea', 'key' => 'profiles_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Hire me on your favorite freelance platform. Ask for my current profile links when we connect.'],
        ['type' => 'lines', 'key' => 'profiles_buttons', 'label' => 'বাটন', 'rows' => 2, 'hint' => 'ফরম্যাট: <code>লেবেল|লিংক</code>', 'default' => "Ask About Upwork|#contact\nAsk About Fiverr|#contact"],

        ['type' => 'heading', 'key' => null, 'label' => '💡 ইনসাইট / ব্লগ কার্ড'],
        ['type' => 'text', 'key' => 'insights_title', 'label' => 'শিরোনাম', 'default' => 'Latest Insights'],
        ['type' => 'textarea', 'key' => 'insights_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Tips, strategies, and insights to help grow your business online.'],
        ['type' => 'lines', 'key' => 'insights', 'label' => 'ইনসাইট তালিকা', 'rows' => 3, 'hint' => 'ফরম্যাট: <code>ট্যাগ|টাইটেল|সংক্ষিপ্ত|বিস্তারিত</code>', 'default' => "SEO|SEO Basics to Advanced|Learn SEO from basics to advanced level — on-page, off-page, technical SEO, and more.|Explore keyword research, content structure, technical health, and ongoing measurement as essential parts of a practical SEO strategy.\nDIGITAL MARKETING|What is Digital Marketing?|A comprehensive guide to digital marketing including SEO, SMM, email marketing, and more strategies.|Digital marketing connects audiences and businesses through search, social platforms, content, and measurable campaigns.\nSOCIAL MEDIA|Social Media Marketing Guide|Master social media marketing strategies for Facebook, Instagram, LinkedIn, and other platforms.|Set a clear audience and goal, plan valuable content, engage consistently, and review performance to refine your approach."],

        ['type' => 'heading', 'key' => null, 'label' => '❓ FAQ'],
        ['type' => 'text', 'key' => 'faq_title', 'label' => 'শিরোনাম', 'default' => 'সচরাচর জিজ্ঞাসিত প্রশ্নাবলী'],
        ['type' => 'textarea', 'key' => 'faq_intro', 'label' => 'ইনট্রো', 'rows' => 1, 'default' => 'ডিজিটাল মার্কেটিং সেবা সম্পর্কে আপনার প্রশ্নের উত্তর'],
        ['type' => 'lines', 'key' => 'faqs', 'label' => 'প্রশ্ন-উত্তর', 'rows' => 6, 'hint' => 'ফরম্যাট: <code>প্রশ্ন|উত্তর</code>', 'default' => "Digital Marketing কি এবং এটি কিভাবে ব্যবসার প্রসারে সাহায্য করে?|ডিজিটাল মার্কেটিং হলো অনলাইন মাধ্যমে আপনার পণ্য বা সেবার প্রচার। এটি সঠিক গ্রাহকের কাছে পৌঁছাতে, পরিচিতি বাড়াতে এবং ফলাফল পরিমাপ করতে সাহায্য করে।\nSEO Optimization করলে কতদিনে ভালো ফলাফল পাওয়া যায়?|SEO একটি চলমান প্রক্রিয়া। ফলাফল নির্ভর করে ওয়েবসাইটের বর্তমান অবস্থা, প্রতিযোগিতা এবং কাজের পরিধির ওপর; তাই নির্দিষ্ট সময়ে ফলাফলের নিশ্চয়তা দেওয়া যায় না।\nSocial Media Marketing এর জন্য কোন প্ল্যাটফর্ম সবচেয়ে ভালো?|আপনার লক্ষ্য, গ্রাহক এবং কনটেন্টের ধরন অনুযায়ী উপযুক্ত প্ল্যাটফর্ম নির্বাচন করা উচিত। Facebook, Instagram বা LinkedIn—প্রতিটির ব্যবহার ভিন্ন হতে পারে।\nWebsite Design ও Development এর খরচ কত?|ওয়েবসাইটের পৃষ্ঠা, ডিজাইন এবং প্রয়োজনীয় ফিচারের ওপর খরচ নির্ভর করে। আপনার চাহিদা জানালে উপযুক্ত প্রস্তাব দেওয়া সম্ভব।\nPinterest Marketing কিভাবে ব্যবসার ট্রাফিক বাড়ায়?|সঠিক কীওয়ার্ড, আকর্ষণীয় পিন এবং নিয়মিত কনটেন্ট পরিকল্পনার মাধ্যমে Pinterest থেকে ওয়েবসাইটে আগ্রহী দর্শক আনা সম্ভব।\nআপনার সাথে কাজ শুরু করতে কি কি প্রয়োজন?|আপনার ব্যবসার লক্ষ্য, বর্তমান অনলাইন উপস্থিতি, কাঙ্ক্ষিত সেবা এবং আনুমানিক বাজেট জানালেই প্রাথমিক আলোচনা শুরু করা যায়।"],

        ['type' => 'heading', 'key' => null, 'label' => '📅 মিটিং বুকিং'],
        ['type' => 'text', 'key' => 'meeting_title', 'label' => 'শিরোনাম', 'default' => "Let's Talk About Your Goals"],
        ['type' => 'textarea', 'key' => 'meeting_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => "Send a meeting request. I'll follow up by email to confirm availability and details."],
        ['type' => 'lines', 'key' => 'meeting_options', 'label' => 'মিটিং অপশন', 'rows' => 3, 'hint' => 'ফরম্যাট: <code>নাম|বর্ণনা|দাম</code> (দাম খালি হলে Free দেখাবে)', 'default' => "Free Consultation|15 min · Quick chat about your project needs|\nStrategy Session|30 min · In-depth marketing strategy discussion|$25\nProject Kickoff|60 min · Full planning session for your project|$49"],
        ['type' => 'textarea', 'key' => 'meeting_note', 'label' => 'ফর্মের উপরের নোট', 'rows' => 1, 'default' => 'This is a request, not a confirmed booking.'],

        ['type' => 'heading', 'key' => null, 'label' => '💡 নিউজলেটার'],
        ['type' => 'text', 'key' => 'news_title', 'label' => 'শিরোনাম', 'default' => 'Subscribe to Newsletter'],
        ['type' => 'textarea', 'key' => 'news_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => 'Get the latest tips on digital marketing, SEO, and design delivered to your inbox.'],

        ['type' => 'heading', 'key' => null, 'label' => '✉️ কন্টাক্ট সেকশন'],
        ['type' => 'text', 'key' => 'contact_title', 'label' => 'শিরোনাম', 'default' => "Let's Build Something Great"],
        ['type' => 'textarea', 'key' => 'contact_intro', 'label' => 'ইনট্রো', 'rows' => 2, 'default' => "Ready to start your project? Let's discuss how I can help you achieve your digital goals."],
        ['type' => 'text', 'key' => 'contact_email', 'label' => 'ইমেইল', 'default' => 'avisheksarker63@gmail.com'],
        ['type' => 'text', 'key' => 'contact_phone', 'label' => 'ফোন', 'default' => '+88 01765397006'],
        ['type' => 'text', 'key' => 'contact_location', 'label' => 'ঠিকানা', 'default' => 'Pabna, Rajshahi, Bangladesh'],
        ['type' => 'lines', 'key' => 'socials', 'label' => 'সোশ্যাল লিংক', 'rows' => 4, 'hint' => 'ফরম্যাট: <code>লেবেল|লিংক</code>', 'default' => "Instagram|#contact\nFacebook|#contact\nTikTok|#contact\nBlog|#insights"],

        ['type' => 'heading', 'key' => null, 'label' => '🦶 ফুটার ও সেটিংস'],
        ['type' => 'textarea', 'key' => 'footer_about', 'label' => 'ফুটারের সংক্ষিপ্ত ভূমিকা', 'rows' => 2, 'default' => 'Professional digital marketing and graphic design expert from Bangladesh. Helping businesses grow online since 2022.'],
        ['type' => 'text', 'key' => 'footer_copyright', 'label' => 'ফুটারের কপিরাইট', 'default' => '© Avishek Sarkar. All rights reserved.'],
        ['type' => 'lines', 'key' => 'footer_links', 'label' => 'ফুটারের Quick Links', 'rows' => 4, 'hint' => 'ফরম্যাট: <code>লেবেল|লিংক</code>', 'default' => "Home|#home\nAbout|#about\nPortfolio|#portfolio\nContact|#contact"],
        ['type' => 'checkbox', 'key' => 'show_toggle', 'label' => 'ডার্ক/লাইট টগল বাটন দেখাও', 'hint' => 'টগল বাটন দেখাবে', 'default' => '1'],
        ['type' => 'checkbox', 'key' => 'dark_default', 'label' => 'ডিফল্ট ডার্ক মোড', 'hint' => 'সাইট প্রথমেই ডার্ক থিমে দেখাবে', 'default' => ''],
        ['type' => 'checkbox', 'key' => 'show_calc', 'label' => 'ক্যালকুলেটর সেকশন দেখাও', 'hint' => 'দেখাবে', 'default' => '1'],
        ['type' => 'checkbox', 'key' => 'show_meet', 'label' => 'মিটিং বুকিং সেকশন দেখাও', 'hint' => 'দেখাবে', 'default' => '1'],
        ['type' => 'checkbox', 'key' => 'show_news', 'label' => 'নিউজলেটার সেকশন দেখাও', 'hint' => 'দেখাবে', 'default' => '1'],
        ['type' => 'checkbox', 'key' => 'show_faq', 'label' => 'FAQ সেকশন দেখাও', 'hint' => 'দেখাবে', 'default' => '1'],
        ['type' => 'email', 'key' => 'notify_email', 'label' => 'নোটিফিকেশন ইমেইল (হিডেন ফিল্ডে সব ফর্মের তথ্য জমা হবে + ইমেইল যাবে)', 'default' => 'avisheksarker63@gmail.com'],
    ];
}

function as_home_default_settings()
{
    $defaults = [];
    foreach (as_home_field_specs() as $spec) {
        if ($spec['key'] === null) {
            continue;
        }
        $defaults[$spec['key']] = $spec['default'] ?? '';
    }
    return $defaults;
}
