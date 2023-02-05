<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NotificationResource;
use App\Models\Notify;

class NotificationController extends Controller
{
    public function getNotification($type){
        $notifications = Notify::where('type',$type)->get();
        
        // $type = $notifications[1];
        return $this->jsonResponse(true, $notifications);

    }
}
