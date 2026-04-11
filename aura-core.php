<?php
/**
 * AURA SYSTEM v7.0 - CORE INFRASTRUCTURE
 * Optimized for Bethel Edison (Architecture of Sound & Code)
 * * This file acts as the "Engine Room" for the AURA Terminal.
 */

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. ENQUEUE STYLES & ASSETS
 * Bridges the ScapeRock theme with the AURA Gold-Glow Protocol.
 */
function aura_infrastructure_enqueue_assets() {
    // Standard Theme Styles
    wp_enqueue_style( 'scapeshot-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'scaperock-style', get_stylesheet_directory_uri() . '/style.css', array( 'scapeshot-style' ) );
    
    // AURA System Assets from GitHub Repo
    wp_enqueue_style( 'aura-gold-glow', get_stylesheet_directory_uri() . '/aura-gold-glow.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'aura_infrastructure_enqueue_assets' );

/**
 * 2. STICKY PLAYLIST INTEGRATION
 * Maintains the music-first focus of the ScapeRock environment.
 */
$sticky_playlist_path = trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/sticky-playlist.php';
if ( file_exists( $sticky_playlist_path ) ) {
    require $sticky_playlist_path;
}

/**
 * 3. AURA WIDGET & TERMINAL GENERATOR
 * Generates the GPU-accelerated interface for the AURA Terminal.
 */
function get_be_aura_core_interface() {
    ob_start(); ?>
    <style id="aura-critical-css">
        /* GPU ACCELERATION & LAYER ISOLATION */
        #be-aura-widget, #be-floating-nav { 
            position: fixed !important; 
            z-index: 999999999 !important; 
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        #be-aura-widget { 
            top: 75px !important; 
            left: 20px !important; 
            width: 420px; 
            background: #05050a !important; 
            border: 2px solid #ff9900; 
            border-radius: 24px; 
            padding: 20px; 
            box-shadow: 0 40px 80px rgba(0,0,0,0.9); 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        }

        #be-aura-widget.is-collapsed { 
            width: 65px !important; 
            height: 65px !important; 
            padding: 0 !important; 
            border-radius: 50% !important; 
            background: #ff9900 !important; 
            border: 4px solid #05050a; 
            overflow: hidden; 
        }

        .aura-inner-content { display: block; text-align: center; }
        #be-aura-widget.is-collapsed .aura-inner-content { display: none !important; }

        .aura-toggle-circle { 
            background: transparent !important; 
            border: none !important; 
            cursor: pointer !important; 
            display: flex !important; 
            align-items: center !important; 
            justify-content: center !important; 
            width: 100% !important; 
            height: 100% !important; 
            position: absolute !important; 
            top: 0; left: 0; padding: 0 !important;
        }

        #be-aura-widget:not(.is-collapsed) .aura-toggle-circle { 
            width: 40px !important; 
            height: 40px !important; 
            bottom: 15px !important; 
            right: 20px !important; 
            top: auto !important; 
            left: auto !important; 
            background: #ff9900 !important; 
            border-radius: 50% !important; 
        }

        /* MOBILE OPTIMIZATION for Galaxy A06 / View */
        @media (max-width: 480px) { 
            #be-aura-widget:not(.is-collapsed) { width: 92% !important; left: 4% !important; } 
        }
    </style>

    <div id="be-aura-widget" class="is-collapsed">
        <div class="aura-inner-content">
            <span class="aura-title" style="color:#fff; font-family:monospace; font-size:10px; letter-spacing:2px;">DIVINE ECHOES // BETHEL EDISON</span>
            <div class="be-apple-container" style="margin-top:15px;">
                <iframe allow="autoplay" frameborder="0" height="185" style="width:100%;border-radius:12px;overflow:hidden;" src="https://embed.music.apple.com/us/album/divine-echoes-single/1770195144?ls=1&theme=dark"></iframe>
            </div>
        </div>
        <button class="aura-toggle-circle" onclick="toggleAuraWidget()" aria-label="Toggle Player">
            <i id="toggleIcon" class="fa-solid fa-music" style="color:#000;"></i>
        </button>
    </div>

    <script id="aura-logic">
    function toggleAuraWidget() {
        const w = document.getElementById('be-aura-widget'), i = document.getElementById('toggleIcon');
        if(!w) return;
        w.classList.toggle('is-collapsed');
        i.className = w.classList.contains('is-collapsed') ? 'fa-solid fa-music' : 'fa-solid fa-minus';
    }
    
    // Forced Body Injection for High-Z-Index Priority
    (function() {
        const inject = () => {
            const body = document.body;
            const widget = document.getElementById('be-aura-widget');
            if(body && widget) body.appendChild(widget);
        };
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", inject);
        } else { inject(); }
        setTimeout(inject, 600);
    })();
    </script>
    <?php
    return ob_get_clean();
}

/**
 * 4. SYSTEM INJECTION
 * Forces the AURA logic to fire at the start of the body.
 */
add_action('wp_body_open', function() {
    echo get_be_aura_core_interface();
});

// Fallback for themes missing the wp_body_open hook
add_action('wp_footer', function() {
    if (!did_action('wp_body_open')) {
        echo get_be_aura_core_interface();
    }
}, 1);

/**
 * 5. SHORTCODE [aura_terminal]
 */
add_shortcode('aura_terminal', 'get_be_aura_core_interface');
