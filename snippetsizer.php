<?php
/**
 * Plugin Name: SnippetSizer
 * Description: Shows a small live character counter next to Yoast SEO title and meta description fields.
 * Version: 1.0
 * Author: Darryl de Jong
 */

if (!defined('ABSPATH')) exit;

add_action('admin_enqueue_scripts', function ($hook) {
    if (in_array($hook, ['post.php', 'post-new.php'])) {
        add_action('admin_footer', function () {
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fields = [
                    { id: 'yoast_wpseo_title', labelId: 'snip_title_count' },
                    { id: 'yoast_wpseo_metadesc', labelId: 'snip_desc_count' }
                ];

                fields.forEach(field => {
                    const input = document.getElementById(field.id);
                    if (!input) return;

                    const counter = document.createElement('span');
                    counter.id = field.labelId;
                    counter.style.marginLeft = '10px';
                    counter.style.fontSize = '12px';
                    counter.style.color = '#666';
                    input.parentNode.appendChild(counter);

                    const update = () => {
                        counter.textContent = input.value.length + ' chars';
                    };

                    input.addEventListener('input', update);
                    update();
                });
            });
            </script>
            <?php
        });
    }
});
