@extends('layouts.master')

@section('title', 'Master Category')

@section('content')
<div id="flexfield-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal-title"></h4>
                <br>
                 <div class="row">
                    <input type="hidden" name="m_attribute_name" id="m_attribute_name" value="">
                    <div class="form-group">
                        <label for="p_flex_value" class="col-sm-3 control-label">Value*</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="p_flex_value" name="p_flex_value" value="" required maxlength = "200"> 
                            <span class="help-block"></span>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-success waves-effect" id="add-flex-value">Add Value</button>
                        </div>
                    </div>
                 </div>
                    <hr>
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-lov-unit">
                            <thead>
                                <tr>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{{ $title }} @yield('title')</h3>
            <form class="form-horizontal" method="POST" action="{{ url($url.'/save') }}">
                <div class="row" >
                    <div class="col-md-6">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="p_category_id" id="p_category_id" required value="{{ !empty($model->category_id) ? $model->category_id : '' }}">
                        <?php $category_name = !empty($model->category_name) ? $model->category_name : ''; ?> 
                        <div class="form-group {{ $errors->has('p_category_name') ? 'has-error' : '' }}">
                            <label for="p_category_name" class="col-sm-3 control-label">Category Name*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="p_category_name" value="{{ count($errors) > 0 ? old('p_category_name') : $category_name }}" required maxlength = "100"> 
                                @if($errors->has('p_category_name'))
                                <span class="help-block">{{ $errors->first('p_category_name') }}</span>
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
                    </div>
                </div>
                <hr>
                <div class="row" >
                    <div class="col-md-12">
                        <?php $attribute1 = !empty($flexfield->attribute1) ? $flexfield->attribute1 : ''; ?> 
                        <?php $label1     = !empty($flexfield->label1) ? $flexfield->label1 : ''; ?> 
                        <?php $group1     = !empty($flexfield->group1) ? $flexfield->group1 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute1') ? 'has-error' : '' }}">
                            <label for="p_attribute1" class="col-sm-2 control-label">Attribute 1</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute1" name="p_attribute1">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute1') : $attribute1 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute1') : $attribute1 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup1" value="attribute1" {{ $attribute1 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label1" value="{{ count($errors) > 0 ? old('p_label1') : $label1 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label1'))
                                <span class="help-block">{{ $errors->first('p_label1') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group1" value="{{ count($errors) > 0 ? old('p_group1') : $group1 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group1'))
                                <span class="help-block">{{ $errors->first('p_group1') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute2 = !empty($flexfield->attribute2) ? $flexfield->attribute2 : ''; ?> 
                        <?php $label2     = !empty($flexfield->label2) ? $flexfield->label2 : ''; ?> 
                        <?php $group2     = !empty($flexfield->group2) ? $flexfield->group2 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute2') ? 'has-error' : '' }}">
                            <label for="p_attribute2" class="col-sm-2 control-label">Attribute 2</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute2" name="p_attribute2">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute2') : $attribute2 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute2') : $attribute2 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup2" value="attribute2" {{ $attribute2 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label2" value="{{ count($errors) > 0 ? old('p_label2') : $label2 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label2'))
                                <span class="help-block">{{ $errors->first('p_label2') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group2" value="{{ count($errors) > 0 ? old('p_group2') : $group2 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group2'))
                                <span class="help-block">{{ $errors->first('p_group2') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute3 = !empty($flexfield->attribute3) ? $flexfield->attribute3 : ''; ?> 
                        <?php $label3     = !empty($flexfield->label3) ? $flexfield->label3 : ''; ?> 
                        <?php $group3     = !empty($flexfield->group3) ? $flexfield->group3 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute3') ? 'has-error' : '' }}">
                            <label for="p_attribute3" class="col-sm-2 control-label">Attribute 3</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute3" name="p_attribute3">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute3') : $attribute3 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute3') : $attribute3 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup3" value="attribute3" {{ $attribute3 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label3" value="{{ count($errors) > 0 ? old('p_label3') : $label3 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label3'))
                                <span class="help-block">{{ $errors->first('p_label3') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group3" value="{{ count($errors) > 0 ? old('p_group3') : $group3 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group3'))
                                <span class="help-block">{{ $errors->first('p_group3') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute4 = !empty($flexfield->attribute4) ? $flexfield->attribute4 : ''; ?> 
                        <?php $label4     = !empty($flexfield->label4) ? $flexfield->label4 : ''; ?> 
                        <?php $group4     = !empty($flexfield->group4) ? $flexfield->group4 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute4') ? 'has-error' : '' }}">
                            <label for="p_attribute4" class="col-sm-2 control-label">Attribute 4</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute4" name="p_attribute4">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute4') : $attribute4 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute4') : $attribute4 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup4" value="attribute4" {{ $attribute4 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label4" value="{{ count($errors) > 0 ? old('p_label4') : $label4 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label4'))
                                <span class="help-block">{{ $errors->first('p_label4') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group4" value="{{ count($errors) > 0 ? old('p_group4') : $group4 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group4'))
                                <span class="help-block">{{ $errors->first('p_group4') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute5 = !empty($flexfield->attribute5) ? $flexfield->attribute5 : ''; ?> 
                        <?php $label5     = !empty($flexfield->label5) ? $flexfield->label5 : ''; ?> 
                        <?php $group5     = !empty($flexfield->group5) ? $flexfield->group5 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute5') ? 'has-error' : '' }}">
                            <label for="p_attribute5" class="col-sm-2 control-label">Attribute 5</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute5" name="p_attribute5">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute5') : $attribute5 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute5') : $attribute5 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup5" value="attribute5" {{ $attribute5 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label5" value="{{ count($errors) > 0 ? old('p_label5') : $label5 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label5'))
                                <span class="help-block">{{ $errors->first('p_label5') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group5" value="{{ count($errors) > 0 ? old('p_group5') : $group5 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group5'))
                                <span class="help-block">{{ $errors->first('p_group5') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute6 = !empty($flexfield->attribute6) ? $flexfield->attribute6 : ''; ?> 
                        <?php $label6     = !empty($flexfield->label6) ? $flexfield->label6 : ''; ?> 
                        <?php $group6     = !empty($flexfield->group6) ? $flexfield->group6 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute6') ? 'has-error' : '' }}">
                            <label for="p_attribute6" class="col-sm-2 control-label">Attribute 6</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute6" name="p_attribute6">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute6') : $attribute6 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute6') : $attribute6 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup6" value="attribute6" {{ $attribute6 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label6" value="{{ count($errors) > 0 ? old('p_label6') : $label6 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label6'))
                                <span class="help-block">{{ $errors->first('p_label6') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group6" value="{{ count($errors) > 0 ? old('p_group6') : $group6 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group6'))
                                <span class="help-block">{{ $errors->first('p_group6') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute7 = !empty($flexfield->attribute7) ? $flexfield->attribute7 : ''; ?> 
                        <?php $label7     = !empty($flexfield->label7) ? $flexfield->label7 : ''; ?> 
                        <?php $group7     = !empty($flexfield->group7) ? $flexfield->group7 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute7') ? 'has-error' : '' }}">
                            <label for="p_attribute7" class="col-sm-2 control-label">Attribute 7</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute7" name="p_attribute7">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute7') : $attribute7 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute7') : $attribute7 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup7" value="attribute7" {{ $attribute7 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label7" value="{{ count($errors) > 0 ? old('p_label7') : $label7 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label7'))
                                <span class="help-block">{{ $errors->first('p_label7') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group7" value="{{ count($errors) > 0 ? old('p_group7') : $group7 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group7'))
                                <span class="help-block">{{ $errors->first('p_group7') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute8 = !empty($flexfield->attribute8) ? $flexfield->attribute8 : ''; ?> 
                        <?php $label8     = !empty($flexfield->label8) ? $flexfield->label8 : ''; ?> 
                        <?php $group8     = !empty($flexfield->group8) ? $flexfield->group8 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute8') ? 'has-error' : '' }}">
                            <label for="p_attribute8" class="col-sm-2 control-label">Attribute 8</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute8" name="p_attribute8">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute8') : $attribute8 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute8') : $attribute8 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup8" value="attribute8" {{ $attribute8 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label8" value="{{ count($errors) > 0 ? old('p_label8') : $label8 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label8'))
                                <span class="help-block">{{ $errors->first('p_label8') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group8" value="{{ count($errors) > 0 ? old('p_group8') : $group8 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group8'))
                                <span class="help-block">{{ $errors->first('p_group8') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute9 = !empty($flexfield->attribute9) ? $flexfield->attribute9 : ''; ?> 
                        <?php $label9     = !empty($flexfield->label9) ? $flexfield->label9 : ''; ?> 
                        <?php $group9     = !empty($flexfield->group9) ? $flexfield->group9 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute9') ? 'has-error' : '' }}">
                            <label for="p_attribute9" class="col-sm-2 control-label">Attribute 9</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute9" name="p_attribute9">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute9') : $attribute9 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute9') : $attribute9 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup9" value="attribute9" {{ $attribute9 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label9" value="{{ count($errors) > 0 ? old('p_label9') : $label9 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label9'))
                                <span class="help-block">{{ $errors->first('p_label9') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group9" value="{{ count($errors) > 0 ? old('p_group9') : $group9 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group9'))
                                <span class="help-block">{{ $errors->first('p_group9') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute10 = !empty($flexfield->attribute10) ? $flexfield->attribute10 : ''; ?> 
                        <?php $label10     = !empty($flexfield->label10) ? $flexfield->label10 : ''; ?> 
                        <?php $group10     = !empty($flexfield->group10) ? $flexfield->group10 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute10') ? 'has-error' : '' }}">
                            <label for="p_attribute10" class="col-sm-2 control-label">Attribute 10</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute10" name="p_attribute10">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute10') : $attribute10 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute10') : $attribute10 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup10" value="attribute10" {{ $attribute10 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label10" value="{{ count($errors) > 0 ? old('p_label10') : $label10 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label10'))
                                <span class="help-block">{{ $errors->first('p_label10') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group10" value="{{ count($errors) > 0 ? old('p_group10') : $group10 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group10'))
                                <span class="help-block">{{ $errors->first('p_group10') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute11 = !empty($flexfield->attribute11) ? $flexfield->attribute11 : ''; ?> 
                        <?php $label11     = !empty($flexfield->label11) ? $flexfield->label11 : ''; ?> 
                        <?php $group11     = !empty($flexfield->group11) ? $flexfield->group11 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute11') ? 'has-error' : '' }}">
                            <label for="p_attribute11" class="col-sm-2 control-label">Attribute 11</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute11" name="p_attribute11">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute11') : $attribute11 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute11') : $attribute11 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup11" value="attribute11" {{ $attribute11 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label11" value="{{ count($errors) > 0 ? old('p_label11') : $label11 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label11'))
                                <span class="help-block">{{ $errors->first('p_label11') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group11" value="{{ count($errors) > 0 ? old('p_group11') : $group11 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group11'))
                                <span class="help-block">{{ $errors->first('p_group11') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute12 = !empty($flexfield->attribute12) ? $flexfield->attribute12 : ''; ?> 
                        <?php $label12     = !empty($flexfield->label12) ? $flexfield->label12 : ''; ?> 
                        <?php $group12     = !empty($flexfield->group12) ? $flexfield->group12 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute12') ? 'has-error' : '' }}">
                            <label for="p_attribute12" class="col-sm-2 control-label">Attribute 12</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute12" name="p_attribute12">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute12') : $attribute12 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute12') : $attribute12 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup12" value="attribute12" {{ $attribute12 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label12" value="{{ count($errors) > 0 ? old('p_label12') : $label12 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label12'))
                                <span class="help-block">{{ $errors->first('p_label12') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group12" value="{{ count($errors) > 0 ? old('p_group12') : $group12 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group12'))
                                <span class="help-block">{{ $errors->first('p_group12') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute13 = !empty($flexfield->attribute13) ? $flexfield->attribute13 : ''; ?> 
                        <?php $label13     = !empty($flexfield->label13) ? $flexfield->label13 : ''; ?> 
                        <?php $group13     = !empty($flexfield->group13) ? $flexfield->group13 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute13') ? 'has-error' : '' }}">
                            <label for="p_attribute13" class="col-sm-2 control-label">Attribute 13</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute13" name="p_attribute13">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute13') : $attribute13 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute13') : $attribute13 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup13" value="attribute13" {{ $attribute13 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label13" value="{{ count($errors) > 0 ? old('p_label13') : $label13 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label13'))
                                <span class="help-block">{{ $errors->first('p_label13') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group13" value="{{ count($errors) > 0 ? old('p_group13') : $group13 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group13'))
                                <span class="help-block">{{ $errors->first('p_group13') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute14 = !empty($flexfield->attribute14) ? $flexfield->attribute14 : ''; ?> 
                        <?php $label14     = !empty($flexfield->label14) ? $flexfield->label14 : ''; ?> 
                        <?php $group14     = !empty($flexfield->group14) ? $flexfield->group14 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute14') ? 'has-error' : '' }}">
                            <label for="p_attribute14" class="col-sm-2 control-label">Attribute 14</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute14" name="p_attribute14">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute14') : $attribute14 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute14') : $attribute14 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup14" value="attribute14" {{ $attribute14 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label14" value="{{ count($errors) > 0 ? old('p_label14') : $label14 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label14'))
                                <span class="help-block">{{ $errors->first('p_label14') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group14" value="{{ count($errors) > 0 ? old('p_group14') : $group14 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group14'))
                                <span class="help-block">{{ $errors->first('p_group14') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute15 = !empty($flexfield->attribute15) ? $flexfield->attribute15 : ''; ?> 
                        <?php $label15     = !empty($flexfield->label15) ? $flexfield->label15 : ''; ?> 
                        <?php $group15     = !empty($flexfield->group15) ? $flexfield->group15 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute15') ? 'has-error' : '' }}">
                            <label for="p_attribute15" class="col-sm-2 control-label">Attribute 15</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute15" name="p_attribute15">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute15') : $attribute15 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute15') : $attribute15 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup15" value="attribute15" {{ $attribute15 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label15" value="{{ count($errors) > 0 ? old('p_label15') : $label15 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label15'))
                                <span class="help-block">{{ $errors->first('p_label15') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group15" value="{{ count($errors) > 0 ? old('p_group15') : $group15 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group15'))
                                <span class="help-block">{{ $errors->first('p_group15') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute16 = !empty($flexfield->attribute16) ? $flexfield->attribute16 : ''; ?> 
                        <?php $label16     = !empty($flexfield->label16) ? $flexfield->label16 : ''; ?> 
                        <?php $group16     = !empty($flexfield->group16) ? $flexfield->group16 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute16') ? 'has-error' : '' }}">
                            <label for="p_attribute16" class="col-sm-2 control-label">Attribute 16</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute16" name="p_attribute16">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute16') : $attribute16 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute16') : $attribute16 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup16" value="attribute16" {{ $attribute16 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label16" value="{{ count($errors) > 0 ? old('p_label16') : $label16 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label16'))
                                <span class="help-block">{{ $errors->first('p_label16') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group16" value="{{ count($errors) > 0 ? old('p_group16') : $group16 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group16'))
                                <span class="help-block">{{ $errors->first('p_group16') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute17 = !empty($flexfield->attribute17) ? $flexfield->attribute17 : ''; ?> 
                        <?php $label17     = !empty($flexfield->label17) ? $flexfield->label17 : ''; ?> 
                        <?php $group17     = !empty($flexfield->group17) ? $flexfield->group17 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute17') ? 'has-error' : '' }}">
                            <label for="p_attribute17" class="col-sm-2 control-label">Attribute 17</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute17" name="p_attribute17">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute17') : $attribute17 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute17') : $attribute17 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup17" value="attribute17" {{ $attribute17 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label17" value="{{ count($errors) > 0 ? old('p_label17') : $label17 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label17'))
                                <span class="help-block">{{ $errors->first('p_label17') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group17" value="{{ count($errors) > 0 ? old('p_group17') : $group17 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group17'))
                                <span class="help-block">{{ $errors->first('p_group17') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute18 = !empty($flexfield->attribute18) ? $flexfield->attribute18 : ''; ?> 
                        <?php $label18     = !empty($flexfield->label18) ? $flexfield->label18 : ''; ?> 
                        <?php $group18     = !empty($flexfield->group18) ? $flexfield->group18 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute18') ? 'has-error' : '' }}">
                            <label for="p_attribute18" class="col-sm-2 control-label">Attribute 18</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute18" name="p_attribute18">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute18') : $attribute18 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute18') : $attribute18 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup18" value="attribute18" {{ $attribute18 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label18" value="{{ count($errors) > 0 ? old('p_label18') : $label18 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label18'))
                                <span class="help-block">{{ $errors->first('p_label18') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group18" value="{{ count($errors) > 0 ? old('p_group18') : $group18 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group18'))
                                <span class="help-block">{{ $errors->first('p_group18') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute19 = !empty($flexfield->attribute19) ? $flexfield->attribute19 : ''; ?> 
                        <?php $label19     = !empty($flexfield->label19) ? $flexfield->label19 : ''; ?> 
                        <?php $group19     = !empty($flexfield->group19) ? $flexfield->group19 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute19') ? 'has-error' : '' }}">
                            <label for="p_attribute19" class="col-sm-2 control-label">Attribute 19</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute19" name="p_attribute19">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute19') : $attribute19 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute19') : $attribute19 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup19" value="attribute19" {{ $attribute19 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label19" value="{{ count($errors) > 0 ? old('p_label19') : $label19 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label19'))
                                <span class="help-block">{{ $errors->first('p_label19') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group19" value="{{ count($errors) > 0 ? old('p_group19') : $group19 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group19'))
                                <span class="help-block">{{ $errors->first('p_group19') }}</span>
                                @endif
                            </div>
                        </div>
                        <?php $attribute20 = !empty($flexfield->attribute20) ? $flexfield->attribute20 : ''; ?> 
                        <?php $label20     = !empty($flexfield->label20) ? $flexfield->label20 : ''; ?> 
                        <?php $group20     = !empty($flexfield->group20) ? $flexfield->group20 : ''; ?> 
                        <div class="form-group {{ $errors->has('p_attribute20') ? 'has-error' : '' }}">
                            <label for="p_attribute20" class="col-sm-2 control-label">Attribute 20</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b-30">
                                    <select class="form-control" tabindex="1" id="p_attribute20" name="p_attribute20">
                                        <option value="">Select a Type Attribute</option>
                                        <option value="free" {{ count($errors) > 0 ? old('p_attribute20') : $attribute20 == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="lookup" {{ count($errors) > 0 ? old('p_attribute20') : $attribute20 == 'lookup' ? 'selected' : '' }}>Lookup</option>
                                    </select>
                                    <span class="input-group-btn"> 
                                        <button class="btn btn-info" type="button" id="btn-lookup20" value="attribute20" {{ $attribute20 != 'lookup' ? 'disabled' : '' }}>Add Lookup</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_label20" value="{{ count($errors) > 0 ? old('p_label20') : $label20 }}" maxlength = "100" placeholder="Label"> 
                                @if($errors->has('p_label20'))
                                <span class="help-block">{{ $errors->first('p_label20') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="p_group20" value="{{ count($errors) > 0 ? old('p_group20') : $group20 }}" maxlength = "100" placeholder="Group"> 
                                @if($errors->has('p_group20'))
                                <span class="help-block">{{ $errors->first('p_group20') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" >
                     <div class="form-group m-b-0 pull-right">
                        <div class="col-sm-12 ">
                            <a type="submit" href="{{ url($url) }}" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-undo m-r-5"></i> <span>Cancel</span></a>
                            <button type="submit" class="btn btn-info waves-effect waves-light"> <i class="fa fa-save m-r-5"></i> <span>Save</span></button>
                        </div>
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
        $('#p_attribute1').on('change', function(){
            attributeChange(1);
        });

        $('#btn-lookup1').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(1);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute2').on('change', function(){
            attributeChange(2);
        });

        $('#btn-lookup2').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(2);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute3').on('change', function(){
            attributeChange(3);
        });

        $('#btn-lookup3').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(3);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute4').on('change', function(){
            attributeChange(4);
        });

        $('#btn-lookup4').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(4);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute5').on('change', function(){
            attributeChange(5);
        });

        $('#btn-lookup5').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(5);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute6').on('change', function(){
            attributeChange(6);
        });

        $('#btn-lookup6').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(6);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute7').on('change', function(){
            attributeChange(7);
        });

        $('#btn-lookup7').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(7);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute8').on('change', function(){
            attributeChange(8);
        });

        $('#btn-lookup8').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(8);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute9').on('change', function(){
            attributeChange(9);
        });

        $('#btn-lookup9').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(9);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute10').on('change', function(){
            attributeChange(10);
        });

        $('#btn-lookup10').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(10);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute11').on('change', function(){
            attributeChange(11);
        });

        $('#btn-lookup11').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(11);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute12').on('change', function(){
            attributeChange(12);
        });

        $('#btn-lookup12').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(12);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute13').on('change', function(){
            attributeChange(13);
        });

        $('#btn-lookup13').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(13);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute14').on('change', function(){
            attributeChange(14);
        });

        $('#btn-lookup14').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(14);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute15').on('change', function(){
            attributeChange(15);
        });

        $('#btn-lookup15').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(15);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute16').on('change', function(){
            attributeChange(16);
        });

        $('#btn-lookup16').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(16);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute17').on('change', function(){
            attributeChange(17);
        });

        $('#btn-lookup17').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(17);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute18').on('change', function(){
            attributeChange(18);
        });

        $('#btn-lookup18').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(18);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute19').on('change', function(){
            attributeChange(19);
        });

        $('#btn-lookup19').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(19);
            $('#m_attribute_name').val($(this).val());
        });

        $('#p_attribute20').on('change', function(){
            attributeChange(20);
        });

        $('#btn-lookup20').on('click', function(){
            loadFlexfield($(this).val());
            addLookup(20);
            $('#m_attribute_name').val($(this).val());
        });

        $('#add-flex-value').on('click', function(){
            if ($('#p_flex_value').val() == '') {
                $('#p_flex_value').parent().parent().addClass('has-error');
                $('#p_flex_value').parent().parent().find('span.help-block').html('Value is required');
                return;
            } else {
                $('#p_flex_value').parent().parent().removeClass('has-error');
                $('#p_flex_value').parent().parent().find('span.help-block').html('');
            }
            
            $.ajax({
                url: "{{ url($url.'/post-opr-flexfield') }}", 
                method: 'POST',
                data: {
                    '_token' : '{{ csrf_token() }}', 
                    p_category_id: $('#p_category_id').val(), 
                    p_attribute_name: $('#m_attribute_name').val(),
                    p_flex_value: $('#p_flex_value').val(),
                    p_enabled_flag: 'Y',
                    },
                success: function(result){
                    $('#table-lov-unit tbody').append(
                        '<tr>\
                            <input type="hidden" value="'+ $("#p_flex_value").val() +'">\
                            <td class="td-flexfield" value="'+ $("#p_flex_value").val() +'">' + $("#p_flex_value").val() + '</td>\
                            <td><button type="button" class="btn btn-danger btn-outline btn-circle btn-xs m-r-5 btn-delete-flexfield"><i class="fa fa-remove"></i></button></td>\
                        </tr>'
                    );

                    $('.btn-delete-flexfield').on('click', deleteFlexfield);
                    // createNotification('Flexfield added', 'success');
                    $('#p_flex_value').val('');
            }});
        });

    });
    
    var attributeChange = function(attribute){
        if($('#p_attribute' + attribute).val() == 'lookup' && $('#p_category_id').val() != ''){
            $("#btn-lookup" + attribute).removeAttr("disabled");
        }else{
            $("#btn-lookup" + attribute).attr("disabled","disabled");
        }
    }

    var addLookup = function(attribute){
        $('#m_attribute_name').val('');
        $('#p_flex_value').val('');
        $('#p_flex_value').parent().parent().removeClass('has-error');
        $('#p_flex_value').parent().parent().find('span.help-block').html('');

        $('#table-lov-unit tbody').html('');
        
        $('#modal-title').html('Attribute ' + attribute);

        $('#flexfield-modal').modal({backdrop: 'static', keyboard: false}); 
    }

    var deleteFlexfield = function(){
        var el = $(this);
        $.ajax({
            url: "{{ url($url.'/post-opr-flexfield') }}", 
            method: 'POST',
            data: {
                '_token' : '{{ csrf_token() }}', 
                p_category_id: $('#p_category_id').val(), 
                p_attribute_name: $('#m_attribute_name').val(),
                p_flex_value: $(this).parent().parent().find('input').val(),
                p_enabled_flag: 'N',
                },
            success: function(result){
                if(result.o_status == 1){
                    // createNotification('Flexfield deleted', 'success');
                    el.parent().parent().remove();
                }else{
                    // createNotification('Flexfield not deleted', 'danger');
                }
        }});
    };

    var loadFlexfield = function(attribute){
        $.ajax({
            url: "{{ url($url.'/get-json-flexfield') }}", 
            data: {p_category_id: $('#p_category_id').val(), p_attribute_name: attribute},
            success: function(result){
                $.each(result, function(i, item) {
                    $('#table-lov-unit tbody').append(
                        '<tr>\
                            <input type="hidden" value="'+ item.flex_value +'">\
                            <td class="td-flexfield" value="'+ item.flex_value +'">' + item.flex_value + '</td>\
                            <td><button type="button" class="btn btn-danger btn-outline btn-circle btn-xs m-r-5 btn-delete-flexfield"><i class="fa fa-remove"></i></button></td>\
                        </tr>'
                    );
                });
                $('.btn-delete-flexfield').on('click', deleteFlexfield);
        }});
    };

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