<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorshipController;

Route::prefix('v1')->group(function () {
    Route::get('/vacancies', [RecruitmentController::class, 'apiIndex']);
    Route::get('/profile/{nim}', [ProfileController::class, 'apiShow']);
    Route::get('/lecturers', [MentorshipController::class, 'apiLecturers']);
});
