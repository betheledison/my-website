<?php
/*
Plugin Name: Aura Music & Social Ticker
Plugin URI: https://betheledison.com
Description: Sticky music and social media stats ticker with brand colors (#090913 and #ff9900) and edge-glow.
Version: 1.3
Author: Bethel Edison
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_footer', 'aura_music_ticker_display');

function aura_music_ticker_display() {
    ?>
    <style>
    /* 1. Fixed Container with Glow */
    .aura-ticker-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 2147483647; 
        background-color: #090913;
        overflow: hidden;
        border-top: 2px solid #ff9900;
        box-shadow: 0 -8px 20px rgba(255, 153, 0, 0.4); 
        padding: 12px 0;
        pointer-events: auto;
    }

    /* 2. Animation Logic */
    .aura-ticker-scroll {
        display: flex;
        width: max-content;
        animation: aura-scroll-left 60s linear infinite;
    }

    /* 3. Item Styling */
    .aura-ticker-item {
        flex-shrink: 0;
        padding: 0 40px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .aura-label { color: #ff9900; }
    .aura-val { color: #ffffff; margin-left: 10px; }
    .aura-pct { color: #00ff00; margin-left: 8px; font-size: 11px; }

    /* 4. Infinite Loop Animation */
    @keyframes aura-scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Pause on Hover */
    .aura-ticker-container:hover .aura-ticker-scroll {
        animation-play-state: paused;
    }

    /* Mobile Scale */
    @media (max-width: 600px) {
        .aura-ticker-item { padding: 0 25px; font-size: 12px; }
        .aura-ticker-container { padding: 10px 0; }
    }

    /* Push site content up so ticker doesn't hide anything */
    body { padding-bottom: 70px !important; }
    </style>

    <div class="aura-ticker-container">
        <div class="aura-ticker-scroll">
            <?php
            $items = [
                ['Spotify', '2.4K', '+2.5%'],
                ['Apple Music', '1.2K', '+4.3%'],
                ['YouTube', '543', '+1.1%'],
                ['TikTok', '8.1K', '+15.2%'],
                ['Amazon', '1.04K', '+1.8%'],
                ['Deezer', '2.8K', '+2.7%'],
                ['GitHub', '2.1K', '+1.2%'],
                ['Facebook', '28.4K', '+0.8%'],
                ['Discord', '2.2K', '+2.8%'],
                ['Telegram', '1.1K', '+1.2%'],
                ['Whatsapp', '789', '+0.8%'],
                ['Snapchat', '2.2K', '+3.4%'],
                ['X (Twitter)', '3.5K', '+1.2%'],
                ['Tidal', '176', '+2.1%']
            ];

            // Render twice to make the loop seamless
            for ($i = 0; $i < 2; $i++) {
                foreach ($items as $item) {
                    echo '<div class="aura-ticker-item">';
                    echo '<span class="aura-label">' . $item[0] . '</span>';
                    echo '<span class="aura-val">' . $item[1] . '</span>';
                    echo '<span class="aura-pct">' . $item[2] . '</span>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    <?php
}