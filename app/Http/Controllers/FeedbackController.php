<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{


    public function store( $idActivite, Request $request)
    {
        $request->validate([
            'commentaire' => 'required|string|max:255',
            'note' => 'required|string',
            'idActivite' => 'exists:activities,idActivite',
            'date' => 'nullable|date'
        ]);
        $user = Auth::user();

        Feedback::create([
                'commentaire' => $request->commentaire,
                'note' => $request->note,
                'idActivite' => $idActivite, // ✅ Assigning the activity ID from route
                'idUser' => $user->idUser, // optional: assign logged user automatically
                'date' => now(),
            ]);
        return redirect()->route('activities.front.index')->with('success', 'Feedback créée avec succès 🌱');
    }



    public function update(Request $request, $idFeedback)
    {
        $request->validate([
            'commentaire' => 'required|string|max:255',
            'note' => 'required|string',
        ]);
        $feedback = Feedback::findOrFail($idFeedback);

        $feedback->update($request->all());

        return redirect()->route('activities.front.index')->with('success', 'Feedback mise à jour avec succès ✨');
    }

    public function destroy($idFeedback)
    {
        $feedback = Feedback::findOrFail($idFeedback);
        $feedback->delete();

        return redirect()->route('activities.front.index')->with('success', 'Feedback supprimée ✅');
    }


}
