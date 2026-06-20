<?php
namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    
    // Public List (Guest/Mahasiswa)
    public function index()
    {
        $recruitments = Recruitment::where('status', 'open')->latest()->get();
        return view('recruitments.index', compact('recruitments'));
    }

    // Manage List (Ketua Tim)
    public function manageIndex()
    {
        $recruitments = Recruitment::where('user_id', Auth::id())->latest()->get();
        return view('recruitments.manage', compact('recruitments')); // New view for management
    }

    public function applicants(Recruitment $recruitment) {
        if (Auth::id() !== $recruitment->user_id) {
            abort(403);
        }
        
        $recruitment->load(['applications.user.profile']);
        return view('recruitments.applicants', compact('recruitment'));
    }

    public function show(Recruitment $recruitment)
    {
        return view('recruitments.show', compact('recruitment'));
    }

    public function create()
    {
        $competitions = Competition::all();
        return view('recruitments.create', compact('competitions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            // Competition Validation
            'competition_title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'organizer' => 'required|string|max:100',
            'deadline' => 'required|date',
            'link_guidebook' => 'nullable|url',
            'poster' => 'nullable|image|max:2048',
            
            // Recruitment Validation
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        // Handle Poster Upload
        $posterPath = null;
        if ($request->hasFile('poster')) {
            // Store in 'public/competitions'
            $posterPath = $request->file('poster')->store('competitions', 'public');
        }

        // Create Competition
        $competition = Competition::create([
            'title' => $request->competition_title,
            'category' => $request->category,
            'organizer' => $request->organizer,
            'deadline' => $request->deadline,
            'link_guidebook' => $request->link_guidebook,
            'poster_path' => $posterPath,
            'is_active' => true,
        ]);

        // Create Recruitment linked to the Competition
        Recruitment::create([
            'user_id' => Auth::id(),
            'competitions_id' => $competition->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('recruitments.manage')->with('success', 'Lowongan dan Kompetisi berhasil dibuat!');
    }

    

    public function edit(Recruitment $recruitment)
    {

        if ($recruitment->user_id !== Auth::id()) {
            abort(403);
        }

        $competitions = Competition::all();
        return view('recruitments.edit', compact('recruitment', 'competitions'));
    }

    public function update(Request $request, Recruitment $recruitment)
    {
        if ($recruitment->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:150',
            'status' => 'required|in:open,closed',
        ]);

        $recruitment->update($request->all());

        return redirect()->route('recruitments.manage')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(Recruitment $recruitment)
    {
        if ($recruitment->user_id !== Auth::id()) {
            abort(403);
        }

        $recruitment->delete();

        return redirect()->route('recruitments.manage')->with('success', 'Lowongan berhasil dihapus!');
    }

    public function apiIndex()
    {
        return response()->json(Recruitment::where('status', 'open')->latest()->get());
    }
}