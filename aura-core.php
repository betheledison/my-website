<?php
/**
 * AURA SYSTEM v7.1 - CORE INFRASTRUCTURE
 * Fixed: Function Name Collision Resolved
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. ENQUEUE ASSETS
 * Using unique naming 'aura_portal_assets' to prevent site crashes.
 */
function aura_portal_assets() {
    // Only load the gold glow if it exists in your theme folder
    wp_enqueue_style( 'aura-gold-glow', get_stylesheet_directory_uri() . '/style.css', array(), '1.1.0' );
}
add_action( 'wp_enqueue_scripts', 'aura_portal_assets', 20 );

/**
 * 2. AURA TERMINAL INTERFACE
 */
function get_be_aura_terminal() {
    ob_start(); ?>
    <style id="aura-critical-css">
        #be-aura-widget { 
            position: fixed !important; 
            z-index: 999999999 !important; 
            top: 75px !important; 
            left: 20px !important; 
            width: 420px; 
            background: #05050a !important; 
            border: 2px solid #ff9900; 
            border-radius: 24px; 
            padding: 20px; 
            box-shadow: 0 40px 80px rgba(0,0,0,0.9); 
            transition: all 0.4s ease;
            transform: translateZ(0);
        }
        #be-aura-widget.is-collapsed { width: 65px !important; height: 65px !important; padding: 0 !important; border-radius: 50% !important; background: #ff9900 !important; }
        .aura-inner-content { display: block; text-align: center; color: #fff; }
        #be-aura-widget.is-collapsed .aura-inner-content { display: none !important; }
        .aura-toggle-circle { background: transparent; border: none; cursor: pointer; width: 100%; height: 100%; position: absolute; top: 0; left: 0; }
        #toggleIcon { color: #000; font-size: 22px; }
        @media (max-width: 480px) { #be-aura-widget:not(.is-collapsed) { width: 92% !important; left: 4% !important; } }
    </style>

    <div id="be-aura-widget" class="is-collapsed">
        <div class="aura-inner-content">
            <span style="font-family:monospace; font-size:10px; letter-spacing:2px;">DIVINE ECHOES // BETHEL EDISON</span>
            <div style="margin-top:15px;">
                <iframe allow="autoplay" frameborder="0" height="185" style="width:100%;border-radius:12px;" src="https://embed.music.apple.com/us/album/divine-echoes-single/1770195144?ls=1&theme=dark"></iframe>
            </div>
        </div>
        <button class="aura-toggle-circle" onclick="toggleAuraWidget()">
            <i id="toggleIcon" class="fa-solid fa-music"></i>
        </button>
    </div>

    <script>
    function toggleAuraWidget() {
        var w = document.getElementById('be-aura-widget'), i = document.getElementById('toggleIcon');
        if(!w) return;
        w.classList.toggle('is-collapsed');
        i.className = w.classList.contains('is-collapsed') ? 'fa-solid fa-music' : 'fa-solid fa-minus';
    }
    </script>
    <?php
    return ob_get_clean();
}

/**
 * 3. INJECTION
 */
add_action('wp_body_open', function() {
    echo get_be_aura_terminal();
});

add_shortcode('aura_terminal', 'get_be_aura_terminal');
