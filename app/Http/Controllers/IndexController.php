<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill_Set;
class IndexController extends Controller
{
    public function index()
    {
    	return view('landing_page');
    }

    public function handle_err()
    {
    	return view('errors.404');
    }
}	