<?php
function isAdminUrl($url = null)
{
    if (empty($url)) {
        $url = request()->getPathInfo();
    }
    return (1 === strpos($url, 'admin'));
}

function getTranslateAttributeValue($model, $key, $loca = null)
{
    $isAdminUrl = isAdminUrl();

    $locale = app()->getLocale();
    $contentLocale = $isAdminUrl ? getContentLocale() : null; // for admin edit contents

    $isEditModel = ($isAdminUrl and !empty($contentLocale) and is_array($contentLocale) and $contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id);

    if ($isAdminUrl and
        !empty($contentLocale) and
        is_array($contentLocale) and
        (
            ($contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id) or
            (
                (!empty($model->parent_id) and $contentLocale['item_id'] == $model->parent_id) or // for category edit page
                (!empty($model->filter_id) and $contentLocale['item_id'] == $model->filter_id) // for filter edit page
            )
        )
    ) {
        $locale = $contentLocale['locale']; // for admin edit contents
    }

    try {
        $locale = !empty($loca) ? $loca : $locale;

        if ($model->getTable() === 'settings' and in_array($model->name, \App\Models\Setting::getSettingsWithDefaultLocal())) {
            $locale = \App\Models\Setting::$defaultSettingsLocale;
        }

        $model->locale = $locale;

        return $model->translate(mb_strtolower($locale))->{$key};
    } catch (\Exception $e) {
        // this conditions get client side

        if (empty($contentLocale) and empty($loca)) { //  first get translate by site default language
            $defaultLocale = getDefaultLocale();

            return getTranslateAttributeValue($model, $key, $defaultLocale);
        } elseif ((!empty($loca) or !$isEditModel) and $loca != 'en' and !empty($model->translations) and count($model->translations)) { // if not translate by site default language get translate by English language
            return getTranslateAttributeValue($model, $key, 'en');
        } else if ((!empty($loca) or !$isEditModel) and !empty($model->translations) and count($model->translations)) { // if not default and English get translate by first locale
            $translations = $model->translations->first();

            return getTranslateAttributeValue($model, $key, $translations->locale);
        }

        return '';
    }
}
function getContentLocale()
{
    return session()->get('edit_content_locale', null);
}

function getDefaultLocale()
{
    $siteLanguage = 'EN'; 
    return $siteLanguage;
}

function getAdminPanelUrlPrefix()
{
    
    return   'admin';
}

function getAdminPanelUrl($url = null, $withFirstSlash = true)
{
    return ($withFirstSlash ? '/' : '') . getAdminPanelUrlPrefix() . ($url ?? '');
}

function storeContentLocale($locale, $table, $item_id)
{
    removeContentLocale();

    $data = [
        'locale' => $locale,
        'table' => $table,
        'item_id' => $item_id
    ];

    session()->put('edit_content_locale', $data);
}

function removeContentLocale()
{
    session()->remove('edit_content_locale');
}
