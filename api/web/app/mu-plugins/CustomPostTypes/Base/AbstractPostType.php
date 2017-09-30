<?php namespace PhilippBaschke\WordPressApiExample\MU\CustomPostTypes\Base;

abstract class AbstractPostType
{
    /**
     * The name of the namespace to ensure that no duplicate post types exist
     *
     * @var string
     */
    const NAMESPACE = 'apiex_';

    /**
     * The name of the custom post type
     * (is also used as the translation domain)
     *
     * @var string
     */
    public $postType;

    /**
     * Create a new custom post type
     *
     * @access public
     */
    public function __construct()
    {
        $this->setPostType();

        add_action('plugins_loaded', [$this, 'loadTextdomain']);
        add_action('init', [$this, 'registerPostType']);
    }

    /**
     * Load the translations for this class
     *
     * Uses the function for mu-plugins
     * --> translations only work if this class is used in a mu-plugin
     *
     * @access public
     */
    public function loadTextdomain()
    {
        load_muplugin_textdomain(
            $this->postType,
            plugin_basename(dirname(__FILE__)) . '/lang'
        );
    }

    /**
     * Register the custom post type $postType
     *
     * @access public
     * @return The registered post type object or an error object
     */
    abstract public function registerPostType();

    /**
     * Set the PostType to NAMESPACE_classname
     *
     * e.g. for Employee: `apiex_employee`
     *
     * @access private
     */
    private function setPostType()
    {
        $classnameWithoutNamespace = substr(strrchr(get_class($this), '\\'), 1);
        $this->postType = self::NAMESPACE . strtolower($classnameWithoutNamespace);
    }
}
