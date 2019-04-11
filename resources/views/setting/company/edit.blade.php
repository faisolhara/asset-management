@extends('layouts.master')

@section('title', 'Company')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Update Data Company</h3>
            <form class="form-horizontal" method="POST" action="{{ url('setting/company/save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('p_book_name') ? 'has-error' : '' }}">
                        <label for="p_book_name" class="col-sm-3 control-label">Book Name*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_book_name" required value="{{ count($errors) > 0 ? old('p_book_name') : $model->book_name }}"> 
                            @if($errors->has('p_book_name'))
                            <span class="help-block">{{ $errors->first('p_book_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_company_name') ? 'has-error' : '' }}">
                        <label for="p_company_name" class="col-sm-3 control-label">Company Name*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_company_name" required value="{{ count($errors) > 0 ? old('p_company_name') : $model->company_name }}"> 
                            @if($errors->has('p_company_name'))
                            <span class="help-block">{{ $errors->first('p_company_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_country_code') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3">Country*</label>
                        <?php $countryCode = count($errors) > 0 ? old('p_country_code') : $model->country_code ?>
                        <div class="col-md-9">
                            <select class="form-control" data-placeholder="Choose a Country" tabindex="1" id="p_country_code" name="p_country_code">
                                <option value="">Select a Country</option>
                                @foreach($country as $data)
                                <option value="{{ $data->country_code }}" {{ $data->country_code == $countryCode ? 'selected' : '' }}>{{ $data->country_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('p_country_code'))
                            <span class="help-block">{{ $errors->first('p_country_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Province*</label>
                        <div class="col-md-9">
                            <select class="form-control" data-placeholder="Choose a Province" tabindex="1" id="p_province_code" name="p_province_code">
                                <option value="">Select a Province</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">City *</label>
                        <div class="col-md-9">
                            <select class="form-control" data-placeholder="Choose a City" tabindex="1" id="p_city_code" name="p_city_code">
                                <option value="">Select a City</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_postal_code') ? 'has-error' : '' }}">
                        <label for="p_postal_code" class="col-sm-3 control-label">Postal Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_postal_code" value="{{ count($errors) > 0 ? old('p_postal_code') : $model->postal_code }}"> 
                            @if($errors->has('p_postal_code'))
                            <span class="help-block">{{ $errors->first('p_postal_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_address_detail') ? 'has-error' : '' }}">
                        <label for="p_address_detail" class="col-sm-3 control-label">Address Detail</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" name="p_address_detail">{{ count($errors) > 0 ? old('p_addres_detail') : $model->address_detail }}</textarea>
                            @if($errors->has('p_address_detail'))
                            <span class="help-block">{{ $errors->first('p_address_detail') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('p_phone1') ? 'has-error' : '' }}">
                        <label for="p_phone1" class="col-sm-3 control-label">Phone 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_phone1" value="{{ count($errors) > 0 ? old('p_phone1') : $model->phone1 }}"> 
                            @if($errors->has('p_phone1'))
                            <span class="help-block">{{ $errors->first('p_phone1') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_phone2') ? 'has-error' : '' }}">
                        <label for="p_phone2" class="col-sm-3 control-label">Phone 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_phone2" value="{{ count($errors) > 0 ? old('p_phone2') : $model->phone2 }}"> 
                            @if($errors->has('p_phone2'))
                            <span class="help-block">{{ $errors->first('p_phone2') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_fax1') ? 'has-error' : '' }}">
                        <label for="p_fax1" class="col-sm-3 control-label">Fax 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_fax1" value="{{ count($errors) > 0 ? old('p_fax1') : $model->fax1 }}"> 
                            @if($errors->has('p_fax1'))
                            <span class="help-block">{{ $errors->first('p_fax1') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_fax2') ? 'has-error' : '' }}">
                        <label for="p_fax2" class="col-sm-3 control-label">Fax 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_fax2" value="{{ count($errors) > 0 ? old('p_fax2') : $model->fax2 }}"> 
                            @if($errors->has('p_fax2'))
                            <span class="help-block">{{ $errors->first('p_fax2') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_email_address') ? 'has-error' : '' }}">
                        <label for="p_email_address" class="col-sm-3 control-label">Email Address *</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="p_email_address" value="{{ count($errors) > 0 ? old('p_email_address') : $model->email_address }}" required> 
                            @if($errors->has('p_email_address'))
                            <span class="help-block">{{ $errors->first('p_email_address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('p_logo') ? 'has-error' : '' }}">
                        <label for="p_logo" class="col-sm-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" id="p_logo" name="p_logo" class="dropify" data-default-file="{{ asset('upload/images/logo/original/'.$model->logo) }}" />
                        </div> 
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-right">
                        <a type="submit" href="{{ url('/') }}" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-undo m-r-5"></i> <span>Cancel</span></a>
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
        $('#p_country_code').on('change', countryChange);
        $('#p_province_code').on('change', provinceChange);

        loadProvince('{{ $model->country_code }}');
        loadCity('{{ $model->province_code }}');

        $('.dropify').dropify();
        // Translated

        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
        

    });
    
    var countryChange = function(){

        $('#p_province_code').val("");
        $('#p_city_code').val("");

        loadProvince($('#p_country_code').val());
        
    };

    var loadProvince = function($provinceCode){
        xhrProvince = $.ajax({
            url: '{{ URL($url.'/get-json-province') }}',
            data: {p_country_code: $provinceCode },
            success: function(data) {

                $('#p_province_code').html('');

                $('#p_province_code').append(
                    '<option value="">Select a Province</option>'
                );
                data.forEach(function(item) {
                    if(item.province_code == '{{ $model->province_code }}'){
                        $('#p_province_code').append(
                            '<option value="'+ item.province_code +'" selected>'+ item.province_name +'</option>'
                        );
                    }else{
                        $('#p_province_code').append(
                            '<option value="'+ item.province_code +'">'+ item.province_name +'</option>'
                        );
                    }
                });

                if (typeof(callback) == 'function') {
                    callback();
                }
            }
        });
    };

    var provinceChange = function(){
        $('#p_city_code').val("");
        loadCity($('#p_province_code').val());
    }

    var loadCity = function($cityCode){
        xhrProvince = $.ajax({
            url: '{{ URL($url.'/get-json-city') }}',
            data: {p_province_code: $cityCode },
            success: function(data) {

                $('#p_city_code').html('');

                $('#p_city_code').append(
                    '<option value="">Select a City</option>'
                );
                data.forEach(function(item) {
                    if(item.city_code == '{{ $model->city_code }}'){
                        $('#p_city_code').append(
                            '<option value="'+ item.city_code +'" selected>'+ item.city_name +'</option>'
                        );
                    }else{
                        $('#p_city_code').append(
                            '<option value="'+ item.city_code +'">'+ item.city_name +'</option>'
                        );
                    }
                });

                if (typeof(callback) == 'function') {
                    callback();
                }
            }
        });

        
    };
</script>
@endsection