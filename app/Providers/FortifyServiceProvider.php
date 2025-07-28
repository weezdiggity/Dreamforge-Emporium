<?php

namespace OGame\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use OGame\Actions\Fortify\CreateNewUser;
use OGame\Actions\Fortify\ResetUserPassword;
use OGame\Actions\Fortify\UpdateUserPassword;
use OGame\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(RegisterViewResponse::class, function () {
        return new class implements \Laravel\Fortify\Contracts\RegisterViewResponse {
            public function toResponse($request)
            {
                return view('auth.register'); // Or your custom registration view
            }
        };
    });
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(20)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(20)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('outgame.login');
        });

        /*Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.reset-password');
        });*/
    }
}
