<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill_Set;
class IndexController extends Controller
{
    public function index()
    {
    	return view('errors.404');
    }

    public function handle_err()
    {
    	return view('errors.404');
    }
}	