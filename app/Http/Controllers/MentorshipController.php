<?php
namespace App\Http\Controllers;

use App\Models\Mentorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipController extends Controller {
    public function index() {
        if (Auth::user()->role !== 'dosen') {
            abort(403);
        }
        $mentorships = Mentorship::where('lecturer_id', Auth::id())->with(['student', 'competition'])->latest()->get();
        return view('mentorships.index', compact('mentorships'));
    }

    public function create() {
        // Get all Lecturers
        $lecturers = \App\Models\User::where('role', 'dosen')->with('profile')->get();
        // Get active recruitments/competitions of the current team leader
        $recruitments = \App\Models\Recruitment::where('user_id', Auth::id())
                                ->where('status', 'open')
                                ->with('competition')
                                ->get();
        
        return view('mentorships.request', compact('lecturers', 'recruitments'));
    }

    public function store(Request $request) {
        $request->validate([
            'lecturer_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competitions,id',
        ]);

        // Check if already requested for this competition
        $exists = Mentorship::where('student_id', Auth::id())
                            ->where('competition_id', $request->competition_id)
                            ->exists();
        
        if($exists) {
             return redirect()->back()->with('error', 'Anda sudah mengajukan bimbingan untuk kompetisi ini.');
        }

        Mentorship::create([
            'student_id' => Auth::id(), // As Ketua Tim
            'lecturer_id' => $request->lecturer_id,
            'competition_id' => $request->competition_id,
            'status' => 'pending'
        ]);
        return redirect()->route('dashboard.ketua')->with('success', 'Pengajuan bimbingan berhasil dikirim.');
    }

    public function update(Request $request, $id) {
        $mentorship = Mentorship::findOrFail($id);
        $mentorship->update(['status' => $request->status]);
        return redirect()->back();
    }

    public function apiLecturers() {
        return response()->json(\App\Models\User::where('role', 'dosen')->get());
    }
}