<?php
/**
 * Shared helper functions for featured content and taxonomy output.
 */

/**
 * Centralize the featured tag slug so carousel sources stay in one place.
 *
 * @return string
 */
function gakuson_get_featured_tag_slug() {
    return (string) apply_filters('gakuson_featured_tag_slug', 'featured');
}

/**
 * Keep the featured post limit aligned across templates and endpoint payloads.
 *
 * @return int
 */
function gakuson_get_featured_post_limit() {
    return (int) apply_filters('gakuson_featured_post_limit', 5);
}

/**
 * Use one transient key for every carousel payload consumer.
 *
 * @return string
 */
function gakuson_get_carousel_cache_key() {
    return (string) apply_filters('gakuson_carousel_cache_key', 'gakuson_carousel_payload_v1');
}

/**
 * Expose cache TTL from one helper until the final value is agreed.
 *
 * @return int
 */
function gakuson_get_carousel_cache_ttl() {
    return (int) apply_filters('gakuson_carousel_cache_ttl', 5 * MINUTE_IN_SECONDS);
}

/**
 * Reuse the same featured-post query for front-page rendering and the REST layer.
 *
 * @param array $args Optional query overrides.
 * @return WP_Post[]
 */
function gakuson_get_featured_posts($args = array()) {
    $defaults = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => gakuson_get_featured_post_limit(),
        'tag_slug__in'        => array(gakuson_get_featured_tag_slug()),
        'ignore_sticky_posts' => true,
        'orderby'             => 'date',
        'order'               => 'DESC',
        'no_found_rows'       => true,
    );

    return get_posts(wp_parse_args($args, $defaults));
}

/**
 * Keep the excerpt rule shared between the WP theme and future JSON output.
 *
 * @param WP_Post|int|null $post Optional post object or ID.
 * @return string
 */
function gakuson_get_carousel_excerpt($post = null) {
    $post = get_post($post);

    if (! $post instanceof WP_Post) {
        return '';
    }

    $manual_excerpt = trim((string) $post->post_excerpt);

    if ('' !== $manual_excerpt) {
        return wp_strip_all_tags($manual_excerpt);
    }

    $length  = (int) apply_filters('gakuson_carousel_excerpt_length', 110, $post);
    $content = wp_strip_all_tags(strip_shortcodes((string) $post->post_content));

    if ('' === $content) {
        return '';
    }

    return wp_html_excerpt($content, $length, '...');
}

/**
 * Use the first assigned category as the shared carousel category label.
 *
 * @param WP_Post|int|null $post Optional post object or ID.
 * @return string
 */
function gakuson_get_post_primary_category_name($post = null) {
    $post = get_post($post);

    if (! $post instanceof WP_Post) {
        return '';
    }

    $categories = get_the_category($post->ID);

    if (empty($categories) || is_wp_error($categories)) {
        return '';
    }

    return (string) $categories[0]->name;
}

/**
 * Flatten tag objects to plain text for templates and JSON payloads.
 *
 * @param WP_Post|int|null $post Optional post object or ID.
 * @return string[]
 */
function gakuson_get_post_tag_names($post = null) {
    $post = get_post($post);

    if (! $post instanceof WP_Post) {
        return array();
    }

    $tags = get_the_tags($post->ID);

    if (empty($tags) || is_wp_error($tags)) {
        return array();
    }

    $tag_names = array();

    foreach ($tags as $tag) {
        $tag_names[] = (string) $tag->name;
    }

    return array_values(array_filter($tag_names));
}

/**
 * Keep thumbnail lookup in one place so fallback behavior can change later.
 *
 * @param WP_Post|int|null $post Optional post object or ID.
 * @param string           $size Image size name.
 * @return string
 */
function gakuson_get_post_thumbnail_url($post = null, $size = 'full') {
    $post = get_post($post);

    if (! $post instanceof WP_Post) {
        return '';
    }

    $thumbnail_url = get_the_post_thumbnail_url($post, $size);

    return $thumbnail_url ? (string) $thumbnail_url : '';
}

/**
 * Build the minimal item payload shared by the future endpoint and front-page UI.
 *
 * @param WP_Post|int|null $post Optional post object or ID.
 * @return array<string, mixed>
 */
function gakuson_build_carousel_item_response($post = null) {
    $post = get_post($post);

    if (! $post instanceof WP_Post) {
        return array();
    }

    $item = array(
        'id'           => (int) $post->ID,
        'title'        => html_entity_decode(wp_strip_all_tags(get_the_title($post)), ENT_QUOTES, get_bloginfo('charset')),
        'url'          => (string) get_permalink($post),
        'category'     => gakuson_get_post_primary_category_name($post),
        'tags'         => gakuson_get_post_tag_names($post),
        'thumbnailUrl' => gakuson_get_post_thumbnail_url($post),
        'excerpt'      => gakuson_get_carousel_excerpt($post),
        'updatedAt'    => (string) get_post_modified_time(DATE_ATOM, true, $post),
    );

    return apply_filters('gakuson_carousel_item_response', $item, $post);
}

/**
 * Keep the endpoint response shape defined once before the route is added.
 *
 * @param WP_Post[]|null $posts Optional posts to shape.
 * @return array<string, mixed>
 */
function gakuson_build_carousel_response($posts = null) {
    if (null === $posts) {
        $posts = gakuson_get_featured_posts();
    }

    $items = array();

    foreach ($posts as $post) {
        $item = gakuson_build_carousel_item_response($post);

        if (! empty($item)) {
            $items[] = $item;
        }
    }

    $response = array(
        'items' => $items,
    );

    return apply_filters('gakuson_carousel_response', $response, $posts);
}

/**
 * Read the cached response so route code does not duplicate transient logic later.
 *
 * @return array<string, mixed>|null
 */
function gakuson_get_cached_carousel_response() {
    $cached_response = get_transient(gakuson_get_carousel_cache_key());

    return is_array($cached_response) ? $cached_response : null;
}

/**
 * Write carousel payloads through one cache helper so TTL changes stay centralized.
 *
 * @param array $response Response data.
 * @return bool
 */
function gakuson_set_cached_carousel_response($response) {
    if (! is_array($response)) {
        return false;
    }

    $ttl = gakuson_get_carousel_cache_ttl();

    if ($ttl <= 0) {
        return false;
    }

    return set_transient(gakuson_get_carousel_cache_key(), $response, $ttl);
}

/**
 * Clear the shared carousel cache when content changes.
 *
 * @return bool
 */
function gakuson_delete_cached_carousel_response() {
    return delete_transient(gakuson_get_carousel_cache_key());
}

/**
 * Give later endpoint code a single entrypoint for building or refreshing payloads.
 *
 * @param bool $force_refresh Whether to bypass transient cache.
 * @return array<string, mixed>
 */
function gakuson_get_carousel_response($force_refresh = false) {
    if (! $force_refresh) {
        $cached_response = gakuson_get_cached_carousel_response();

        if (is_array($cached_response)) {
            return $cached_response;
        }
    }

    $response = gakuson_build_carousel_response();
    gakuson_set_cached_carousel_response($response);

    return $response;
}

/**
 * Normalize tag cloud defaults so later template cleanup can call one helper.
 *
 * @param array $overrides Optional argument overrides.
 * @return array
 */
function gakuson_get_tag_cloud_args($overrides = array()) {
    $defaults = array(
        'format'   => 'list',
        'smallest' => 1,
        'largest'  => 1,
        'unit'     => 'em',
        'orderby'  => 'count',
        'order'    => 'DESC',
        'number'   => 0,
    );

    return wp_parse_args($overrides, $defaults);
}

/**
 * Turn class strings or arrays into a sanitized, unique class-name list.
 *
 * @param string|string[] $classes Raw classes.
 * @return string[]
 */
function gakuson_parse_class_names($classes) {
    if (is_string($classes)) {
        $classes = preg_split('/\s+/', trim($classes));
    }

    if (! is_array($classes)) {
        return array();
    }

    $normalized_classes = array();

    foreach ($classes as $class_name) {
        $class_name = sanitize_html_class((string) $class_name);

        if ('' !== $class_name) {
            $normalized_classes[] = $class_name;
        }
    }

    return array_values(array_unique($normalized_classes));
}

/**
 * Update an HTML class attribute without rewriting unrelated element attributes.
 *
 * @param string          $attributes       Raw attribute string.
 * @param string|string[] $classes_to_add   Classes to add.
 * @param bool            $replace_existing Whether to replace the existing class list.
 * @return string
 */
function gakuson_update_html_class_attribute($attributes, $classes_to_add, $replace_existing = false) {
    $attributes  = (string) $attributes;
    $class_names = gakuson_parse_class_names($classes_to_add);

    if (preg_match('/\sclass="([^"]*)"/i', $attributes, $matches)) {
        if (! $replace_existing) {
            $class_names = array_merge(gakuson_parse_class_names($matches[1]), $class_names);
            $class_names = array_values(array_unique($class_names));
        }

        if (empty($class_names)) {
            return preg_replace('/\sclass="([^"]*)"/i', '', $attributes, 1);
        }

        return preg_replace(
            '/\sclass="([^"]*)"/i',
            ' class="' . esc_attr(implode(' ', $class_names)) . '"',
            $attributes,
            1
        );
    }

    if (empty($class_names)) {
        return $attributes;
    }

    return rtrim($attributes) . ' class="' . esc_attr(implode(' ', $class_names)) . '"';
}

/**
 * Keep wp_tag_cloud() markup transforms in one place for later template cleanup.
 *
 * @param string $tag_string Tag cloud markup.
 * @param array  $options    Formatting options.
 * @return string
 */
function gakuson_format_tag_cloud_markup($tag_string, $options = array()) {
    $defaults = array(
        'list_class'       => '',
        'item_class'       => '',
        'item_classes'     => array(),
        'link_class'       => '',
        'strip_link_class' => false,
    );

    $options = wp_parse_args($options, $defaults);

    if ('' !== $options['list_class']) {
        $tag_string = preg_replace_callback(
            '/<ul\b([^>]*)>/',
            function ($matches) use ($options) {
                return '<ul' . gakuson_update_html_class_attribute($matches[1], $options['list_class']) . '>';
            },
            $tag_string,
            1
        );
    }

    if ('' !== $options['item_class'] || ! empty($options['item_classes'])) {
        $item_classes = is_array($options['item_classes']) ? array_values($options['item_classes']) : array();
        $item_count   = count($item_classes);
        $index        = 0;

        $tag_string = preg_replace_callback(
            '/<li\b([^>]*)>/',
            function ($matches) use ($options, $item_classes, $item_count, &$index) {
                $class_names = $options['item_class'];

                if ($item_count > 0) {
                    $class_names = array_filter(
                        array(
                            $class_names,
                            $item_classes[$index % $item_count],
                        )
                    );
                }

                $index++;

                return '<li' . gakuson_update_html_class_attribute($matches[1], $class_names) . '>';
            },
            $tag_string
        );
    }

    if ($options['strip_link_class'] || '' !== $options['link_class']) {
        $tag_string = preg_replace_callback(
            '/<a\b([^>]*)>/',
            function ($matches) use ($options) {
                return '<a' . gakuson_update_html_class_attribute(
                    $matches[1],
                    $options['link_class'],
                    (bool) $options['strip_link_class']
                ) . '>';
            },
            $tag_string
        );
    }

    return $tag_string;
}

/**
 * Invalidate the shared carousel cache when post content changes.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function gakuson_invalidate_carousel_cache_on_post_save($post_id) {
    if (wp_is_post_revision($post_id) || 'post' !== get_post_type($post_id)) {
        return;
    }

    gakuson_delete_cached_carousel_response();
}
add_action('save_post_post', 'gakuson_invalidate_carousel_cache_on_post_save');

/**
 * Invalidate the shared carousel cache when terms affecting featured content change.
 *
 * @param int|int[] $object_ids Object IDs being updated.
 * @param int[]     $terms      Term IDs.
 * @param int[]     $tt_ids     Term taxonomy IDs.
 * @param string    $taxonomy   Taxonomy slug.
 * @return void
 */
function gakuson_invalidate_carousel_cache_on_term_change($object_ids, $terms, $tt_ids, $taxonomy) {
    if ('post_tag' !== $taxonomy && 'category' !== $taxonomy) {
        return;
    }

    gakuson_delete_cached_carousel_response();
}
add_action('set_object_terms', 'gakuson_invalidate_carousel_cache_on_term_change', 10, 4);

/**
 * Invalidate the shared carousel cache before a post is deleted.
 *
 * @param int $post_id Deleted post ID.
 * @return void
 */
function gakuson_invalidate_carousel_cache_on_post_delete($post_id) {
    if ('post' !== get_post_type($post_id)) {
        return;
    }

    gakuson_delete_cached_carousel_response();
}
add_action('before_delete_post', 'gakuson_invalidate_carousel_cache_on_post_delete');
