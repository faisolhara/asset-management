@extends('layouts.master')

@section('title', 'Company')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Management User</h3>
            <p class="text-muted m-b-30"></p>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Employee</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($models as $model)
                        <tr>
                            <td>{{ $model->user_name }}</td>
                            <td>{{ $model->email_address }}</td>
                            <td>{{ $model->employee_name }}</td>
                            <td>{{ $model->start_date }}</td>
                            <td>{{ $model->end_date }}</td>
                            <td>{{ $model->status }}</td>
                            <td><a type="button" href="{{ url('setting/user/edit').'/'.$model->user_id }}" class="btn btn-info btn-outline btn-circle btn-xs m-r-5"><i class="ti-pencil-alt"></i></a></td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
    $(document).on('ready', function(){
        $('#myTable').DataTable();
    });
</script>
@endsection