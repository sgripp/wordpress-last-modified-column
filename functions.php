// Add new column
function add_last_modified_author_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $title) {
        $new_columns[$key] = $title;
        if ($key == 'date') {
            $new_columns['last_modified_author'] = 'Last Modified By';
        }
    }
    return $new_columns;
}
add_filter('manage_posts_columns', 'add_last_modified_author_column');
add_filter('manage_pages_columns', 'add_last_modified_author_column');

// Populate new column
function populate_last_modified_author_column($column, $post_id) {
    if ($column == 'last_modified_author') {
        $last_id = get_post_meta($post_id, '_edit_last', true);
        $last_user = get_userdata($last_id);
        echo $last_user->display_name;
    }
}
add_action('manage_posts_custom_column', 'populate_last_modified_author_column', 10, 2);
add_action('manage_pages_custom_column', 'populate_last_modified_author_column', 10, 2);

// Add custom admin CSS
function custom_admin_css() {
    echo '<style>
        .column-last_modified_author { width:150px; }
    </style>';
}
add_action('admin_head', 'custom_admin_css');
