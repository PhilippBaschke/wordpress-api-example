<?php namespace PhilippBaschke\WordPressApiExample\MU\CustomPostTypes\Base;

abstract class AbstractPostTypeWithTaxonomies extends AbstractPostType
{
    /**
     * Create a new custom post type with taxonomies
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        add_action('init', [$this, 'registerTaxonomies']);
    }

    /**
     * Register custom taxonomies that belong to the custom post type
     *
     * @access public
     */
    abstract public function registerTaxonomies();
}
