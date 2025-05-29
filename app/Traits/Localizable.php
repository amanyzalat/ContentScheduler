<?php
namespace App\Traits;

trait Localizable
{
    // Method to gather all translations for the translatable attributes
    public function localize()
    {
        $locales = [];

        // Assuming these methods exist; handle if they don't
        if (!method_exists($this, 'locales') || !method_exists($this, 'getTranslatableAttributes')) {
            throw new \Exception("Required methods are missing");
        }

        foreach ($this->locales() as $locale) {
            foreach ($this->getTranslatableAttributes() as $attribute) {
                // Retrieve translation and check if it exists
                $translation = $this->getTranslation($attribute, $locale);
                if ($translation !== null) {
                    $locales[$locale][$attribute] = $translation;
                }
            }
        }
        return $locales;
    }

}
