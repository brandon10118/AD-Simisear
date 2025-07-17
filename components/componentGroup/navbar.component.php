<?php
declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';


function getNavbar(string $activePage): string
{
    // Always start session early
    Auth::init();

    // Load static nav items WITHOUT Add Stock & login
    $pages = require STATICDATA_PATH . '/nav.staticData.php';

    // Get current user (default: guest)
    $user = Auth::user();

    // If logged in admin, add Add Stock
    if ($user && isset($user['role']) && $user['role'] === 'admin') {
        $pages['Add Stock'] = '/page/addstock/index.php';
    }

    // Add login/logout link at the end
    if ($user) {
        $pages['Logout'] = '/handlers/auth.handler.php?action=logout';
    } else {
        $pages['Login'] = '/page/login/index.php';
    }

    // display the navbar
    $html = '<div class="navbar">';
    foreach ($pages as $name => $link) {
        $isActive = ($name === $activePage) ? 'active' : '';
        $html .= '<a href="' . htmlspecialchars($link) . '" class="' . $isActive . '">' . htmlspecialchars($name) . '</a>';
    }
    $html .= '</div>';

    return $html;
}
?>