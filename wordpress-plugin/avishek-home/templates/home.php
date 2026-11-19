<?php
defined('ABSPATH') || exit;

/** @var array $s */
/** @var Callable $t */
/** @var Callable $f */

$heroName = $f('hero_name', 'Avishek Sarkar');
$scrollLinks = [
    ['Home', '#home'],
    ['About', '#about'],
    ['Skills', '#skills'],
    ['Services', '#services'],
    ['Pricing', '#pricing'],
    ['Portfolio', '#portfolio'],
    ['Contact', '#contact'],
];
$initial = mb_substr($heroName, 0, 1);
?>
<div id="as-home" data-theme="<?php echo as_home_is_on('dark_default') ? 'dark' : 'light'; ?>" style="overflow-x:hidden;">
    <header class="hp-header">
        <div class="container-x hp-nav">
            <a href="#home" class="hp-logo">
                <span class="hp-logo-mark"><?php echo esc_html($initial); ?></span>
                <?php echo esc_html($heroName); ?>
            </a>
            <nav class="hp-links" id="asMenu">
                <?php foreach ($scrollLinks as $link) : ?>
                    <a href="<?php echo esc_attr($link[1]); ?>"><?php echo esc_html($link[0]); ?></a>
                <?php endforeach; ?>
            </nav>
            <div class="hp-actions">
                <?php if (as_home_is_on('show_toggle')) : ?>
                    <button type="button" class="theme-toggle" id="asThemeToggle" aria-label="Toggle dark mode">
                        <span class="as-theme-moon" aria-hidden="true">🌙</span>
                        <span class="as-theme-sun" aria-hidden="true">☀️</span>
                    </button>
                <?php endif; ?>
                <a href="<?php echo esc_attr($f('hero_cta_url', '#contact')); ?>" class="btn btn-primary-hp btn-sm"><?php echo esc_html($f('hero_cta_text', 'Start Your Project')); ?></a>
                <button type="button" class="theme-toggle" id="asMenuToggle" aria-label="Menu" style="display:none;">☰</button>
            </div>
        </div>
    </header>

    <main>
        <section class="hp-hero" id="home">
            <div class="container-x hp-hero-grid">
                <div>
                    <span class="eyebrow"><?php echo esc_html($f('hero_eyebrow', 'Digital Marketing Professional')); ?></span>
                    <h1><span class="gradient-text"><?php echo esc_html($heroName); ?></span></h1>
                    <h2 class="font-display"><?php echo esc_html($f('hero_role', 'Freelance Digital Marketing Expert & Designer')); ?></h2>
                    <p class="sub"><?php echo esc_html($f('hero_subtitle', '')); ?></p>
                    <div class="hp-tags">
                        <?php foreach (as_home_lines($t('hero_tags')) as $tag) : ?>
                            <span><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="hp-actions-row">
                        <a href="<?php echo esc_attr($f('hero_cta_url', '#contact')); ?>" class="btn btn-dark-hp"><?php echo esc_html($f('hero_cta_text', 'Start Your Project')); ?> <span aria-hidden="true">→</span></a>
                        <a href="#portfolio" class="btn btn-outline">View My Work</a>
                    </div>
                </div>
                <div class="portrait-stage">
                    <div class="portrait-back"></div>
                    <div class="portrait-art">
                        <?php if ($t('hero_image') !== '') : ?>
                            <img src="<?php echo esc_url($t('hero_image')); ?>" alt="<?php echo esc_attr($heroName); ?>">
                        <?php else : ?>
                            <svg viewBox="0 0 390 425" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?php echo esc_attr($heroName); ?>">
                                <circle cx="195" cy="150" r="78" fill="#7fd6c9"/>
                                <path d="M40 425 C40 305 120 258 195 258 C270 258 350 305 350 425 Z" fill="#94e0d3"/>
                                <circle cx="170" cy="140" r="8" fill="#0f3d38"/>
                                <circle cx="220" cy="140" r="8" fill="#0f3d38"/>
                                <path d="M172 172 Q195 190 218 172" stroke="#0f3d38" stroke-width="5" fill="none" stroke-linecap="round"/>
                                <path d="M150 120 Q195 96 240 120 L240 104 Q195 78 150 104 Z" fill="#123c44"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <?php if (count($achievements)) : ?>
                        <div class="float-stat hp-shadow top">
                            <strong><?php echo esc_html($achievements[0]['value']); ?></strong>
                            <?php echo esc_html($achievements[0]['label']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (count($achievements) > 1) : ?>
                        <div class="float-stat hp-shadow bottom">
                            <strong><?php echo esc_html($achievements[1]['value']); ?></strong>
                            <?php echo esc_html($achievements[1]['label']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php if (count(as_home_lines($t('platforms')))) : ?>
        <section class="hp-platforms">
            <div class="container-x" style="text-align:center;">
                <span class="eyebrow">Where I Work</span>
                <div class="hp-platform-list">
                    <?php foreach (as_home_lines($t('platforms')) as $platform) : ?>
                        <span><?php echo esc_html($platform); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($achievements)) : ?>
        <section class="section section-alt">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Achievements</span>
                    <h2 class="section-title"><?php echo esc_html($f('achievements_title', 'Numbers Take Our Back')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('achievements_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">
                    <?php foreach ($achievements as $ach) : ?>
                        <article class="card hp-shadow" style="padding:24px;text-align:left;">
                            <span class="iconbox <?php echo esc_attr($ach['tint']); ?>"><span style="font-size:18px;"><?php echo esc_html($ach['emoji']); ?></span></span>
                            <span class="stat-value"><?php echo esc_html($ach['value']); ?></span>
                            <p style="font-size:13px;color:var(--muted);margin:0;"><?php echo esc_html($ach['label']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="section" id="about">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow"><?php echo esc_html($f('about_eyebrow', 'Get to know me')); ?></span>
                    <h2 class="section-title"><?php echo esc_html($f('about_heading', 'About Freelancer Avishek')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('about_intro', '')); ?></p>
                </div>
                <div class="hp-about-grid">
                    <div>
                        <h3 style="margin-top:0;"><?php echo esc_html($f('about_greeting', "Hi, I'm Avishek Sarkar!")); ?></h3>
                        <?php foreach (as_home_lines($t('about_body')) as $line) : ?>
                            <p style="color:var(--muted);"><?php echo esc_html($line); ?></p>
                        <?php endforeach; ?>
                        <h3>What drives me:</h3>
                        <ul class="hp-checks">
                            <?php foreach (as_home_lines($t('about_drives')) as $line) : ?>
                                <li><?php echo esc_html($line); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (count($aboutCards)) : ?>
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">
                        <?php foreach ($aboutCards as $card) : ?>
                            <article class="card hp-shadow mini-card">
                                <span class="iconbox <?php echo esc_attr($card['tint']); ?>" style="font-size:20px;"><?php echo esc_html($card['emoji']); ?></span>
                                <div>
                                    <h3><?php echo esc_html($card['title']); ?></h3>
                                    <p><?php echo esc_html($card['text']); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php if (count($skills)) : ?>
        <section class="section section-alt" id="skills">
            <div class="container-x" style="text-align:center;">
                <span class="eyebrow">Expertise</span>
                <h2 class="section-title"><?php echo esc_html($f('skills_title', 'My Skills')); ?></h2>
                <p class="section-intro"><?php echo esc_html($f('skills_intro', '')); ?></p>
                <div class="hp-skills-box">
                    <?php foreach (array_slice($skills, 0, 8) as $skill) : ?>
                        <div class="skill">
                            <div class="hp-skill-head">
                                <span><?php echo esc_html($skill['name']); ?></span>
                                <span><?php echo esc_html($skill['level']); ?>%</span>
                            </div>
                            <div class="hp-track" role="progressbar" aria-label="<?php echo esc_attr($skill['name']); ?>" aria-valuenow="<?php echo esc_attr($skill['level']); ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="hp-fill" style="width:<?php echo esc_attr(max(5, min(100, $skill['level']))); ?>%;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($services)) : ?>
        <section class="section" id="services">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">What I do</span>
                    <h2 class="section-title"><?php echo esc_html($f('services_title', 'My Services')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('services_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                    <?php foreach ($services as $service) : ?>
                        <article class="card hp-shadow service-card">
                            <span class="iconbox"><span style="font-size:20px;"><?php echo esc_html($service['icon']); ?></span></span>
                            <h3><?php echo esc_html($service['title']); ?></h3>
                            <p><?php echo esc_html($service['desc']); ?></p>
                            <ul>
                                <?php foreach ($service['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="#contact" class="btn btn-primary-hp full">Get Started</a>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="hp-banner">
                    <h3><?php echo esc_html($f('services_banner_title', 'Ready to Transform Your Business?')); ?></h3>
                    <p><?php echo esc_html($f('services_banner_text', '')); ?></p>
                    <a class="btn btn-primary-hp" href="#contact">Start Your Project</a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($packages)) : ?>
        <section class="section section-alt" id="pricing">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Simple plans</span>
                    <h2 class="section-title"><?php echo esc_html($f('pricing_title', 'Pricing Packages')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('pricing_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                    <?php foreach ($packages as $package) : ?>
                        <article class="card hp-shadow hp-price-card <?php echo $package['featured'] ? 'featured' : ''; ?>">
                            <?php if ($package['badge'] !== '') : ?>
                                <span class="hp-popular"><?php echo esc_html($package['badge']); ?></span>
                            <?php endif; ?>
                            <h3 style="margin:0;font-size:17px;"><?php echo esc_html($package['name']); ?></h3>
                            <div class="hp-price"><?php echo esc_html($package['price']); ?><small><?php echo esc_html($package['unit']); ?></small></div>
                            <p style="font-size:12px;color:var(--muted);"><?php echo esc_html($package['desc']); ?></p>
                            <ul class="hp-price-list">
                                <?php foreach ($package['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a class="btn <?php echo $package['featured'] ? 'btn-primary-hp' : 'btn-outline'; ?> full" href="#contact">Get Started</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (as_home_is_on('show_calc') && count($calc)) : ?>
        <section class="section" id="calculator">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Build your package</span>
                    <h2 class="section-title"><?php echo esc_html($f('calc_title', 'Custom Pricing Calculator')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('calc_intro', '')); ?></p>
                </div>
                <div id="calc-filters" class="hp-filters"></div>
                <div class="hp-calculator">
                    <div id="calc-options" class="hp-calc-options"></div>
                    <aside class="card hp-shadow hp-calc-summary">
                        <h3>Your Package</h3>
                        <p id="calc-empty" style="color:var(--muted);font-size:13px;">Select services to build your package.</p>
                        <ul id="calc-selected" class="hp-selected-list"></ul>
                        <p id="calc-discount" class="hp-discount"></p>
                        <div class="hp-total-row">
                            <span>Estimated total</span>
                            <strong id="calc-total"><?php echo esc_html($data['currency']); ?>0</strong>
                        </div>
                        <a class="btn btn-primary-hp full" href="#contact">Discuss My Package</a>
                        <p style="font-size:11px;color:var(--muted);"><?php echo esc_html($f('calc_note', '')); ?></p>
                    </aside>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($portfolio)) : ?>
        <section class="section section-alt" id="portfolio">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Selected work</span>
                    <h2 class="section-title"><?php echo esc_html($f('portfolio_title', 'My Portfolio')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('portfolio_intro', '')); ?></p>
                </div>
                <div class="hp-filters">
                    <button type="button" class="hp-filter active" data-filter="all">All Projects</button>
                    <?php foreach (array_values(array_unique(wp_list_pluck($portfolio, 'category'))) as $category) : ?>
                        <?php if ($category !== '') : ?>
                            <button type="button" class="hp-filter" data-filter="<?php echo esc_attr($category); ?>"><?php echo esc_html($category); ?></button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div id="portfolio-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                    <?php foreach ($portfolio as $project) : ?>
                        <article class="card hp-shadow portfolio-card portfolio-item" data-category="<?php echo esc_attr($project['category']); ?>">
                            <div class="portfolio-visual" aria-hidden="true"><span style="font-size:40px;z-index:1;"><?php echo esc_html($project['icon']); ?></span></div>
                            <div class="portfolio-body">
                                <?php if ($project['category'] !== '') : ?>
                                    <span class="hp-chips" style="margin-bottom:8px;"><span><?php echo esc_html($project['category']); ?></span></span>
                                <?php endif; ?>
                                <h3><?php echo esc_html($project['title']); ?></h3>
                                <p><?php echo esc_html($project['desc']); ?></p>
                                <a href="#contact" class="btn btn-outline small full">Discuss a Similar Project</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="hp-banner">
                    <h3><?php echo esc_html($f('portfolio_banner_title', 'Like What You See?')); ?></h3>
                    <p><?php echo esc_html($f('portfolio_banner_text', '')); ?></p>
                    <a href="#contact" class="btn btn-primary-hp">Let's Work Together</a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($cases)) : ?>
        <section class="section" id="case-studies">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Proven impact</span>
                    <h2 class="section-title"><?php echo esc_html($f('case_title', 'Case Studies')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('case_intro', '')); ?></p>
                </div>
                <div style="display:grid;gap:20px;">
                    <?php foreach ($cases as $case) : ?>
                        <article class="card hp-shadow case-card">
                            <div>
                                <span class="eyebrow"><?php echo esc_html($case['client']); ?></span>
                                <h3><?php echo esc_html($case['title']); ?></h3>
                                <p><strong>Challenge:</strong><br><?php echo esc_html($case['challenge']); ?></p>
                                <p><strong>Solution:</strong><br><?php echo esc_html($case['solution']); ?></p>
                            </div>
                            <div class="case-grid">
                                <?php foreach ($case['metrics'] as $metric) : ?>
                                    <div class="case-metric">
                                        <strong><?php echo esc_html($metric['value']); ?></strong>
                                        <small><?php echo esc_html($metric['label']); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($testimonials)) : ?>
        <section class="section section-alt" id="testimonials">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Kind words</span>
                    <h2 class="section-title"><?php echo esc_html($f('testi_title', 'Client Testimonials')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('testi_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                    <?php foreach ($testimonials as $testimonial) : ?>
                        <article class="card hp-shadow quote-card" style="padding:24px;">
                            <div class="stars" aria-label="<?php echo esc_attr($testimonial['rating']) . '/5'; ?>"><?php echo esc_html($testimonial['stars']); ?></div>
                            <blockquote>“<?php echo esc_html($testimonial['quote']); ?>”</blockquote>
                            <strong><?php echo esc_html($testimonial['name']); ?></strong>
                            <small><?php echo esc_html($testimonial['role']); ?></small>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="section" id="video">
            <div class="container-x" style="text-align:center;">
                <span class="eyebrow">A quick introduction</span>
                <h2 class="section-title"><?php echo esc_html($f('video_title', 'Video Introduction')); ?></h2>
                <p class="section-intro"><?php echo esc_html($f('video_intro', '')); ?></p>
                <div class="hp-intro-panel">
                    <div>
                        <?php $videoEmbed = $t('video_embed'); ?>
                        <?php if ($videoEmbed !== '' && stripos($videoEmbed, 'youtu') !== false) : ?>
                            <?php
                            preg_match('/.*(?:v=|youtu\.be\/|shorts\/|embed\/)([A-Za-z0-9_-]{6,}).*/', $videoEmbed, $matches);
                            $videoId = $matches[1] ?? '';
                            ?>
                            <?php if ($videoId !== '') : ?>
                                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($videoId); ?>" title="Introduction" allowfullscreen></iframe>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="iconbox" style="margin:auto;font-size:26px;">🎬</div>
                            <h3 style="font-size:24px;">Meet <?php echo esc_html($heroName); ?></h3>
                            <p><?php echo esc_html($f('video_text', '')); ?></p>
                        <?php endif; ?>
                        <a href="#contact" class="btn btn-primary-hp" style="margin-top:20px;">Start a Conversation</a>
                    </div>
                </div>
            </div>
        </section>

        <?php if (count(as_home_lines($t('profiles_buttons')))) : ?>
        <section class="section section-alt" id="profiles">
            <div class="container-x" style="text-align:center;">
                <span class="eyebrow">Let's connect</span>
                <h2 class="section-title"><?php echo esc_html($f('profiles_title', 'Freelance Profiles')); ?></h2>
                <p class="section-intro"><?php echo esc_html($f('profiles_intro', '')); ?></p>
                <div class="hp-actions-row" style="justify-content:center;">
                    <?php foreach (as_home_lines($t('profiles_buttons')) as $line) : ?>
                        <?php list($label, $url) = as_home_row($line, 2); ?>
                        <a class="btn btn-primary-hp" href="<?php echo esc_attr($url !== '' ? $url : '#contact'); ?>"><?php echo esc_html($label); ?> <span aria-hidden="true">↗</span></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (count($insights)) : ?>
        <section class="section" id="insights">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Ideas &amp; inspiration</span>
                    <h2 class="section-title"><?php echo esc_html($f('insights_title', 'Latest Insights')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('insights_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                    <?php foreach ($insights as $insight) : ?>
                        <article class="card hp-shadow hp-insight" style="padding:24px;">
                            <?php if ($insight['tag'] !== '') : ?>
                                <span class="as-tag"><?php echo esc_html($insight['tag']); ?></span>
                            <?php endif; ?>
                            <h3><?php echo esc_html($insight['title']); ?></h3>
                            <p><?php echo esc_html($insight['short']); ?></p>
                            <div class="hp-insight-extra">
                                <p><?php echo esc_html($insight['extra']); ?></p>
                            </div>
                            <button class="text-link" type="button">Read More →</button>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (as_home_is_on('show_faq') && count($faqs)) : ?>
        <section class="section section-alt" id="faq" lang="bn">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">FAQ</span>
                    <h2 class="section-title"><?php echo esc_html($f('faq_title', 'সচরাচর জিজ্ঞাসিত প্রশ্নাবলী')); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('faq_intro', '')); ?></p>
                </div>
                <div class="faq-list">
                    <?php foreach ($faqs as $faq) : ?>
                        <details class="faq-item">
                            <summary><?php echo esc_html($faq['q']); ?></summary>
                            <p><?php echo esc_html($faq['a']); ?></p>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if (as_home_is_on('show_meet') && count($meeting)) : ?>
        <section class="section" id="meeting">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Book a meeting</span>
                    <h2 class="section-title"><?php echo esc_html($f('meeting_title', "Let's Talk About Your Goals")); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('meeting_intro', '')); ?></p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;" id="meeting-choices">
                    <?php foreach ($meeting as $i => $option) : ?>
                        <article class="card hp-shadow meeting-card <?php echo $i === 0 ? 'selected' : ''; ?>">
                            <div class="iconbox <?php echo esc_attr($option['tint']); ?>" style="margin:auto;font-size:20px;"><?php echo esc_html($option['emoji']); ?></div>
                            <h3><?php echo esc_html($option['name']); ?></h3>
                            <p><?php echo esc_html($option['desc']); ?></p>
                            <strong><?php echo esc_html($option['price']); ?></strong>
                            <button class="btn <?php echo $i === 0 ? 'btn-primary-hp' : 'btn-outline'; ?> full meeting-choice" data-meeting="<?php echo esc_attr($option['name']); ?>" type="button">Select</button>
                        </article>
                    <?php endforeach; ?>
                </div>
                <form id="meeting-form" class="card hp-shadow hp-meeting-form">
                    <h3>Request a Meeting</h3>
                    <p style="font-size:12px;color:var(--muted);">Selected: <strong id="meeting-selected"><?php echo esc_html($meeting[0]['name']); ?></strong>. <?php echo esc_html($f('meeting_note', '')); ?></p>
                    <input type="hidden" id="meeting-type-input" value="<?php echo esc_attr($meeting[0]['name']); ?>">
                    <div class="form-grid">
                        <div class="field">
                            <label for="meeting-name">Name *</label>
                            <input id="meeting-name" class="input" required autocomplete="name">
                        </div>
                        <div class="field">
                            <label for="meeting-email">Email *</label>
                            <input id="meeting-email" type="email" class="input" required autocomplete="email">
                        </div>
                    </div>
                    <div class="field">
                        <label for="meeting-date">Preferred date *</label>
                        <input id="meeting-date" type="date" class="input" required>
                    </div>
                    <div class="field">
                        <label for="meeting-notes">What would you like to discuss?</label>
                        <textarea id="meeting-notes" class="textarea"></textarea>
                    </div>
                    <button class="btn btn-primary-hp" type="submit">Send Meeting Request</button>
                    <p id="meeting-status" class="hp-status" role="status" aria-live="polite"></p>
                </form>
            </div>
        </section>
        <?php endif; ?>

        <?php if (as_home_is_on('show_news')) : ?>
        <section class="hp-newsletter" id="newsletter">
            <div class="container-x" style="text-align:center;">
                <div class="iconbox" style="margin:auto;font-size:20px;">✉️</div>
                <h2 class="section-title"><?php echo esc_html($f('news_title', 'Subscribe to Newsletter')); ?></h2>
                <p class="section-intro"><?php echo esc_html($f('news_intro', '')); ?></p>
                <form id="newsletter-form" class="hp-newsletter-form">
                    <label for="newsletter-email" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);">Email address</label>
                    <input id="newsletter-email" type="email" class="input" placeholder="Enter your email address" required autocomplete="email">
                    <button class="btn btn-primary-hp" type="submit">Subscribe</button>
                </form>
                <p id="newsletter-status" class="hp-status" role="status" aria-live="polite"></p>
            </div>
        </section>
        <?php endif; ?>

        <section class="section" id="contact">
            <div class="container-x">
                <div style="text-align:center;">
                    <span class="eyebrow">Get in touch</span>
                    <h2 class="section-title"><?php echo esc_html($f('contact_title', "Let's Build Something Great")); ?></h2>
                    <p class="section-intro"><?php echo esc_html($f('contact_intro', '')); ?></p>
                </div>
                <div class="contact-grid">
                    <div>
                        <h3>Let's Connect</h3>
                        <p style="color:var(--muted);font-size:14px;">I'm always excited to work on new projects — whether you need a complete digital marketing strategy or just want to discuss an idea, I'm here to help.</p>
                        <?php if ($t('contact_email') !== '') : ?>
                            <div class="card hp-shadow contact-detail">
                                <span class="iconbox" style="font-size:18px;">✉️</span>
                                <div>
                                    <strong>Email</strong>
                                    <a href="mailto:<?php echo esc_attr($t('contact_email')); ?>"><?php echo esc_html($t('contact_email')); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($t('contact_phone') !== '') : ?>
                            <div class="card hp-shadow contact-detail">
                                <span class="iconbox c-blue" style="font-size:18px;">📞</span>
                                <div>
                                    <strong>Phone</strong>
                                    <span><?php echo esc_html($t('contact_phone')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($t('contact_location') !== '') : ?>
                            <div class="card hp-shadow contact-detail">
                                <span class="iconbox c-orange" style="font-size:18px;">📍</span>
                                <div>
                                    <strong>Location</strong>
                                    <span><?php echo esc_html($t('contact_location')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <h3 style="margin-top:22px;">Follow Me</h3>
                        <div class="social-row">
                            <?php foreach (as_home_lines($t('socials')) as $line) : ?>
                                <?php list($label, $url) = as_home_row($line, 2); ?>
                                <?php if ($label !== '') : ?>
                                    <a href="<?php echo esc_attr($url !== '' ? $url : '#contact'); ?>"><?php echo esc_html($label); ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <form id="contact-form" class="card hp-shadow hp-meeting-form" style="margin:0;max-width:none;">
                        <h3 style="margin-top:0;">Send Message</h3>
                        <div class="form-grid">
                            <div class="field">
                                <label for="contact-name">Name *</label>
                                <input id="contact-name" class="input" required autocomplete="name">
                            </div>
                            <div class="field">
                                <label for="contact-email">Email *</label>
                                <input id="contact-email" type="email" class="input" required autocomplete="email">
                            </div>
                        </div>
                        <div class="field">
                            <label for="contact-subject">Subject *</label>
                            <input id="contact-subject" class="input" required placeholder="Project discussion">
                        </div>
                        <div class="field">
                            <label for="contact-message">Message *</label>
                            <textarea id="contact-message" class="textarea" required></textarea>
                        </div>
                        <button class="btn btn-primary-hp full" type="submit">Send Message →</button>
                        <p id="contact-status" class="hp-status" role="status" aria-live="polite"></p>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer-dark">
        <div class="container-x">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:30px;padding:56px 0 0;">
                <div>
                    <h3><?php echo esc_html($heroName); ?></h3>
                    <p><?php echo esc_html($f('footer_about', '')); ?></p>
                </div>
                <div>
                    <h3>Quick Links</h3>
                    <?php foreach (as_home_lines($t('footer_links')) as $line) : ?>
                        <?php list($label, $url) = as_home_row($line, 2); ?>
                        <a href="<?php echo esc_attr($url !== '' ? $url : '#home'); ?>"><?php echo esc_html($label); ?></a>
                    <?php endforeach; ?>
                </div>
                <div>
                    <h3>Services</h3>
                    <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                        <a href="#services"><?php echo esc_html($service['title']); ?></a>
                    <?php endforeach; ?>
                </div>
                <div>
                    <h3>Contact Info</h3>
                    <?php if ($t('contact_email') !== '') : ?>
                        <a href="mailto:<?php echo esc_attr($t('contact_email')); ?>"><?php echo esc_html($t('contact_email')); ?></a>
                    <?php endif; ?>
                    <p><?php echo esc_html($t('contact_phone')); ?></p>
                    <p><?php echo esc_html($t('contact_location')); ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                © <?php echo esc_html(date('Y')); ?> <?php echo esc_html($f('footer_copyright', 'Avishek Sarkar. All rights reserved.')); ?>
            </div>
        </div>
    </footer>
</div>
