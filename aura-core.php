<?php
/*
 * SCAPEROCK CHILD THEME - AURA SYSTEM v7.0 (FORCE TOP-LEVEL PAINT)
 * Optimized for Bethel Edison Emezie / Acode Mobile Environment
 */

/**
 * 1. ENQUEUE STYLES
 * Connects the ScapeShot parent and Scaperock child styles correctly.
 */
function scaperock_enqueue_styles() {
    wp_enqueue_style( 'scapeshot-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'scaperock-style', get_stylesheet_directory_uri() . '/style.css', array( 'scapeshot-style' ) );
}
add_action( 'wp_enqueue_scripts', 'scaperock_enqueue_styles' );

/**
 * 2. LOAD STICKY PLAYLIST COMPONENT
 */
if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/sticky-playlist.php' ) ) {
    require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/sticky-playlist.php';
}

/**
 * 3. CORE COMPONENT - GENERATES THE HTML & CSS
 * This generates the Terminal/Widget and Floating Navigation.
 */
function get_be_aura_core() {
    ob_start(); ?>
    <style id="aura-critical-css">
        /* THE NUCLEAR OPTION: Isolation from theme layers */
        #be-aura-widget, #be-floating-nav { 
            position: fixed !important; 
            z-index: 999999999 !important; 
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            /* Force GPU rendering for instant appearance */
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
            transition: all 0.4s ease; 
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
            top: 0; 
            left: 0; 
            padding: 0 !important; 
            margin: 0 !important; 
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

        #toggleIcon { 
            color: #000 !important; 
            font-size: 22px !important; 
            line-height: 1 !important; 
            margin: 0 !important; 
            display: inline-block !important; 
        }

        #be-floating-nav { 
            bottom: 40px !important; 
            left: 50% !important; 
            transform: translateX(-50%) !important; 
            width: 95% !important; 
            max-width: 520px !important; 
        }

        .aura-pill-nav { 
            background: #fff !important; 
            display: flex !important; 
            justify-content: space-evenly !important; 
            align-items: center !important; 
            padding: 12px 6px !important; 
            border-radius: 100px !important; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.5) !important; 
            border: 1px solid #ddd !important; 
        }

        .aura-pill-item { 
            display: flex !important; 
            flex-direction: column !important; 
            align-items: center !important; 
            text-decoration: none !important; 
            color: #111 !important; 
            flex: 1 !important; 
        }

        .aura-pill-item i { font-size: 18px !important; margin-bottom: 2px !important; }
        .aura-pill-item span { font-size: 9px !important; font-weight: 900 !important; text-transform: uppercase !important; }
        
        .pill-icon-wrap { position: relative; }
        .pill-dot { 
            position: absolute; 
            top: -4px; 
            right: -6px; 
            width: 10px; 
            height: 10px; 
            background: #ff3b30; 
            border-radius: 50%; 
            border: 2px solid #fff; 
            animation: aura-flash 1.5s infinite; 
        }

        @keyframes aura-flash { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
        
        @media (max-width: 480px) { 
            #be-aura-widget:not(.is-collapsed) { width: 92% !important; left: 4% !important; } 
        }
    </style>

    <div id="be-aura-widget" class="is-collapsed">
        <div class="aura-inner-content">
            <span class="aura-title">DIVINE ECHOES // BETHEL EDISON</span>
            <div class="be-apple-container">
                <iframe allow="autoplay" frameborder="0" height="185" style="width:100%;border-radius:12px;overflow:hidden;" src="https://embed.music.apple.com/us/album/divine-echoes-single/1770195144?ls=1&theme=dark"></iframe>
            </div>
        </div>
        <button class="aura-toggle-circle" onclick="toggleAuraWidget()" aria-label="Toggle Player">
            <i id="toggleIcon" class="fa-solid fa-music"></i>
        </button>
    </div>

    <script id="aura-logic">
    function toggleAuraWidget() {
        var w = document.getElementById('be-aura-widget'), i = document.getElementById('toggleIcon');
        if(!w) return;
        w.classList.toggle('is-collapsed');
        i.className = w.classList.contains('is-collapsed') ? 'fa-solid fa-music' : 'fa-solid fa-minus';
    }
    
    // High-speed repositioning logic
    (function() {
        const move = () => {
            const body = document.body;
            if (body) {
                const widget = document.getElementById('be-aura-widget');
                const nav = document.getElementById('be-floating-nav');
                if(widget) body.appendChild(widget);
                if(nav) body.appendChild(nav);
            }
        };
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", move);
        } else { move(); }
        // Force secondary check for themes with slow DOM injection
        setTimeout(move, 500);
    })();
    </script>
    <?php
    return ob_get_clean();
}

/**
 * 4. THE INJECTION: We hook into 'wp_body_open' (WordPress 5.2+) 
 * This puts the code at the VERY TOP of the <body> tag.
 */
add_action('wp_body_open', function() {
    echo get_be_aura_core();
});

/**
 * 5. FALLBACKS
 */
// Shortcode support: [be_aura_system]
add_shortcode('be_aura_system', function() { return get_be_aura_core(); });

// Final Safety Hook (if wp_body_open is missing in the theme)
add_action('wp_footer', function() {
    if (!did_action('wp_body_open')) {
        echo get_be_aura_core();
    }
}, 1);

?>