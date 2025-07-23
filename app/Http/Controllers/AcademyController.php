<?php
// app/Http/Controllers/AcademyController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademyController extends Controller
{
    // app/Http/Controllers/AcademyController.php
public function status(Request $request)
{
    $user = auth()->user(); // or however you're getting the user
    return response()->json([
        'rank' => $user->academy_rank ?? 'Cadet',
        'points' => $user->academy_points ?? 0,
        'task' => $user->current_task ?? 'Orientation',
        'progress' => $user->task_progress ?? 0,
    ]);
}

}
