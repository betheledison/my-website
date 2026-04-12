<?php
/**
 * AURA SYSTEM CORE COMPONENT
 * Hand-coded for betheledison.com
 */

function get_be_aura_core() {
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
        }
        #be-aura-widget.is-collapsed { width: 65px !important; height: 65px !important; padding: 0 !important; border-radius: 50% !important; background: #ff9900 !important; border: 4px solid #05050a; overflow: hidden; }
        .aura-inner-content { display: block; text-align: center; }
        #be-aura-widget.is-collapsed .aura-inner-content { display: none !important; }
        .aura-toggle-circle { background: transparent !important; border: none !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; width: 100% !important; height: 100% !important; position: absolute !important; top: 0; left: 0; }
        #toggleIcon { color: #000 !important; font-size: 22px !important; }
        @media (max-width: 480px) { #be-aura-widget:not(.is-collapsed) { width: 92% !important; left: 4% !important; } }
    </style>

    <div id="be-aura-widget" class="is-collapsed">
        <div class="aura-inner-content">
            <span class="aura-title" style="color:#ff9900; font-weight:bold; font-size:12px;">DIVINE ECHOES // BETHEL EDISON</span>
            <div style="margin-top:10px;">
                <iframe allow="autoplay" frameborder="0" height="185" style="width:100%;border-radius:12px;overflow:hidden;" src="https://embed.music.apple.com/us/album/divine-echoes-single/1770195144?ls=1&theme=dark"></iframe>
            </div>
        </div>
        <button class="aura-toggle-circle" onclick="toggleAuraWidget()">
            <i id="toggleIcon" class="fa-solid fa-music"></i>
        </button>
    </div>

    <script id="aura-logic">
    function toggleAuraWidget() {
        var w = document.getElementById('be-aura-widget'), i = document.getElementById('toggleIcon');
        w.classList.toggle('is-collapsed');
        i.className = w.classList.contains('is-collapsed') ? 'fa-solid fa-music' : 'fa-solid fa-minus';
    }
    </script>
    <?php
    return ob_get_clean();
}

/**
 * HOOK INTO WORDPRESS
 */
add_action('wp_body_open', function() {
    echo get_be_aura_core();
});

add_shortcode('be_aura_system', function() { return get_be_aura_core(); });

// NOTE: We leave the closing ?> tag out to prevent whitespace errors.
