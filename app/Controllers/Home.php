<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper('auth');

        $data = [
            'title' => 'Papank Komputer'
        ];

        if (logged_in()) {
            return redirect()->to('/home');
        }

        return view('homepage', $data);
    }

    public function login(): string
    {
        $data = [
            'title' => 'Login',
            'config' => config('Auth'),
        ];

        return view('auth/login', $data);
    }

    public function register(): string
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth/register', $data);
    }
}
