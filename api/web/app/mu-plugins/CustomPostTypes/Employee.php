<?php namespace PhilippBaschke\WordPressApiExample\MU\CustomPostTypes;

class Employee extends Base\AbstractPostTypeWithTaxonomies
{
    public function registerPostType()
    {
        register_post_type($this->postType, [
            'labels' => [
                'name' => __('Employees', $this->postType),
                'singular_name' => __('Employee', $this->postType),
                'add_new_item' => __('Add New Employee', $this->postType),
                'edit_item' => __('Edit Employee', $this->postType),
                'new_item' => __('New Employee', $this->postType),
                'view_item' => __('View Employee', $this->postType),
                'search_item' => __('Search Employees', $this->postType),
                'not_found' => __('No employees found.', $this->postType),
                'not_found_in_trash' => __(
                    'No employees found in Trash.',
                    $this->postType
                ),
                'all_itmes' => __('All Employees', $this->postType),
                'archives' => __('Employee Archives', $this->postType),
                'insert_into_item' => __(
                    'Insert into employee',
                    $this->postType
                ),
                'uploaded_to_this_item' => __(
                    'Uploaded to this employee',
                    $this->postType
                )
            ],
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'supports' => [
                'title',
                'thumbnail',
                'revisions'
            ],
            'taxonomies' => [$this->postType . '_types'],
            'rewrite' => [
                'slug' => __('employees', $this->postType),
                'with_front' => false
            ],
            'query_var' => false,
            'show_in_rest' => true,
            'rest_base' => 'employees'
        ]);
    }

    public function registerTaxonomies()
    {
        register_taxonomy($this->postType . '_types', $this->postType, [
            'labels' => [
                'name' => __('Employee Types', $this->postType),
                'singular_name' => __('Employee Type', $this->postType),
                'all_items' => __('All Employee Types', $this->postType),
                'edit_item' => __('Edit Employee Type', $this->postType),
                'view_item' => __('View Employee Type', $this->postType),
                'update_item' => __('Update Employee Type', $this->postType),
                'add_new_item' => __('Add New Employee Type', $this->postType),
                'new_item_name' => __('New Employee Type Name', $this->postType),
                'parent_item' => __('Parent Employee Type', $this->postType),
                'parent_item_colon' => __(
                    'Parent Employee Type:',
                    $this->postType
                ),
                'search_items' => __('Search Employee Types', $this->postType),
                'not_found' => __('No Employee Types found.', $this->postType)
            ],
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => 'employee_types',
            'rewrite' => [
                'slug' => __('employees/types', $this->postType),
                'with_front' => false,
                'hierarchial' => true
            ],
            'show_in_rest' => true,
            'rest_base' => 'employee_types'
        ]);
    }
}
