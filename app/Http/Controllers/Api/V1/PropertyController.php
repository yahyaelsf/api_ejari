<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PropertyRequest;
use App\Http\Resources\Api\V1\PropertyResource;
use App\Http\Resources\Api\V1\PropertyScheduleResource;
use App\Models\TFavorite;
use App\Models\TProperty;
use App\Models\TPropertySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends ApiBaseController
{
    public function index(Request $request)
    {
        $properties = TProperty::enabled()->get();
        return $this->successResponse('', PropertyResource::collection($properties), 'properties');
    }
     public function store(PropertyRequest $request)
    {

         $data = $request->validated();
        if (empty($data['fk_i_user_id']) && auth()->check()) {
            $data['fk_i_user_id'] = auth()->id();
        }
         $property = TProperty::create($data);
        return response()->json([
            'status' => true,
            'message' => 'تم إرسال الطلب بنجاح',
            'data' => $this->successResponse('',  new PropertyResource($property), 'property'),
        ], 201);
    }
     public function show(TProperty $property)
    {
        return $this->successResponse('',  new PropertyResource($property), 'property');
    }
    public function propertySchedule(Request $request){
         $data = $request->validate([
        'property_id' => 'required|integer|exists:t_properties,pk_i_id',
        'type' => 'required|in:single_time,multi_time',
        'dates' => 'nullable',
        'dates.*' => 'date',
        'from_time' => 'nullable|date_format:H:i',
        'to_time' => 'nullable|date_format:H:i|after:times.*.from_time',
        ]);


        TPropertySchedule::where('fk_i_property_id', $data['property_id'])->delete();

        if ($data['type'] === 'single_time') {
             $dates = json_decode($data['dates'], true);

            foreach ($dates as $date) {
                    TPropertySchedule::create([
                        'fk_i_property_id' => $data['property_id'],
                        'fk_i_user_id' => auth()->id(),
                        'date' => $date,
                        'from_time' => $data['from_time'],
                        'to_time' => $data['to_time'],
                        'type' => 'single_time',
                    ]);
            }
        } else {

                $days = $request->input('days', $request->all());
                $decoded = json_decode($days, true);
                // return $decoded ;
                if (!is_array($decoded)) {

                     return $this->failResponse("Invalid format. Expected array of days.");
                }

                foreach ($decoded as $day) {
                    foreach ($day['slots'] as $slot) {
                        TPropertySchedule::create([
                            'fk_i_property_id' => $data['property_id'],
                            'fk_i_user_id' => auth()->id(),
                            'date' => $day['date'],
                            'from_time' => $slot['from_time'],
                            'to_time' => $slot['to_time'],
                            'is_grouped' => false,
                        ]);
                    }
                }


        }
         return $this->successResponse("تم حفظ المواعيد بنجاح");

    }
     public function getPropertySchedule($propertyId)
    {
        $schedules = TPropertySchedule::where('fk_i_property_id', $propertyId)
            ->orderBy('date')
            ->orderBy('from_time')
            ->with('property')
            ->get();

       return $this->successResponse('', PropertyScheduleResource::collection($schedules), 'schedules');
    }
    public function deletePropertySchedule($id)
    {
        $schedule = TPropertySchedule::findOrFail($id);
        $schedule->delete();

         return $this->successResponse("تم حذف الموعد بنجاح");
    }
    public function location_search(Request $request)
    {
        $query = $request->input('q'); 

        $properties = TProperty::where('s_address', 'LIKE', '%' . $query . '%')->get();

         return $this->successResponse('', PropertyResource::collection($properties), 'properties');
    }
    public function filter(Request $request)
{
    $query = TProperty::query();

    // الفلترة حسب القسم
    if ($request->filled('category_id')) {
        $query->where('fk_i_category_id', $request->category_id);
    }

    // السعر Range
    if ($request->filled('price_from') && $request->filled('price_to')) {
        $query->whereBetween('n_price', [$request->price_from, $request->price_to]);
    }

    // المساحة Range
    if ($request->filled('area_from') && $request->filled('area_to')) {
        $query->whereBetween('s_area', [$request->area_from, $request->area_to]);
    }

    // عدد أفراد العائلة
    if ($request->filled('family_members')) {
        $query->where('n_family_members', '>=', $request->family_members);
    }

    // عدد الغرف
    if ($request->filled('rooms')) {
        $query->where('n_rooms', '>=', $request->rooms);
    }

    // عدد الحمامات
    if ($request->filled('bathrooms')) {
        $query->where('n_bathrooms', '>=', $request->bathrooms);
    }

    // عدد الوناسة
    if ($request->filled('lounges')) {
        $query->where('n_lounges', '>=', $request->lounges);
    }

    // الطابق
    if ($request->filled('floor')) {
        $query->where('s_floors', $request->floor);
    }

    // التأثيث
    if ($request->filled('furnished')) {
        $query->where('e_furnished', $request->furnished); // 1 مفروشة، 0 غير مفروشة
    }

    // الحالة
    if ($request->filled('status')) {
        $query->where('e_status', $request->status); // جديد / مستخدم
    }

    // جودة التشطيب
    if ($request->filled('finishing')) {
        $query->where('e_finishing_quality', $request->finishing);
    }

    // المميزات الإضافية (Tags)
    if ($request->filled('features')) {
        foreach ($request->features as $feature) {
            $query->where('s_additional_features', 'LIKE', "%$feature%");
        }
    }

    // المنطقة المحيطة (Tags)
    if ($request->filled('surrounding')) {
        foreach ($request->surrounding as $tag) {
            $query->where('s_surrounding_area', 'LIKE', "%$tag%");
        }
    }

    // توفير المياه
    if ($request->filled('water')) {
        $query->where('e_water_conservation', $request->water);
    }

    $properties = $query->get();

   return $this->successResponse('', PropertyResource::collection($properties), 'properties');
}


}
