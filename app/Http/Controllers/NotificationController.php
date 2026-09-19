<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->with(['fromUser', 'design'])
            ->latest()
            ->get();

        // Client → Client notification page
        if (auth()->user()->role === 'client') {

            return view(
                'client.notifications.index',
                compact('notifications')
            );
        }

        // Designer → Designer notification page
        return view(
            'notifications.index',
            compact('notifications')
        );
    }


    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->update([
            'is_read' => true,
        ]);

        return back();
    }


    public function redirect($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        // Notification ko read mark karein
        if (!$notification->is_read) {

            $notification->update([
                'is_read' => true,
            ]);
        }


        // Follow notification
        if ($notification->type === 'follow') {

            $fromUser = User::findOrFail(
                $notification->from_user_id
            );

            // Agar follow karne wala client hai
            if ($fromUser->role === 'client') {

                return redirect()->route(
                    'client.profile',
                    $fromUser->id
                );
            }

            // Agar follow karne wala designer hai
            if ($fromUser->role === 'designer') {

                return redirect()->route(
                    'designer.profile',
                    $fromUser->id
                );
            }
        }


        // Like / Comment / Save → Design
        if (in_array($notification->type, [
            'like',
            'comment',
            'save',
        ])) {

            return redirect()->route(
                'designs.show',
                $notification->design_id
            );
        }


        return back();
    }


    public function markAllAsRead()
    {
        auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return back();
    }
}

