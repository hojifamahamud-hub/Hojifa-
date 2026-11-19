<?php
/**
 * Plugin Name: Avishek Home — Digital Marketing Homepage
 * Description: Canva-ডিজাইনের সম্পূর্ণ ডিজিটাল মার্কেটিং হোমপেজ — [avishek_home] শর্টকোড দিয়ে যেকোনো পেজে বসান। ডার্ক মোড, প্রাইসিং প্যাকেজ, প্রাইস ক্যালকুলেটর, পোর্টফোলিও, কেস স্টাডি, মিটিং বুকিং, নিউজলেটার — সব ওয়ার্ডপ্রেস অ্যাডমিন থেকে কাস্টমাইজযোগ্য।
 * Version: 1.0.0
 * Author: Avishek Sarkar
 * Text Domain: avishek-home
 */

defined('ABSPATH') || exit;

define('AS_HOME_VERSION', '1.0.0');
define('AS_HOME_FILE', __FILE__);
define('AS_HOME_URL', plugin_dir_url(__FILE__));
define('AS_HOME_PATH', plugin_dir_path(__FILE__));

require_once AS_HOME_PATH . 'includes/settings.php';

register_activation_hook(__FILE__, 'as_home_activate');

function as_home_activate()
{
    global $wpdb;
    $table = $wpdb->prefix . 'as_home_requests';
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta("CREATE TABLE {$table} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        type VARCHAR(30) NOT NULL DEFAULT 'contact',
        name VARCHAR(190) NOT NULL DEFAULT '',
        email VARCHAR(190) NOT NULL DEFAULT '',
        subject VARCHAR(190) NOT NULL DEFAULT '',
        message TEXT NULL,
        meeting_type VARCHAR(190) NOT NULL DEFAULT '',
        preferred_date DATE NULL,
        created_at DATETIME NOT NULL,
        PRIMARY KEY  (id),
        KEY type (type),
        KEY created_at (created_at)
    ) " . $wpdb->get_charset_collate() . ';');
}

function as_home_settings()
{
    $saved = get_option('as_home_settings', []);
    return wp_parse_args(is_array($saved) ? $saved : [], as_home_default_settings());
}

function as_home_get($key)
{
    $all = as_home_settings();
    return isset($all[$key]) ? $all[$key] : '';
}

function as_home_is_on($key)
{
    return as_home_get($key) === '1';
}

function as_home_lines($text)
{
    $lines = preg_split('/\R/', (string) $text);
    if (!is_array($lines)) {
        return [];
    }
    return array_values(array_filter(array_map('trim', $lines), function ($line) {
        return $line !== '';
    }));
}

function as_home_row($line, $count)
{
    $parts = array_map('trim', explode('|', $line));
    $safe = [];
    foreach ($parts as $part) {
        $safe[] = (string) $part;
    }
    while (count($safe) < $count) {
        $safe[] = '';
    }
    return array_slice($safe, 0, $count);
}

function as_home_admin_menu()
{
    add_menu_page('Avishek Home', 'Avishek Home', 'manage_options', 'as-home', 'as_home_render_settings_page', 'dashicons-layout', 58);
    add_submenu_page('as-home', 'হোমপেজ কাস্টমাইজ', 'হোমপেজ কাস্টমাইজ', 'manage_options', 'as-home', 'as_home_render_settings_page');
    add_submenu_page('as-home', 'রিকোয়েস্ট / লিড', 'রিকোয়েস্ট / লিড', 'manage_options', 'as-home-requests', 'as_home_render_requests_page');
}
add_action('admin_menu', 'as_home_admin_menu');

function as_home_render_settings_page()
{
    if (!current_user_can('manage_options')) {
        wp_die('You are not allowed to access this page.');
    }

    $saved = false;
    if (isset($_POST['as_home_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['as_home_nonce'])), 'as_home_save')) {
        $input = isset($_POST['as_home']) && is_array($_POST['as_home']) ? wp_unslash($_POST['as_home']) : [];
        $clean = [];
        foreach (as_home_field_specs() as $spec) {
            list($type, $key) = [$spec['type'], $spec['key']];
            if ($type === 'heading' || $key === null) {
                continue;
            }
            if ($type === 'checkbox') {
                $clean[$key] = (isset($input[$key]) && $input[$key]) ? '1' : '';
                continue;
            }
            if ($type === 'lines' || $type === 'textarea') {
                $clean[$key] = sanitize_textarea_field(isset($input[$key]) ? $input[$key] : '');
                continue;
            }
            if ($type === 'url') {
                $clean[$key] = esc_url_raw(isset($input[$key]) ? $input[$key] : '');
                continue;
            }
            if ($type === 'number') {
                $clean[$key] = (string) (int) (isset($input[$key]) ? $input[$key] : 0);
                continue;
            }
            $clean[$key] = sanitize_text_field(isset($input[$key]) ? $input[$key] : '');
        }
        update_option('as_home_settings', $clean, false);
        $saved = true;
    }

    $values = as_home_settings();
    ?>
    <div class="wrap">
        <h1>Avishek Home — হোমপেজ কাস্টমাইজ</h1>
        <p style="max-width:760px;">ব্যবহার: যে পেজকে হোমপেজ বানাবেন সেখানে শুধু <code>[avishek_home]</code> লিখুন (অথবা Appearance → Customize → Homepage Settings থেকে সেই পেজকে হোমপেজ করে দিন)। নিচের সবকিছু বদলালে সাথে সাথে সাইটে চলে আসবে। তালিকার ফিল্ডগুলোতে <strong>প্রতি লাইনে একটি করে আইটেম</strong> লিখুন, ফিল্ডের নিচে ফরম্যাট লেখা আছে।</p>
        <?php if ($saved) : ?>
            <div class="notice notice-success is-dismissible"><p><strong>সেভ হয়ে গেছে ✅</strong> সাইট রিফ্রেশ করে দেখুন।</p></div>
        <?php endif; ?>
        <form method="post" action="">
            <?php wp_nonce_field('as_home_save', 'as_home_nonce'); ?>
            <?php
            foreach (as_home_field_specs() as $spec) {
                $key = $spec['key'];
                $val = $key !== null ? (isset($values[$key]) ? (string) $values[$key] : '') : '';

                if ($spec['type'] === 'heading') {
                    echo '<h2 style="margin-top:28px;padding-top:16px;border-top:2px solid #e2e8f0;">' . esc_html($spec['label']) . '</h2>';
                    echo '<table class="form-table" role="presentation">';
                    continue;
                }

                echo '<tr>';
                echo '<th scope="row"><label for="as_' . esc_attr((string) $key) . '">' . esc_html($spec['label']) . '</label></th>';
                echo '<td>';
                if ($spec['type'] === 'text' || $spec['type'] === 'url' || $spec['type'] === 'number') {
                    echo '<input type="text" class="regular-text" id="as_' . esc_attr((string) $key) . '" name="as_home[' . esc_attr((string) $key) . ']" value="' . esc_attr($val) . '">';
                } elseif ($spec['type'] === 'checkbox') {
                    echo '<label><input type="checkbox" value="1" ' . checked($val, '1', false) . ' name="as_home[' . esc_attr((string) $key) . ']"> ' . esc_html(isset($spec['hint']) ? $spec['hint'] : 'হ্যাঁ') . '</label>';
                } else {
                    echo '<textarea class="large-text" rows="' . esc_attr(isset($spec['rows']) ? $spec['rows'] : 3) . '" id="as_' . esc_attr((string) $key) . '" name="as_home[' . esc_attr((string) $key) . ']">' . esc_textarea($val) . '</textarea>';
                }
                if ($spec['type'] !== 'checkbox' && !empty($spec['hint'])) {
                    echo '<p class="description">' . wp_kses_post($spec['hint']) . '</p>';
                }
                echo '</td></tr>';
            }
            ?>
            <?php submit_button('সবকিছু সেভ করুন'); ?>
        </form>
    </div>
    <?php
}

function as_home_render_requests_page()
{
    global $wpdb;
    if (!current_user_can('manage_options')) {
        wp_die('You are not allowed to access this page.');
    }

    $table = $wpdb->prefix . 'as_home_requests';
    if (isset($_GET['delete'], $_GET['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'as_home_delete_' . (int) $_GET['delete'])) {
        $wpdb->delete($table, ['id' => (int) $_GET['delete']], ['%d']);
        echo '<div class="notice notice-success is-dismissible"><p>ডিলিট হয়ে গেছে।</p></div>';
    }

    $rows = $wpdb->get_results("SELECT * FROM {$table} ORDER BY id DESC LIMIT 300");
    ?>
    <div class="wrap">
        <h1>রিকোয়েস্ট / লিড (সর্বশেষ ৩০০)</h1>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>সময়</th><th>ধরন</th><th>নাম</th><th>ইমেইল</th><th>বিষয়</th><th>মিটিং / তারিখ</th><th>মেসেজ</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$rows) : ?>
                    <tr><td colspan="8">এখনো কোনো সাবমিশন আসেনি।</td></tr>
                <?php endif; ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo esc_html(mysql2date('d M Y, H:i', $row->created_at)); ?></td>
                        <td><?php echo esc_html($row->type); ?></td>
                        <td><?php echo esc_html($row->name); ?></td>
                        <td><a href="mailto:<?php echo esc_attr($row->email); ?>"><?php echo esc_html($row->email); ?></a></td>
                        <td><?php echo esc_html($row->subject); ?></td>
                        <td><?php echo esc_html(trim($row->meeting_type . ' ' . $row->preferred_date)); ?></td>
                        <td><?php echo esc_html(wp_trim_words(wp_strip_all_tags((string) $row->message), 18)); ?></td>
                        <td><a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=as-home-requests&delete=' . (int) $row->id), 'as_home_delete_' . (int) $row->id)); ?>" onclick="return confirm('ডিলিট করবেন?');">✕</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function as_home_rest_submit($request)
{
    $type = sanitize_key($request->get_param('type'));
    if (!in_array($type, ['contact', 'meeting', 'newsletter'], true)) {
        return new WP_Error('as_home_bad_type', 'Unknown request type.', ['status' => 400]);
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '0.0.0.0';
    $bucket = 'as_home_rl_' . md5($ip . '|' . $type);
    $hits = (int) get_transient($bucket);
    if ($hits >= 6) {
        return new WP_Error('as_home_slow', 'Too many requests. Please try again in a minute.', ['status' => 429]);
    }
    set_transient($bucket, $hits + 1, MINUTE_IN_SECONDS);

    $name = sanitize_text_field((string) $request->get_param('name'));
    $email = sanitize_email((string) $request->get_param('email'));
    $subject = sanitize_text_field((string) $request->get_param('subject'));
    $message = sanitize_textarea_field((string) $request->get_param('message'));
    $meetingType = sanitize_text_field((string) $request->get_param('meeting_type'));
    $preferredDate = sanitize_text_field((string) $request->get_param('preferred_date'));

    if ($type !== 'newsletter') {
        if ($name === '' || !is_email($email)) {
            return new WP_Error('as_home_invalid', 'Please provide a valid name and email.', ['status' => 422]);
        }
        if ($type === 'meeting' && $meetingType === '') {
            return new WP_Error('as_home_invalid', 'Please choose a meeting type.', ['status' => 422]);
        }
        if ($type === 'meeting') {
            $today = (new DateTime('today'))->format('Y-m-d');
            if ($preferredDate !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $preferredDate) && $preferredDate < $today) {
                return new WP_Error('as_home_date', 'Please choose today or a future date.', ['status' => 422]);
            }
        }
    } else {
        $email = $email !== '' ? $email : sanitize_email($name);
        if (!is_email($email)) {
            return new WP_Error('as_home_email', 'Please enter a valid email address.', ['status' => 422]);
        }
    }

    global $wpdb;
    $wpdb->insert($wpdb->prefix . 'as_home_requests', [
        'type' => $type,
        'name' => $name === '' ? ($subject === 'Newsletter subscription' ? '' : $name) : $name,
        'email' => $email,
        'subject' => $subject !== '' ? $subject : ucfirst($type) . ' request',
        'message' => $message,
        'meeting_type' => $meetingType,
        'preferred_date' => $preferredDate !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $preferredDate) ? $preferredDate : null,
        'created_at' => current_time('mysql'),
    ], ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']);

    $notify = as_home_get('notify_email');
    if ($notify !== '' && is_email($notify)) {
        @wp_mail(
            $notify,
            '[Avishek Home] নতুন ' . $type . ' রিকোয়েস্ট' . ($name !== '' ? ' — ' . $name : ''),
            "N: $name\nE: $email\nSubject: $subject\nWhen: $meetingType $preferredDate\n\n$message"
        );
    }

    $messages = [
        'contact' => 'Your message was sent. Thank you for reaching out!',
        'meeting' => "Your meeting request was sent. I'll confirm the details by email.",
        'newsletter' => 'Thanks for subscribing!',
    ];

    return ['ok' => true, 'message' => $messages[$type]];
}

add_action('rest_api_init', function () {
    register_rest_route('avishek-home/v1', '/submit', [
        'methods' => 'POST',
        'permission_callback' => '__return_true',
        'callback' => 'as_home_rest_submit',
    ]);
});

function as_home_assets()
{
    wp_enqueue_style(
        'as-home-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style('as-home', AS_HOME_URL . 'assets/home.css', [], AS_HOME_VERSION);
    wp_enqueue_script('as-home-lucide', 'https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js', [], null, true);
    wp_enqueue_script('as-home', AS_HOME_URL . 'assets/home.js', ['as-home-lucide'], AS_HOME_VERSION, true);
}

function as_home_shortcode()
{
    as_home_assets();

    $s = as_home_settings();
    $t = function ($key) use ($s) {
        return isset($s[$key]) ? trim((string) $s[$key]) : '';
    };
    $f = function ($key, $fallback) use ($t) {
        $value = $t($key);
        return $value !== '' ? $value : $fallback;
    };

    $skills = [];
    foreach (as_home_lines($t('skills')) as $line) {
        list($name, $level) = as_home_row($line, 2);
        $skills[] = ['name' => $name, 'level' => max(1, min(100, (int) $level))];
    }

    $services = [];
    foreach (as_home_lines($t('services')) as $line) {
        list($title, $desc, $features, $icon) = as_home_row($line, 4);
        $services[] = [
            'title' => $title,
            'desc' => mb_substr($desc, 0, 130),
            'features' => array_slice(array_filter(array_map('trim', explode(',', $features))), 0, 6),
            'icon' => $icon !== '' ? $icon : '✦',
        ];
    }

    $packages = [];
    foreach (as_home_lines($t('pricing')) as $line) {
        $row = as_home_row($line, 6);
        $packages[] = [
            'name' => $row[0],
            'price' => $row[1],
            'unit' => $row[2],
            'desc' => $row[3],
            'features' => array_filter(array_map('trim', explode(';', $row[4]))),
            'featured' => $row[5] === '1',
            'badge' => $row[5] === '1' ? 'MOST POPULAR' : '',
        ];
    }

    $calc = [];
    foreach (as_home_lines($t('calc')) as $line) {
        list($name, $category, $price) = as_home_row($line, 3);
        $calc[] = ['name' => $name, 'category' => $category, 'price' => (int) $price];
    }

    $portfolio = [];
    foreach (as_home_lines($t('portfolio')) as $line) {
        list($title, $desc, $category, $icon) = as_home_row($line, 4);
        $portfolio[] = [
            'title' => $title,
            'desc' => mb_substr($desc, 0, 110),
            'category' => $category,
            'icon' => $icon !== '' ? $icon : '🖼️',
        ];
    }

    $cases = [];
    foreach (as_home_lines($t('cases')) as $line) {
        list($client, $title, $challenge, $solution, $metricsRaw) = as_home_row($line, 5);
        $metrics = [];
        foreach (array_filter(array_map('trim', explode(',', $metricsRaw))) as $metric) {
            list($value, $label) = as_home_row($metric, 2);
            if ($value !== '') {
                $metrics[] = ['value' => $value, 'label' => $label];
            }
        }
        $cases[] = [
            'client' => $client,
            'title' => $title,
            'challenge' => $challenge,
            'solution' => $solution,
            'metrics' => array_slice($metrics, 0, 4),
        ];
    }

    $testimonials = [];
    foreach (as_home_lines($t('testimonials')) as $line) {
        $row = as_home_row($line, 4);
        $rating = max(1, min(5, (int) ($row[3] !== '' ? $row[3] : 5)));
        $testimonials[] = [
            'quote' => $row[0],
            'name' => $row[1],
            'role' => $row[2],
            'rating' => $rating,
            'stars' => str_repeat('★', $rating) . str_repeat('☆', 5 - $rating),
        ];
    }

    $insights = [];
    foreach (as_home_lines($t('insights')) as $line) {
        list($tag, $title, $short, $extra) = as_home_row($line, 4);
        $insights[] = [
            'tag' => $tag,
            'title' => $title,
            'short' => mb_substr($short, 0, 120),
            'extra' => $extra,
        ];
    }

    $faqs = [];
    foreach (as_home_lines($t('faqs')) as $line) {
        list($question, $answer) = as_home_row($line, 2);
        $faqs[] = ['q' => $question, 'a' => $answer];
    }

    $meeting = [];
    foreach (as_home_lines($t('meeting_options')) as $line) {
        list($name, $desc, $price) = as_home_row($line, 3);
        if ($name !== '') {
            $meeting[] = [
                'name' => $name,
                'desc' => $desc,
                'price' => $price !== '' ? $price : 'Free',
                'emoji' => ['💬', '🎬', '🚀'][count($meeting) % 3],
                'tint' => ['', 'c-purple', 'c-blue'][count($meeting) % 3],
            ];
        }
    }

    $achievements = [];
    foreach (as_home_lines($t('achievements')) as $line) {
        list($value, $label, $emoji) = as_home_row($line, 3);
        if ($value !== '') {
            $icons = ['💼', '👥', '🏆', '📈'];
            $achievements[] = [
                'value' => $value,
                'label' => $label,
                'emoji' => $emoji !== '' ? $emoji : $icons[count($achievements) % 4],
                'tint' => ['c-blue', 'c-purple', 'c-orange', ''][count($achievements) % 4],
            ];
        }
    }

    $aboutCards = [];
    foreach (as_home_lines($t('about_cards')) as $line) {
        list($title, $text, $emoji) = as_home_row($line, 3);
        if ($title !== '') {
            $aboutCards[] = [
                'title' => $title,
                'text' => mb_substr($text, 0, 90),
                'emoji' => $emoji !== '' ? $emoji : '⚡',
                'tint' => ['c-purple', 'c-blue', 'c-orange', ''][count($aboutCards) % 4],
            ];
        }
    }

    $data = [
        'restUrl' => esc_url_raw(rest_url('avishek-home/v1/submit')),
        'nonce' => wp_create_nonce('wp_rest'),
        'currency' => $t('currency') !== '' ? $t('currency') : '$',
        'discountPercent' => max(0, (int) $t('calc_discount_percent')),
        'discountMinItems' => max(1, (int) $t('calc_discount_min_items')),
        'calcLabelAll' => 'All Services',
        'bundleDiscount' => 'Bundle discount (:percent%): −:amount',
        'strings' => [
            'sending' => 'Sending…',
            'requestError' => 'The form is temporarily unavailable. Please try again later or email me directly.',
        ],
        'data' => [
            'calc' => $calc,
            'meeting' => $meeting,
        ],
    ];

    wp_localize_script('as-home', 'AS_HOME', $data);

    ob_start();
    include AS_HOME_PATH . 'templates/home.php';
    return ob_get_clean();
}
add_shortcode('avishek_home', 'as_home_shortcode');

add_action('wp_head', function () {
    echo '<style>html{scroll-behavior:smooth}</style>';
}, 99);
