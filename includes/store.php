<?php

function cms_root() {
    return dirname(__DIR__);
}

function db() {
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $dir = cms_root() . '/data';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    $pdo = new PDO('sqlite:' . $dir . '/cms.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS settings (key TEXT PRIMARY KEY, value TEXT)');
    $pdo->exec('CREATE TABLE IF NOT EXISTS articles (
        id INTEGER PRIMARY KEY,
        title TEXT,
        content TEXT,
        image_url TEXT,
        category TEXT,
        created_at TEXT
    )');
    $pdo->exec('CREATE TABLE IF NOT EXISTS assets (name TEXT PRIMARY KEY, body TEXT)');
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (username TEXT PRIMARY KEY, password TEXT)');
    cms_migrate($pdo);
    return $pdo;
}

function cms_migrate(PDO $pdo) {
    $count = (int) $pdo->query('SELECT COUNT(*) FROM settings')->fetchColumn();
    if ($count === 0) {
        $settings = cms_root() . '/admin/site-settings.xml';
        if (is_file($settings)) {
            $xml = simplexml_load_file($settings);
            if ($xml) {
                foreach (['title', 'copyright', 'websiteurl', 'greetingtxt', 'metatxtdesc', 'metaimg'] as $key) {
                    setting_put($key, (string) $xml->{$key}, $pdo);
                }
            }
        }
        $theme = cms_root() . '/theme.xml';
        if (is_file($theme)) {
            $xml = simplexml_load_file($theme);
            if ($xml) {
                foreach ($xml->children() as $child) {
                    setting_put($child->getName(), (string) $child, $pdo);
                }
            }
        }
    }
    $articles = (int) $pdo->query('SELECT COUNT(*) FROM articles')->fetchColumn();
    if ($articles === 0) {
        foreach (glob(cms_root() . '/blog-posts/*.json') ?: [] as $file) {
            $row = json_decode(file_get_contents($file), true);
            if (!is_array($row)) {
                continue;
            }
            $id = (int) pathinfo($file, PATHINFO_FILENAME);
            $stmt = $pdo->prepare('INSERT OR REPLACE INTO articles (id, title, content, image_url, category, created_at) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                $id,
                $row['title'] ?? '',
                $row['content'] ?? '',
                $row['image_url'] ?? '',
                $row['category'] ?? '',
                $row['created_at'] ?? date('Y-m-d H:i:s'),
            ]);
        }
    }
    $users = $pdo->query('SELECT username, password FROM users')->fetchAll(PDO::FETCH_ASSOC);
    $drop = $pdo->prepare('DELETE FROM users WHERE username = ?');
    foreach ($users as $user) {
        if (strpos((string) $user['password'], '$') !== 0) {
            $drop->execute([$user['username']]);
        }
    }
    if (asset_get('custom.css', $pdo) === null && is_file(cms_root() . '/css/custom.css')) {
        asset_put('custom.css', file_get_contents(cms_root() . '/css/custom.css'), $pdo);
    }
    if (asset_get('custom.js', $pdo) === null && is_file(cms_root() . '/js/custom.js')) {
        asset_put('custom.js', file_get_contents(cms_root() . '/js/custom.js'), $pdo);
    }
}

function setting($key, $default = '') {
    $stmt = db()->prepare('SELECT value FROM settings WHERE key = ?');
    $stmt->execute([$key]);
    $value = $stmt->fetchColumn();
    return $value === false ? $default : (string) $value;
}

function setting_put($key, $value, ?PDO $pdo = null) {
    $pdo = $pdo ?: db();
    $stmt = $pdo->prepare('INSERT INTO settings (key, value) VALUES (?, ?) ON CONFLICT(key) DO UPDATE SET value = excluded.value');
    $stmt->execute([$key, $value]);
}

function cms_base_url() {
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
    if (preg_match('#/(admin|file-manager|help)$#', $dir)) {
        $dir = rtrim(str_replace('\\', '/', dirname($dir)), '/');
    }
    if ($dir === '/' || $dir === '.' ) {
        $dir = '';
    }
    return ($https ? 'https' : 'http') . '://' . $host . $dir . '/';
}

function site_settings() {
    return [
        'title' => setting('title', 'Stupid Simple CMS'),
        'copyright' => setting('copyright', ''),
        'websiteurl' => cms_base_url(),
        'greetingtxt' => setting('greetingtxt', ''),
        'metatxtdesc' => setting('metatxtdesc', ''),
        'metaimg' => setting('metaimg', ''),
    ];
}

function articles_all() {
    return db()->query('SELECT * FROM articles ORDER BY created_at DESC, id DESC')->fetchAll(PDO::FETCH_ASSOC);
}

function article_get($id) {
    $stmt = db()->prepare('SELECT * FROM articles WHERE id = ?');
    $stmt->execute([(int) $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function article_create($title, $content, $imageUrl, $category) {
    $stmt = db()->prepare('INSERT INTO articles (title, content, image_url, category, created_at) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$title, $content, $imageUrl, $category, date('Y-m-d H:i:s')]);
    return (int) db()->lastInsertId();
}

function article_update($id, $title, $content, $imageUrl, $category) {
    $stmt = db()->prepare('UPDATE articles SET title = ?, content = ?, image_url = ?, category = ? WHERE id = ?');
    $stmt->execute([$title, $content, $imageUrl, $category, (int) $id]);
    return $stmt->rowCount() > 0;
}

function article_delete($id) {
    $stmt = db()->prepare('DELETE FROM articles WHERE id = ?');
    $stmt->execute([(int) $id]);
    return $stmt->rowCount() > 0;
}

function asset_get($name, ?PDO $pdo = null) {
    $pdo = $pdo ?: db();
    $stmt = $pdo->prepare('SELECT body FROM assets WHERE name = ?');
    $stmt->execute([$name]);
    $value = $stmt->fetchColumn();
    return $value === false ? null : (string) $value;
}

function asset_put($name, $body, ?PDO $pdo = null) {
    $pdo = $pdo ?: db();
    $stmt = $pdo->prepare('INSERT INTO assets (name, body) VALUES (?, ?) ON CONFLICT(name) DO UPDATE SET body = excluded.body');
    $stmt->execute([$name, $body]);
}

function admin_exists() {
    return (int) db()->query('SELECT COUNT(*) FROM users')->fetchColumn() > 0;
}

function user_create($username, $password) {
    $username = trim($username);
    if ($username === '' || $password === '' || admin_exists()) {
        return false;
    }
    $stmt = db()->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
    return true;
}

function user_check($username, $password) {
    $stmt = db()->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $stored = $stmt->fetchColumn();
    return $stored !== false && password_verify((string) $password, (string) $stored);
}

class ThemeBag {
    public function __get($name) {
        return setting($name, '');
    }
}

function theme_bag() {
    static $bag = null;
    if (!$bag) {
        $bag = new ThemeBag();
    }
    return $bag;
}
