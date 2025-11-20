<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAlbumRequest;
use App\Http\Requests\Admin\StoreCampaignRequest;
use App\Models\TAlbum;
use App\Models\TResource;

class ResourceController extends Controller
{
    public function destroy(TResource $resource)
    {
        $resource->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
