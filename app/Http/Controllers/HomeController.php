<?php

namespace App\Http\Controllers;

use App\Models\SettingEloquentStorage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(SettingEloquentStorage $setting): string
    {
        return view('welcome', [
            'setting' => $setting->group('home'),
        ]);
    }
}
