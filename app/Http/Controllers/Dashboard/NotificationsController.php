<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NotificationRequest;
use App\Services\Dashboard\NotificationService;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    protected $notificationService;
    //__construct
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    // index
    public function index()
    {
        $title = __('notifications.notifications');
        $notifications = $this->notificationService->getAll();
        return view('dashboard.notifications.index', compact('title', 'notifications'));
    }

    // get all
    public function getAll()
    {
        return $this->notificationService->getAll();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationRequest $request)
    {
        $data = $request->only(['title' , 'details']);
        $mail = $this->notificationService->create($data);
        if (!$mail) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mail = $this->notificationService->destroy($id);
        if (!$mail) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    // changeStatus
    public function changeStatus(Request $request)
    {
        $notification = $this->notificationService->changeStatus($request['id'], $request['status']);
        if (!$notification) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }
}
