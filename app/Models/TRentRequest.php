<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRentRequest extends BaseModel
{
    protected $table = 't_rent_requests';
    // protected $appends = ['enabled_html'];

    protected $fillable = [
        'fk_i_category_id',
        'fk_i_user_id',
        's_address',
        's_description',
        'n_price',
        's_area',
        'n_family_members',
        'n_rooms',
        'n_bathrooms',
        'n_lounges',
        's_floors',
        'e_furnished',
        'e_status',
        'e_finishing_quality',
        's_additional_features',
        's_surrounding_area',
        'e_water_conservation',
        's_reference_number'

    ];
       protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->s_reference_number = self::generateReferenceNumber();
            $model->dt_created_date = now();
        });

        static::updating(function ($model) {
            $model->dt_modified_date = now();
        });
    }
         private static function generateReferenceNumber()
    {
        do {
            $reference = 'H' . mt_rand(100000, 999999);
        } while (self::where('s_reference_number', $reference)->exists());

        return $reference;
    }

    public function category()
    {
        return $this->belongsTo(TCategory::class, 'fk_i_category_id', 'pk_i_id');
    }

    public function user()
    {
        return $this->belongsTo(TUser::class, 'fk_i_user_id', 'pk_i_id');
    }
     public function getEnabledHtmlAttribute()
    {
        return '<span class="kt-switch kt-switch--icon kt-switch--sm">
                    <label>
                        <input type="checkbox" data-id="' . $this->getKey() . '" name="status" class="js-switch"' . ($this->b_enabled == 1 ? 'checked' : '') . ">
                        <span></span>
                	</label>
				</span>";
    }
}
