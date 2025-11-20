<?php

namespace App\Exports;

use App\Models\TJobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class JobApplicationExport implements FromCollection, WithMapping,WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TJobApplication::get();
    }
    public function map($detail): array
    {
        // dd( $detail->job->s_job_title);
        return [
            $detail->s_name,
            $detail->job ? $detail->job->s_job_title : '' ,
            $detail->s_email,
            $detail->s_mobile,
            $detail->s_address,
            $detail->dt_dob_date,
            trans('frontend.'.strtolower($detail->e_social_state)),
            trans('frontend.'.strtolower($detail->e_gender)),
            $detail->s_qualifications,
            $detail->e_status == 'ACCPETED' ? trans('general.ACCPETED') : ($detail->e_status == "REJECTED" ? trans('general.REJECTED') : ''),
            asset($detail->s_avatar),
            asset($detail->s_cv),
            asset($detail->s_certification),
            $detail->s_description,
            $detail->dt_created_date,
        ];
    }

    public function headings(): array
    {
        return [
            trans('general.name'),
            trans('general.job'),
            trans('general.email'),
            trans('general.mobile'),
            trans('general.address'),
            trans('general.dob'),
            trans('general.social_status'),
            trans('general.gender'),
            trans('general.qualifications'),
            trans('general.status'),
            trans('general.avatar'),
            trans('general.cv'),
            trans('general.certification'),
            trans('general.description'),
            trans('general.created_at'),
        ];
    }
}
