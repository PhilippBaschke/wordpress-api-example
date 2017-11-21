<?php namespace PhilippBaschke\WordPressApiExample\MU\MultilingualAPI;

/**
 * Helper class to get the types that should be translated
 */
class TranslatedTypes
{
    /**
     * Get all post types that are translated by Polylang
     *
     * @return array
     */
    public static function getPostTypes()
    {
        return array_filter(
            get_post_types(['show_in_rest' => true]),
            'pll_is_translated_post_type'
        );
    }

    /**
     * Get all taxonomies that are translated by Polylang
     *
     * @return array
     */
    public static function getTaxonomies()
    {
        return array_filter(
            get_taxonomies(['show_in_rest' => true]),
            'pll_is_translated_taxonomy'
        );
    }

    /**
     * Get all post types and taxonomies that are translated by Polylang
     *
     * @return array
     */
    public static function getAll()
    {
        return array_merge(self::getPostTypes(), self::getTaxonomies());
    }
}
