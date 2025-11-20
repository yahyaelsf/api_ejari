<?php

namespace App\Abstracts;

use App\Models\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

abstract class LocalizableModel extends BaseModel
{

    protected $localizable = [];

    protected $guarded = ['localizable'];

    protected $eagerLoadTranslations = true;

    protected $hideTranslations = true;

    protected $appendLocalizedAttributes = true;

    protected $translationRelationKey = null;


    public function __construct($attributes = [])
    {

        if ($this->eagerLoadTranslations) {
            $this->with[] = 'translations';
        }


        if ($this->hideTranslations) {
            $this->hidden[] = 'translations';
        }


        if ($this->appendLocalizedAttributes) {
            foreach ($this->localizable as $localizableAttribute) {
                $this->appends[] = $localizableAttribute;

                foreach ($this->getLanguages() as $supportedLanguage) {
                    $this->appends[] = $localizableAttribute . '_' . $supportedLanguage;
                }
            }
        }


        parent::__construct($attributes);
    }


    public function __get($attribute)
    {

        if (in_array($attribute, $this->localizable)) {
            return $this->translations
                    ->where('s_locale', app()->getLocale())
                    ->first()
                    ->{$attribute} ?? '';
        }

        $lang = substr($attribute, -2);
        if (in_array($lang, $this->getLanguages())) {
            foreach ($this->localizable as $localizableAttribute) {
                if ($attribute == $localizableAttribute . '_' . $lang) {
                    return $this->translations
                            ->where('s_locale', $lang)
                            ->first()
                            ->{$localizableAttribute} ?? '';
                }
            }
        }

        return parent::__get($attribute);
    }


    public function __call($method, $arguments)
    {

        foreach ($this->localizable as $localizableAttribute) {
            if ($method === 'get' . Str::studly($localizableAttribute) . 'Attribute') {
                return $this->{$localizableAttribute};
            }

            foreach ($this->getLanguages() as $supportedLanguage) {
                if ($method === 'get' . Str::studly($localizableAttribute) . Str::studly($supportedLanguage) . 'Attribute') {
                    return $this->{$localizableAttribute . '_' . $supportedLanguage};
                }
            }
        }


        return parent::__call($method, $arguments);
    }


    public function translations()
    {
        $modelName = class_basename(get_class($this));
        $foreignKey = ltrim($modelName, 'T');
        $foreignKey = Str::snake($foreignKey);
        $foreignKey = $this->translationRelationKey ?? 'fk_i_' . $foreignKey . '_id';
        return $this->hasMany("App\\Models\\Translations\\{$modelName}Translation", $foreignKey, 'pk_i_id');
    }


    public function syncTranslations($translation, $relation = null)
    {

        foreach ($translation as $key => $value) {
            if (!empty($relation) && $key == $relation || $key == 'pk_i_id') continue;
            if (array_filter($value)) {
                $this->translations()->updateOrCreate(['s_locale' => $key], $value);
            }
        }

        if (!is_null($relation) && $this->{$relation}()) {
            collect($translation[$relation])->map(function ($value, $key) use ($relation) {


                $item = $this->{$relation}()->updateOrCreate(['pk_i_id' => $value['pk_i_id'] ?? null]);
                foreach ($value as $key => $data) {
                    if (in_array($key, config('app.supported_languages'))) {
                        unset($data['pk_i_id']);
                        $item->translations()->updateOrCreate(['s_locale' => $key], $data);
                    } else {
                        continue;
                    }
                }
            });
        }

        return true;
    }


    protected function getLanguages()
    {
        return config('app.supported_languages');
    }
}
