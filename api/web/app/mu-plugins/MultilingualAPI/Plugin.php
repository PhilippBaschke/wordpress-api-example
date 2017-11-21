<?php namespace PhilippBaschke\WordPressApiExample\MU\MultilingualAPI;

/**
 * Plugin Name: Multilingual API
 * Description: Make Polylang translation metadata available in the WordPress REST API
 * Author: Philipp Baschke
 */

if (!defined('ABSPATH')) {
    exit;
}

new LanguageField();
new TranslationsField();
