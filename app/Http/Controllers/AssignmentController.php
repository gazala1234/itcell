<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function index()
    {
        $cid = session('cid');
        $academicYears = Assignment::where('cid', $cid)->get();
        return view('Assignment.add_assignment', compact('academicYears'));
    }

    public function submitAssign()
    {
    }

    public function viewAssignment()
    {
        return view('Assignment.view_assignment');
    }

    public function d_assignTask()
    {
        return view('Assignment.dAssign_task');
    }
}
