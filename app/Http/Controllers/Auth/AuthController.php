<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Redirect;
use Socialite;
use Validator;
use Faker\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Socialite\Contracts\User as UserContract;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'captcha'  => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleFacebookProviderCallback()
    {
        return $this->handleOAuthProviderCallback('facebook');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleTwitterProviderCallback()
    {
        return $this->handleOAuthProviderCallback('twitter');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleGoogleProviderCallback()
    {
        return $this->handleOAuthProviderCallback('google');
    }

    /**
     * Gets the user model according to the user contract given.
     *
     * @param UserContract $user The user object from the oauth event.
     *
     * @return \App\User The user model from the database.
     */
    private function getUserModel(UserContract $user)
    {
        $faker = Factory::create();

        $model = User::whereEmail($user->getEmail())->first();

        if (!$model) {
            $model           = new User();
            $model->name     = $user->getName();
            $model->email    = $user->getEmail();
            $model->password = bcrypt($faker->words(5, true));
            $model->admin    = false;

            $model->save();
        }

        return $model;
    }

    /**
     * Handles the different callbacks from the Socialite drivers.
     *
     * @param string $driver The string with the drivers name.
     * @param string $redirect The route to redirect to.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function handleOAuthProviderCallback($driver, $redirect = 'home.index')
    {
        $user = Socialite::driver($driver)->user();

        Auth::login($this->getUserModel($user), true);

        return Redirect::route($redirect);
    }
}
