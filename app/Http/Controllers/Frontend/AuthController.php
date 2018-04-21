<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Services\Contracts\CustomerService;
use App\Repositories\Contracts\CustomerRepository;
use Auth;
use Socialite;

class AuthController extends Controller
{
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $redirectTo = '/';

    protected $loginView = 'frontend.auth.login';

    protected $registerView = 'frontend.auth.register';

    protected $guard = 'frontend';

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

    public function __construct()
    {
        $this->middleware('guest:frontend', ['except' => 'getLogout']);
    }

    public function getSocial($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleCallback(CustomerService $service, $social)
    {
        $user = Socialite::driver($social)->user();
        $customer = $this->findCustomer($user->getId(), $social);
        if ($customer) {
            $authCustomer = $customer;
        } else {
            $data = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'facebook_id' => $social == 'facebook' ? $user->getId() : '',
                'google_id' => $social == 'google' ? $user->getId() : '',
            ];
            $authCustomer = $this->createCustomer($service, $data);
        }
        Auth::guard('frontend')->login($authCustomer, true);
        return back();
    }

    public function findCustomer($customerId, $social = 'facebook')
    {
        if ($social == 'facebook') {
            $customer = app(CustomerRepository::class)->findCustomerFacebook($customerId);
        } elseif ($social == 'google') {
            $customer = app(CustomerRepository::class)->findCustomerGoogle($customerId);
        }

        return $customer;
    }

    public function createCustomer(CustomerService $service, $data)
    {
        try {
            $item = $service->store($data);
        } catch (\Exception $e) {
            throw $e;
        }
        return $item;
    }

    public function store(RegisterRequest $request, CustomerService $service)
    {
    	$data = $request->all();
    	try {
            $item = $service->store($data);
            Auth::guard('frontend')->login($item, true);
            $this->e['message'] = trans('object_created_successfully');
        } catch (\Exception $e) {
            //dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = trans('object_created_unsuccessfully');
        }
        return redirect('/')->with('flash_message_frontend',json_encode($this->e, true));
    }
}
