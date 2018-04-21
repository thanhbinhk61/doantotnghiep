<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $guard = 'frontend';

    protected $linkRequestView = 'frontend.auth.reset';

    public function __construct()
    {
        $this->middleware('guest:frontend');
    }
}
