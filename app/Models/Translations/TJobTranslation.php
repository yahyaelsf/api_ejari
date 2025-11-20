<?php

namespace App\Models\Translations;

use App\Abstracts\LocalizableModel;
use App\Models\BaseModel;

class TJobTranslation extends BaseModel
{
    protected $table = "t_job_translations";
    protected $appends = ['s_conditions'];

    const SPECIAL_CHARACTER = '$%#';

    public function setSConditionsAttribute($value)
    {
        $this->attributes['s_conditions'] = implode(self::SPECIAL_CHARACTER, $value);
    }

    public function getSConditionsAttribute($value)
    {
        return array_filter(explode(self::SPECIAL_CHARACTER, $value));
    }
}
