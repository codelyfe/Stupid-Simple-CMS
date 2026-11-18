<?php
if (!empty($_SERVER['SCRIPT_NAME'])) {
    $cmsBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
    echo '<base href="' . htmlspecialchars($cmsBase, ENT_QUOTES) . '">';
}
?>
<link rel="stylesheet" href="css/custom.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,560&family=Libre+Baskerville:wght@400;700&family=Newsreader:opsz,wght@6..72,500&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    /* Add your custom styles here if needed */
    body {
        /* background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/denim.png') !important; 
            background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/dark_fish_skin.png') !important;*/
    }

    /* Style for mega menu */
    .mega-menu {
        position: static !important;
        list-style: none;
    }

    .mega-menu .dropdown-menu {
        width: 100%;
        padding: 15px;
    }

    .mega-menu .dropdown-menu .row {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    .mega-menu .dropdown-menu .col {
        flex: 1;
        padding: 10px;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!window.jQuery) return;
  jQuery.getJSON('get_content.php', { element: 'all' }, function (theme) {
    if (!theme) return;
    var root = document.documentElement;
    if (theme.accent) root.style.setProperty('--accent', theme.accent);
    if (theme.nav_color) root.style.setProperty('--nav', theme.nav_color);
    if (theme.heading_color) root.style.setProperty('--heading', theme.heading_color);
    if (theme.card_radius) root.style.setProperty('--radius', theme.card_radius + 'px');
    if (theme.overlay !== '') root.style.setProperty('--veil', String(Number(theme.overlay) / 100));
    var faces = { fraunces: '"Fraunces", Georgia, serif', newsreader: '"Newsreader", Georgia, serif', libre: '"Libre Baskerville", Georgia, serif' };
    if (theme.typeface && faces[theme.typeface]) root.style.setProperty('--serif', faces[theme.typeface]);
    if (theme.content_width) root.style.setProperty('--measure', theme.content_width + 'px');
    if (theme.image_height) root.style.setProperty('--photo', theme.image_height + 'px');
  });
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />