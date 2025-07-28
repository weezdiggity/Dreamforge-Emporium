<?php
namespace OGame\Http\Controllers\Auth;

use OGame\Http\Controllers\Controller;
use OGame\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use OGame\Game\Messages\PlayerRegisteredMessage; // adjust namespace to where you define it
use OGame\Helpers\GameMessageHelper; // adjust to your sendGameMessage location

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validate input
   $request->validate([
    'name' => 'required|string|max:255',
    'username' => 'required|string|max:255|unique:users', // 👈 Add this line
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8|confirmed',
]);

$user = \OGame\Models\User::create([
    'name' => $request->name,
    'username' => $request->username, // 👈 Add this line
    'email' => $request->email,
    'password' => bcrypt($request->password),
    'lang' => 'en',
]);


    // Log them in
    auth()->login($user);

    // Redirect
    return redirect('/overview');
}

    

    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
}


    protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);
}

}
