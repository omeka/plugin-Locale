<?php 

$currentLocaleCode = get_option('locale_language_code'); 
if (empty($currentLocaleCode)) {
    $currentLocaleCode = 'en'; //plugin is only for .net, so it's okay to start with English
}
$files = scandir(BASE_DIR . '/application/languages');

foreach ($files as $file) {
    if (strpos($file, '.mo') !== false) {
        $code = str_replace('.mo', '', $file);
        $codes[$code] = ucfirst( Locale::getDisplayName($code, $currentLocaleCode) );
    }
}
$codes['en'] = ucfirst( Locale::getDisplayName('en', $currentLocaleCode) );
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