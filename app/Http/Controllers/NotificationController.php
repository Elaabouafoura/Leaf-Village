<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->orderBy('date', 'desc')->get();
        return view('backoffice.notifications.index', compact('notifications'));
    }
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification supprimée avec succès.');
    }

    public function markAsRead($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->etat = true;
        $notif->save();

        return redirect()->back();
    }
}
