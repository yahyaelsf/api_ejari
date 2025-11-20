<?php

namespace App\Models\Translations;

use App\Models\BaseModel;

class TCampaignTranslation extends BaseModel
{
    const SPECIAL_CHARACTER = '$%#';
    protected $table = "t_campaign_translations";

    public function setSConditionsAttribute($value)
    {
        $this->attributes['s_conditions'] = implode(self::SPECIAL_CHARACTER, $value);
    }

    public function getSConditionsAttribute($value)
    {
        return array_filter(explode(self::SPECIAL_CHARACTER, $value));
    }
}
