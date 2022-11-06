@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-4">
<div class="row align-items-center">
<div class="col-sm-6">
<h1 class="m-0 text-dark">{{ __('Edit Admin') }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item">
<a href="{{ route('superadmin.dashboard') }}">{{ __('Dashboard') }}</a>
</li>
<li class="breadcrumb-item">
<a href="{{ route('superadmins.admins.index') }}">{{ __('Admin') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('Edit Admin') }}</li>
</ol>
</div>
</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="card">
<div class="card-header">
<h3 class="card-title">{{ __('Edit Admin') }}: {{ $admin->name }}</h3>
<div class="card-tools">
<a href="{{ route('superadmins.admins.index') }}" class="btn btn-block btn-primary">
<i class="fas fa-long-arrow-alt-left"></i> {{ __('Go Back') }}
</a>
</div>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
<form class="form-horizontal" action="{{ route('superadmins.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="card-body">
<div class="row">
<div class="col-md-6 form-group">
<label for="name" class="col-form-label">{{ __('Admin Name') }}<span class="required-field">*</span></label>
<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('admin Name') }}" value="{{ $admin->name }}" required>
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="col-md-6 form-group">
<label for="email" class="col-form-label">{{ __('Email Address') }}<span class="required-field">*</span></label>
<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('Email Address') }}" value="{{ $admin->email }}" readonly>
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="row">
<div class="col-md-6 form-group">
<label for="password" class="col-form-label">{{ __('Password') }}<span class="required-field">*</span></label>
<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('Password') }}"   autocomplete="new-password">
<small id="passwordHelp" class="form-text text-muted">{{ __('Leave the box empty if you don\'t want to change the password.') }}</small>
@error('password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="col-md-6 form-group">
<label for="password-confirm" class="col-form-label">{{ __('Password Confirm') }}<span class="required-field">*</span></label>
<input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="{{ __('Password Confirm') }}"   autocomplete="new-password">
</div>
</div>

<div class="row">
<div class="col-md-6 form-group">
<label for="profilePic" class="col-form-label">{{ __('Profile Picture') }}</label>
<div class="custom-file">
<input type="file" class="custom-file-input @error('profilePic') is-invalid @enderror" id="attached-image" name="profilePic">
<label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
<small id="profilePicHelp" class="form-text text-muted">{{ __('Leave the box empty if you don\'t want to change the picture.') }}</small>
@error('profilePic')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="image-preview">
<img src="" id="attached-preview-img" class="mt-3"/>
</div>
</div>
<div class="col-md-6 form-group">
<label for="status" class="col-form-label">{{ __('Status') }}</label>
<select class="form-control @error('status') is-invalid @enderror form-select" id="status" name="status">
<option value="2">Select A Status</option>
<option value="1" {{ $admin->status==1 ? 'selected' : '' }}>{{ __('Active') }}</option>
<option value="0" {{ $admin->status==0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
</select>
@error('status')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="row">
<div class="col-sm-6">
<button type="submit" class="btn btn-primary text-light w-100">
&nbsp;    
<i class="fas fa-edit"></i>
<strong>
{{ __('Update Admin') }}
</strong>
</button>
</div>
<div class="col-sm-6">
<a href="{{route('superadmin.dashboard')}}" type="submit" class="btn btn-info text-light w-100">
&nbsp;    
<i class="fas fa-home"></i>
<strong>
{{ __('Homepage') }}
</strong>
</a>
</div>
</div>

</div>
</div>
<!-- /.card-body -->
</form>
</div>
<!-- /.card-body -->
</div>
</div>
<!-- /.content -->
@endsection

