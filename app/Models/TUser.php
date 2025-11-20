<?php

namespace App\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Notifications\Dispatcher;
use DateTimeInterface;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Traits\Filterable;
use App\Traits\Notifiable;

class TUser extends BaseModel implements AuthenticatableContract
{
    use SoftDeletes;
    use Filterable;
    use Authenticatable;
    use HasApiTokens;
    use Notifiable ;

    protected $table = "t_users";
    protected $primaryKey = 'pk_i_id';

    protected $hidden = ['s_password', 'remember_token'];
    protected $appends = ['enabled_html'];

    protected $fillable = [
        's_name',
        's_avatar',
        's_email',
        's_id_number',
        's_id_image',
        's_mobile',
        's_mobile_whats',
        's_password',
        's_verify_code',
        'sent_code_date',
        'b_email_verified',
        'b_enable_notification',
        'e_type'
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

    public function notify($instance)
    {
        info('notify');
        if ((int)$this->b_enable_notification) {
            app(Dispatcher::class)->send($this, $instance);
        } else {
            return;
        }
    }
    //  public function deviceTokens()
    // {
    //     return $this->hasMany(DeviceToken::class, 'fk_i_user_id', 'pk_i_id');
    // }
    //  public function routeNotificationForFcm()
    // {
    //     return $this->deviceTokens()->pluck('token')->toArray();
    // }


}
