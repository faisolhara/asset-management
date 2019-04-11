@extends('layouts.master')

@section('title', 'Company')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Update User</h3>
            <form class="form-horizontal" method="POST" action="{{ url('setting/user/save') }}">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="p_user_id" required value=""> 
                <div class="form-group {{ $errors->has('p_user_name') ? 'has-error' : '' }}">
                    <label for="p_user_name" class="col-sm-3 control-label">Username *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="p_user_name" value="{{ count($errors) > 0 ? old('p_user_name') : $model->user_name }}" required> 
                        @if($errors->has('p_user_name'))
                        <span class="help-block">{{ $errors->first('p_user_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('p_email_address') ? 'has-error' : '' }}">
                    <label for="p_email_address" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="p_email_address" value="{{ count($errors) > 0 ? old('p_user_name') : $model->email_address }}"> 
                        @if($errors->has('p_email_address'))
                        <span class="help-block">{{ $errors->first('p_email_address') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('p_start_date') ? 'has-error' : '' }}">
                    <label for="p_start_date" class="col-sm-3 control-label">Start Date</label>
                    <?php
                    if (count($errors) > 0) {
                        $startDate = !empty(old('p_start_date')) ? new \DateTime(old('p_start_date')) : new \DateTime();
                    } else {
                        $startDate = !empty($model->start_date) ? new \DateTime($model->start_date) : new \DateTime();
                    }
                    ?>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="datepicker-start-date" placeholder="dd-mm-yyyy" value="{{ $startDate !== null ? $startDate->format('d-m-Y') : '' }}">
                        <!-- <span class="input-group-addon"><i class="icon-calender"></i></span>  -->
                        @if($errors->has('p_start_date'))
                        <span class="help-block">{{ $errors->first('p_start_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('p_end_date') ? 'has-error' : '' }}">
                    <label for="p_end_date" class="col-sm-3 control-label">End Date</label>
                    <?php
                    if (count($errors) > 0) {
                        $endDate = !empty(old('p_end_date')) ? new \DateTime(old('p_end_date')) : null;
                    } else {
                        $endDate = !empty($model->end_date) ? new \DateTime($model->end_date) : null;
                    }
                    ?>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="datepicker-end-date" placeholder="dd-mm-yyyy" value="{{ $endDate !== null ? $endDate->format('d-m-Y') : '' }}">
                        <!-- <span class="input-group-addon"><i class="icon-calender"></i></span>  -->
                        @if($errors->has('p_end_date'))
                        <span class="help-block">{{ $errors->first('p_end_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('p_remarks') ? 'has-error' : '' }}">
                    <label for="p_remarks" class="col-sm-3 control-label">Remark</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="5" name="p_remarks"></textarea>
                        @if($errors->has('p_remarks'))
                        <span class="help-block">{{ $errors->first('p_remarks') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('p_status') ? 'has-error' : '' }}">
                    <label for="p_status" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                        <div class="checkbox checkbox-success checkbox-circle">
                             <?php $status = count($errors) > 0 ? old('p_status') : $model->status; ?>
                            <input type="checkbox" id="p_status" type="checkbox" name="p_status" value="Y" {{ $status == 'Y' ? 'checked' : '' }}>
                            <label for="p_status"> Active </label>
                        </div>
                        @if($errors->has('p_status'))
                        <span class="help-block">{{ $errors->first('p_status') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                        <a type="submit" href="{{ url($url) }}" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-undo m-r-5"></i> <span>Cancel</span></a>
                        <button type="submit" class="btn btn-info waves-effect waves-light"> <i class="fa fa-save m-r-5"></i> <span>Save</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection

@section('script')
@parent
<script type="text/javascript">
    $(document).on('ready', function(){

    });
    jQuery('#datepicker-start-date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
    });
    jQuery('#datepicker-end-date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
    });
   
</script>
@endsection