@extends('mainPage')

@section('maincontent')
    <div class="container">
        <div class='assign-task-form'>
            <h4 class="text-center">View Assigned Tasks</h2>
                <form action="" method="post">
                    <div class="form-group">
                        {{-- <label for="status">Task Status</label> --}}
                        <select name="status" id="status" class="form-control mt-5">
                            <option value="">Select Task Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Complete</option>
                            <option value="2">Partial</option>
                        </select>
                    </div>
                </form>
        </div>
    </div>
@endsection
