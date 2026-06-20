<?php
namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller {
    
    public function index() {
        $applications = Application::where('user_id', Auth::id())->latest()->get();
        return view('applications.index', compact('applications'));
    }

    public function store(Request $request, $recruitmentId) {
        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        // Check if already applied
        $exists = Application::where('user_id', Auth::id())
                            ->where('recruitment_id', $recruitmentId)
                            ->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah melamar posisi ini.');
        }

        Application::create([
            'recruitment_id' => $recruitmentId,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Lamaran Anda telah terkirim.');
    }

    public function update(Request $request, Application $application) {
        // Authorize: Only the owner of the recruitment can update the application
        if (Auth::id() !== $application->recruitment->user_id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $application->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status lamaran diperbarui.');
    }

    public function destroy(Application $application) {
        if (Auth::id() !== $application->user_id) {
            abort(403);
        }

        if ($application->status !== 'pending') {
             return redirect()->back()->with('error', 'Lamaran yang sudah diproses tidak dapat dibatalkan.');
        }

        $application->delete();
        return redirect()->back()->with('success', 'Lamaran dibatalkan.');
    }
}