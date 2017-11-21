<?php namespace PhilippBaschke\WordPressApiExample\MU\MultilingualAPI;

/**
 * Add a translations field ('translations') to the API
 */
class TranslationsField
{
    /**
     * @var string FIELD - The name of the translations field
     */
    const FIELD = 'translations';

    /**
     * Add the necessary action when the field is created
     *
     * @return void
     */
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register']);
    }

    /**
     * Register the field for all translated post types and taxonomies
     *
     * @return void
     */
    public function register()
    {
        register_rest_field(TranslatedTypes::getPostTypes(), self::FIELD, [
            'get_callback' => [$this, 'getPostTranslations']
        ]);

        register_rest_field(TranslatedTypes::getTaxonomies(), self::FIELD, [
            'get_callback' => [$this, 'getTaxonomyTranslations']
        ]);
    }

    /**
     * Get the translations of the post
     *
     * @param object $post Post or custom post type object of the request
     *
     * @return array
     * Translations with language code as key and translation post_id as value
     */
    public function getPostTranslations($post)
    {
        return pll_get_post_translations($post['id']);
    }

    /**
     * Get the translations of the taxonomy
     *
     * @param object $taxonomy Term or custom taxonomy type object of the request
     *
     * @return array
     * Translations with language code as key and translation term_id as value
     */
    public function getTaxonomyTranslations($taxonomy)
    {
        return pll_get_term_translations($taxonomy['id']);
    }
}
