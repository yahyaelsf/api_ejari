<?php

namespace App\Models;


use App\Traits\Filterable;
use App\Traits\Notifiable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BaseModel extends Model
{
    use SoftDeletes;
    use Filterable;
    use HasFactory;

    protected $primaryKey = 'pk_i_id';
    protected $guarded = ['enabled_html', 'pk_i_id'];
    protected $appends = ['enabled_html'];

    CONST CREATED_AT = 'dt_created_date';
    CONST UPDATED_AT = 'dt_modified_date';
    CONST DELETED_AT = 'dt_deleted_date';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeEnabled($query)
    {
        return $query->where('b_enabled', 1);
    }

    public static function scopeGetSelects($query, $name = 's_name', $id = 'pk_i_id')
    {
        return array_column(
            $query->get()->toArray(),
            $name,
            $id
        );
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
