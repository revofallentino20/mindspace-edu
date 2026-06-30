<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return file_get_contents(public_path('index.html'));
});

// Public screening routes (tanpa login)
Route::get('/screening', [App\Http\Controllers\PublicScreeningController::class, 'consent'])->name('screening.consent');
Route::get('/screening/form', [App\Http\Controllers\PublicScreeningController::class, 'index'])->name('screening.form');
Route::post('/screening', [App\Http\Controllers\PublicScreeningController::class, 'store'])->name('screening.store');
Route::get('/screening/result', [App\Http\Controllers\PublicScreeningController::class, 'result'])->name('screening.result');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $isSuperAdmin = $user->isSuperAdmin();

        $screeningQuery = $isSuperAdmin ? \App\Models\Screening::query() : \App\Models\Screening::where('school_id', $user->school_id);
        $appointmentQuery = $isSuperAdmin ? \App\Models\Appointment::query() : \App\Models\Appointment::where('school_id', $user->school_id);

        $totalScreening   = (clone $screeningQuery)->count();
        $tinggi           = (clone $screeningQuery)->where('status', 'tinggi')->count();
        $sedang           = (clone $screeningQuery)->where('status', 'sedang')->count();
        $rendah           = (clone $screeningQuery)->where('status', 'rendah')->count();
        $totalAppointment = (clone $appointmentQuery)->count();
        $pending          = (clone $appointmentQuery)->where('status', 'pending')->count();

        $kelasList   = (clone $screeningQuery)->select('kelas')->distinct()->pluck('kelas');
        $chartLabels = $kelasList->values();
        $chartTinggi = $kelasList->map(fn($k) => (clone $screeningQuery)->where('kelas',$k)->where('status','tinggi')->count());
        $chartSedang = $kelasList->map(fn($k) => (clone $screeningQuery)->where('kelas',$k)->where('status','sedang')->count());
        $chartRendah = $kelasList->map(fn($k) => (clone $screeningQuery)->where('kelas',$k)->where('status','rendah')->count());

        return view('dashboard', compact(
            'totalScreening','tinggi','sedang','rendah',
            'totalAppointment','pending',
            'chartLabels','chartTinggi','chartSedang','chartRendah'
        ));
    })->name('dashboard');

    Route::resource('screenings', ScreeningController::class);
    Route::get('screenings/export/pdf', [ScreeningController::class, 'exportPdf'])->name('screenings.export');
    Route::resource('schools', App\Http\Controllers\SchoolController::class)->middleware('auth');
    Route::resource('appointments', AppointmentController::class);
});

require __DIR__.'/auth.php';