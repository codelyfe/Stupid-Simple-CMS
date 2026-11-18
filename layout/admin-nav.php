<?php
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$inFolder = (bool) preg_match('#/(admin|file-manager|help)(/|$)#', $script);
$root = $inFolder ? '../' : '';
$page = basename($script);
$section = '';
if (strpos($script, '/admin/') !== false) $section = 'settings';
elseif (strpos($script, '/file-manager/') !== false) $section = 'files';
elseif ($page === 'add-article.php') $section = 'write';
elseif ($page === 'admin-edit.php') $section = 'articles';
elseif ($page === 'design-blog.php') $section = 'design';
elseif ($page === 'editor-js.php' || $page === 'editor-css.php') $section = 'design';

$steps = [
    'write' => ['Write', $root . 'add-article.php'],
    'articles' => ['Articles', $root . 'admin-edit.php'],
    'settings' => ['Settings', $root . 'admin/'],
    'design' => ['Design', $root . 'design-blog.php'],
    'files' => ['Files', $root . 'file-manager/'],
];
?>
<nav class="admin-steps" aria-label="Admin">
    <?php foreach ($steps as $id => $step): ?>
        <a class="<?php echo $section === $id ? 'is-on' : ''; ?>" href="<?php echo htmlspecialchars($step[1]); ?>"><?php echo $step[0]; ?></a>
    <?php endforeach; ?>
    <a class="step-spacer" href="<?php echo htmlspecialchars($root . 'index.php'); ?>">View blog</a>
    <a href="<?php echo htmlspecialchars($root . 'logout.php'); ?>">Log out</a>
</nav>
