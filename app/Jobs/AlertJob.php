<?php

namespace App\Jobs;

use App\Models\TExerciseAlert;
use App\Models\Translations\TDayTranslation;
use App\Models\TUser;
use App\Notifications\TimeExerciseNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $day = TDayTranslation::where('s_locale', 'en')
        ->where('s_name', Carbon::now()->englishDayOfWeek)->first();
        $alerts = TExerciseAlert::whereHas('days', function ($q) use ($day) {
                $q->where('fk_i_day_id', $day->fk_i_day_id);
            })->enabled()->get();
        foreach($alerts as $alert){
            $alertHour = Carbon::parse($alert->dt_alert_time)?->format('H');
            $alertminute = Carbon::parse($alert->dt_alert_time)?->format('i');
            if($alertHour == Carbon::now()->hour && $alertminute == Carbon::now()->minute){
                $alert->user->notify(new TimeExerciseNotification(trans('notifications.time_exercise'), [], 'Notification', $alert));
            }
        }
    }
}
