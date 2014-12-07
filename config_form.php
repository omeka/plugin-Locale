<?php 

$currentLocaleCode = get_option('locale_language_code'); 
if (empty($currentLocaleCode)) {
    $currentLocaleCode = 'en'; //plugin is only for .net, so it's okay to start with English
}
$files = scandir(BASE_DIR . '/application/languages');

foreach ($files as $file) {
    if (strpos($file, '.mo') !== false) {
        $code = str_replace('.mo', '', $file);
        $parts = explode('_', $code);
        if (isset($parts[1])) {
            $langCode = $parts[0];
            $regionCode = strtolower($parts[1]);
            $language = Zend_Locale::getTranslation($regionCode, 'language', $langCode);
        } else {
            $language = Zend_Locale::getTranslation($code, 'language', $code);
        }
        if (empty($language)) {
            //don't know why but this is the only way I found to get
            //the language for cy_GB, da_DK, el_GR, sq_AL, sr_RS, zh_CN
            $language = Zend_Locale::getTranslation($langCode, 'language', $regionCode); 
        }
        $codes[$code] = ucfirst($language) . " ($code)";
    }
}
$codes['en'] = ucfirst( Zend_Locale::getTranslation('en', 'language', 'en' ) ) . " (en)";
asort($codes);

?>

<div class="field">
    <div class="two columns alpha">
        <label><?php echo __('Language'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __("The language to use for your site. Some parts of the site might not have been translated into your language yet. To learn more about contributing to translations, <a href='http://omeka.org/codex/Translate_Omeka'>read this</a>."); ?> </p>
        <div class="input-block">
            <?php echo get_view()->formSelect('locale_language_code', $currentLocaleCode, null, $codes);   ?> 
        </div>
    </div>
</div>