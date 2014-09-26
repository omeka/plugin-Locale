<?php

class LocalePlugin extends Omeka_Plugin_AbstractPlugin
{
    public $_hooks = array('config', 'config_form', 'initialize');
    public $_filters = array('locale');

    /**
     * Add the translations.
     */
    public function hookInitialize()
    {
        add_translation_source(dirname(__FILE__) . '/languages');
    }

    public function hookConfig($args)
    {
        $post = $args['post'];
        set_option('locale_language_code', $post['locale_language_code']);
    }

    public function hookConfigForm()
    {
        include('config_form.php');
    }
    
    public function filterLocale($value)
    {
        return get_option('locale_language_code');
    }
}