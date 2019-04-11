@extends('layouts.master')

@section('title', 'Master Organization')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{{ $title }} @yield('title')</h3>
            
<div class="row" >
    <div class="col-md-6">
            <form class="form-horizontal" method="POST" action="{{ url($url.'/save') }}">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="p_organization_id" required value="{{ !empty($model->organization_id) ? $model->organization_id : '' }}">
                <?php $organization_name = !empty($model->organization_name) ? $model->organization_name : ''; ?> 
                <div class="form-group {{ $errors->has('p_organization_name') ? 'has-error' : '' }}">
                    <label for="p_organization_name" class="col-sm-3 control-label">Organization Name*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="p_organization_name" value="{{ count($errors) > 0 ? old('p_organization_name') : $organization_name }}" required maxlength = "100"> 
                        @if($errors->has('p_organization_name'))
                        <span class="help-block">{{ $errors->first('p_organization_name') }}</span>
                        @endif
                    </div>
                </div>
                
                <?php $remarks = !empty($model->remarks) ? $model->remarks : ''; ?> 
                <div class="form-group {{ $errors->has('p_remarks') ? 'has-error' : '' }}">
                    <label for="p_remarks" class="col-sm-3 control-label">Remark</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="5" name="p_remarks" maxlength = "500">{{ count($errors) > 0 ? old('p_remarks') : $remarks }}</textarea>
                        @if($errors->has('p_remarks'))
                        <span class="help-block">{{ $errors->first('p_remarks') }}</span>
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