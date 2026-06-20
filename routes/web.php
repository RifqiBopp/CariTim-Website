<?php

use App\Http\Controllers\GantiRoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MentorshipController;

use App\Models\Recruitment;

//guest
Route::get('/', function () {
    $recruitments = Recruitment::where('status', 'open')->latest()->take(6)->get();
    return view('welcome', compact('recruitments'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Authenticated atau berhasil login
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return match (Auth::user()->role) {
            'ketua_tim' => redirect()->route('dashboard.ketua'),
            'dosen'     => redirect()->route('dashboard.dosen'),
            default     => redirect()->route('dashboard.mahasiswa'),
        };
    })->name('dashboard');

    //halaman dashboard sesuai role
    Route::middleware('role:mahasiswa')->get('/dashboard/mahasiswa', function () {
        return view('dashboard.mahasiswa');
    })->name('dashboard.mahasiswa');
    
    Route::middleware('role:dosen')->get('/dashboard/dosen', function () {
        return view('dashboard.dosen');
    })->name('dashboard.dosen');

    Route::middleware('role:ketua_tim')->get('/dashboard/ketua', function () {
        return view('dashboard.ketua');
    })->name('dashboard.ketua');


    //ganti role
    Route::post('/Ganti-Ketua', [GantiRoleController::class, 'keKetua'])
        ->middleware('role:mahasiswa')
        ->name('ganti-ketua');
    Route::post('/Ganti-Mahasiswa', [GantiRoleController::class, 'keMahasiswa'])
        ->middleware('role:ketua_tim')
        ->name('ganti-mahasiswa');

    //profile (semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//tampilan gust semua mahasiswa bisa lihat
Route::get('/recruitments', [RecruitmentController::class, 'index'])->name('recruitments.index');
Route::get('/recruitments/{recruitment}', [RecruitmentController::class, 'show'])->name('recruitments.show')->where('recruitment', '[0-9]+');

//crud role ketua_tim
Route::middleware(['auth','role:ketua_tim'])->group(function () {
    Route::get('/manage-recruitments', [RecruitmentController::class, 'manageIndex'])->name('recruitments.manage');
    Route::get('/recruitments/manage', [RecruitmentController::class, 'manage'])->name('recruitments.manage');
    Route::get('/recruitments/create', [RecruitmentController::class, 'create'])->name('recruitments.create');
    Route::get('/recruitments/{recruitment}/applicants', [RecruitmentController::class, 'applicants'])->name('recruitments.applicants');
    Route::resource('recruitments', RecruitmentController::class)   
        ->except(['index','show']);
        
    // Mentorship Request
    Route::get('/request-mentorship', [MentorshipController::class, 'create'])->name('mentorships.create');
    Route::post('/request-mentorship', [MentorshipController::class, 'store'])->name('mentorships.store');
});

//daftar tim
Route::middleware(['auth','role:mahasiswa'])->group(function () {
    Route::post('/apply/{recruitment}', [ApplicationController::class, 'store'])
        ->name('applications.store');

    Route::resource('applications', ApplicationController::class)
        ->only(['index', 'destroy']);
});

Route::middleware(['auth'])->group(function () {
     Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
});

//crud role dosen
Route::middleware(['auth','role:dosen'])->group(function () {
    Route::resource('mentorships', MentorshipController::class);
});

require __DIR__.'/auth.php';