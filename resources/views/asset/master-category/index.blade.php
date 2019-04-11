@extends('layouts.master')

@section('title', 'Master Category')

@section('content')
<!-- sample modal content -->
<!-- /.modal -->
<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <form id="form-delete" role="form" method="post" action="{{ URL($url . '/delete') }}">
            {{ csrf_field() }}
            <input type="hidden" id="p_category_id" name="p_category_id" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="p_category_name" >Are you sure to delete?</h4> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="btn-delete">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="info-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Information</h4>
                <br>
                 <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">Category Name</label>
                    </div>
                    <div class="col-md-8">
                        <p id="i_category_name"></p>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">Remarks</label>
                    </div>
                    <div class="col-md-8">
                        <p id="i_remarks"></p>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">Created By/Date</label>
                    </div>
                    <div class="col-md-8">
                        <p id="i_created"></p>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">Last Updated By/Date</label>
                    </div>
                    <div class="col-md-8">
                        <p id="i_last_updated"></p>
                    </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->
<div class="row">

    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6 nopadding">
                    <h3 class="box-title m-b-0">@yield('title')</h3>
                </div>
                <div class="col-sm-6 nopadding">
                    <a type="submit" href="{{ url($url).'/add' }}" class="btn btn-info waves-effect waves-light pull-right"> <i class="fa fa-plus m-r-5"></i> <span>New</span></a>
                </div>
            </div>
            <div class="row" style="padding-top:20px;">
            <!-- <p class="text-muted m-b-30"> -->
            <!-- </p> -->
                        
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="">Category Name</th>
                                <th width="">Remark</th>
                                <th width="" class="text-right">Action &nbsp &nbsp &nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                            <tr>
                                <td>{{ $model->category_name }}</td>
                                <td>{{ $model->remarks }}</td>
                                <td class="text-right">
                                    <a data-id="{{ $model->category_id }}" data-model="{{ json_encode($model) }}" data-toggle="modal" data-target="#info-modal" class="btn btn-info btn-outline btn-circle btn-xs m-r-5 md-trigger info-action" data-original-title="Information" data-modal="modal-info" >
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <a type="button" href="{{ url($url.'/edit').'/'.$model->category_id }}" class="btn btn-warning btn-outline btn-circle btn-xs m-r-5">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a data-id="{{ $model->category_id }}" data-label="{{ $model->category_name }}" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-outline btn-circle btn-xs m-r-5 md-trigger delete-action" data-original-title="Delete" data-modal="modal-delete" >
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
    $(document).on('ready', function(){
        // $('#myTable').DataTable();
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 
            ]
        });
    });

    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    $('.info-action').on('click', function() {
        $model = $(this).data('model');
        var $creationDate = new Date($model.creation_date);
        var $lastUpdateDate = new Date($model.last_update_date);

        $("#i_category_name").html(': ' + $model.category_name);
        $("#i_remarks").html($model.remarks ? ': ' + $model.remarks : ':' );
        $creationDate = $creationDate.getDate() + '-' + monthNames[$creationDate.getMonth()] + '-' +$creationDate.getFullYear()+ ' ' + $lastUpdateDate.getHours() + ':' + $lastUpdateDate.getMinutes();
        $("#i_created").html(': ' + $model.created_by + ' / ' + $creationDate);

        $lastUpdateDate =  $lastUpdateDate.getDate() + '-' + monthNames[$lastUpdateDate.getMonth()] + '-' +$lastUpdateDate.getFullYear() + ' ' + $lastUpdateDate.getHours() + ':' + $lastUpdateDate.getMinutes();
        $("#i_last_updated").html(': ' + $model.last_updated_by +  ' / ' + $lastUpdateDate);
    });

    $('.delete-action').on('click', function() {
        $("#p_category_id").val($(this).data('id'));
        $("#p_category_name").html('Are you sure want to delete ' + $(this).data('label') + '?');
    });

    $('#btn-delete').on('click', function(event) {
        event.preventDefault();
        $('#form-delete').trigger('submit');
    });

        
</script>
@endsection

