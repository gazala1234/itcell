<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('Assignment.add_assignment');
    }

    public function submitAssign()
    {

    }

    public function viewAssignment()
    {
        return view('Assignment.view_assignment');
    }
}
