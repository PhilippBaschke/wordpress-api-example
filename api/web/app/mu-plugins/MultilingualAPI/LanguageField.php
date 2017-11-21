<?php namespace PhilippBaschke\WordPressApiExample\MU\MultilingualAPI;

/**
 * Add a queryable language field ('lang') to the API
 */
class LanguageField
{
    /**
     * @var string FIELD - The name of the language field
     */
    const FIELD = 'lang';

    /**
     * Add the necessary actions and filters when the field is created
     *
     * @return void
     */
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register']);
        add_action('rest_api_init', [$this, 'addQueryFilters']);
        add_filter('terms_clauses', [$this, 'addLanguageClause'], 10, 3);
    }

    /**
     * Register the field for all translated post types and taxonomies
     *
     * @return void
     */
    public function register()
    {
        register_rest_field(TranslatedTypes::getPostTypes(), self::FIELD, [
            'get_callback' => [$this, 'getPostLanguage']
        ]);

        register_rest_field(TranslatedTypes::getTaxonomies(), self::FIELD, [
            'get_callback' => [$this, 'getTaxonomyLanguage']
        ]);
    }

    /**
     * Filter the query for all translated post types and taxonomies
     *
     * @return void
     */
    public function addQueryFilters()
    {
        foreach (TranslatedTypes::getAll() as $type) {
            add_filter('rest_' . $type . '_query', [$this, 'filterQuery'], 10, 2);
        }
    }

    /**
     * Add an SQL clause to make filtering taxonomies by language possible
     *
     * @param array $clauses Terms query SQL clauses
     * @param array $taxonomies An array of taxonomies
     * @param array $args An array of terms query arguments
     *
     * @return array The initial $clauses or the extended SQL clauses
     *
     * @see https://developer.wordpress.org/reference/hooks/terms_clauses/
     */
    public function addLanguageClause($clauses, $taxonomies, $args)
    {
        if (!isset($args[self::FIELD]) ||
            !array_intersect($taxonomies, TranslatedTypes::getTaxonomies())) {
            return $clauses;
        }

        return PLL()->model->terms_clauses(
            $clauses,
            PLL()->model->get_language($args[self::FIELD])
        );
    }

    /**
     * Get the language of the post
     *
     * @param object $post Post or custom post type object of the request
     *
     * @return string 2-letters language code of the post
     *
     * @see https://polylang.pro/doc/function-reference/#pll_get_post_language
     */
    public function getPostLanguage($post)
    {
        return pll_get_post_language($post['id']);
    }

    /**
     * Get the language of the taxonomy
     *
     * @param object $taxonomy Term or custom taxonomy type object of the request
     *
     * @return string 2-letters language code of the taxonomy
     *
     * @see https://polylang.pro/doc/function-reference/#pll_get_term_language
     */
    public function getTaxonomyLanguage($taxonomy)
    {
        return pll_get_term_language($taxonomy['id']);
    }


    /**
     * Add the "lang" query parameter to the args
     *
     * @param array $args Key value array of query var to query value
     * @param WP_REST_Request $request The request used
     *
     * @return array The initial or extended $args array
     *
     * @see https://developer.wordpress.org/reference/hooks/rest_this-post_type_query/
     * @see https://developer.wordpress.org/reference/hooks/rest_this-taxonomy_query/
     * @see https://github.com/WP-API/rest-filter
     */
    public function filterQuery($args, $request)
    {
        if (!isset($args[self::FIELD]) && isset($request[self::FIELD])) {
            $args[self::FIELD] = $request[self::FIELD];
        }

        return $args;
    }
}
