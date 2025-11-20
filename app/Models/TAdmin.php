<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TAdmin extends Authenticatable
{
    use SoftDeletes;
    use Filterable;
    use HasRoles;


    protected $table = "t_admin";
    protected $primaryKey = 'pk_i_id';
    protected $appends = ['enabled_html'];

    protected $hidden = ['s_password', 'remember_token'];
    protected $fillable = [
        's_name',
        's_username',
        's_avatar',
        's_email',
        's_mobile',
        's_address',
        's_password'
    ];

    const CREATED_AT = 'dt_created_date';
    const UPDATED_AT = 'dt_modified_date';
    const DELETED_AT = 'dt_deleted_date';


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function scopeEnabled($query)
    {
        return $query->where('b_enabled', 1);
    }


    public function getAuthPassword()
    {
        return $this->s_password;
    }

//
    public function setPasswordAttribute($value)
    {
        $this->attributes['s_password'] = $value;
    }


    public function setSEmailAttribute($email) {
        $this->attributes['s_email'] = strtolower($email);
    }

    public function setSPasswordAttribute($value)
    {
        $this->attributes['s_password'] = bcrypt($value);
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
