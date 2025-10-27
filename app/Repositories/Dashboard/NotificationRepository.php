<?php

namespace App\Repositories\dashboard;

use App\Models\Notification;

class NotificationRepository
{

    // get one
    public function getOne($id)
    {
        return Notification::find($id);
    }

    // get all
    public function getAll()
    {
        return Notification::when(!empty(request()->keyword), function ($query) {
            $query->where('title', 'like', '%' . request()->keyword . '%');
        })
            ->orderByDesc('created_at')
            ->select('id', 'title', 'details','status','link','created_at')
            ->paginate(20);
    }

    // create
    public function create($data)
    {
        return Notification::create($data);
    }

    // update
    public function update($data, $notification)
    {
        return $notification->update($data);
    }

    // destroy
    public function destroy($notification)
    {
        return $notification->forceDelete();
    }

    // change status
    public function changeStatus($notification ,$status)
    {
        return $notification->update([
            'status' => $status,
        ]);
    }
}
