<footer class="site-footer">
    <p>Powered by <a href="https://github.com/codelyfe/Stupid-Simple-CMS" target="_blank" rel="noopener">Stupid Simple CMS</a>
        · Copyright © <?php echo htmlspecialchars((string) $siteCopyright); ?> <?php echo $currentYear; ?></p>
</footer>
<?php
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$a11yRoot = preg_match('#/(admin|file-manager|help)(/|$)#', $scriptName) ? '../' : '';
?>
<script src="<?php echo $a11yRoot; ?>js/a11y-widget.js"></script>
