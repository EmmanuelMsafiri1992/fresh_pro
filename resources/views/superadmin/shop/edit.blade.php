@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-4">
<div class="row align-items-center">
<div class="col-sm-6">
<h1 class="m-0 text-dark">{{ __('Edit Shop') }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item">
<a href="{{ route('superadmin.dashboard') }}">{{ __('Dashboard') }}</a>
</li>
<li class="breadcrumb-item">
<a href="{{ route('superadmins.shops.index') }}">{{ __('Shops') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('Edit Shop') }}</li>
</ol>
</div>
</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="card">
<div class="card-header">
<h3 class="card-title">{{ __('Edit Shop') }}: {{ $shop->name }}</h3>
<div class="card-tools">
<a href="{{ route('superadmins.shops.index') }}" class="btn btn-block btn-primary">
<i class="fas fa-long-arrow-alt-left"></i> {{ __('Go Back') }}
</a>
</div>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
<form class="form-horizontal" action="{{ route('superadmins.shops.update', $shop->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="card-body">
<div class="row">
<div class="col-md-6 form-group">
<label for="name" class="col-form-label">{{ __('Shop Name') }}<span class="required-field">*</span></label>
<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('shop Name') }}" value="{{ $shop->name }}">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="col-md-6 form-group">
<label for="shopkeeper_id" class="col-form-label">{{ __('Select a Shopkeeper') }}</label>
<select class="form-control @error('shopkeeper_id') is-invalid @enderror form-select" id="shopkeeper_id" name="shopkeeper_id">
<option value="0">Select A Shopkeeper</option>
@foreach($shopkeepers as $shopkeeper)
<option value="{{ $shopkeeper->id }}" {{ $shop->shopkeeper->id==$shop->shopkeeper_id ? 'selected' : '' }}>
{{ $shopkeeper->name }}
</option>
@endforeach
</select>
@error('shopkeeper_id')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

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
<option value="1" {{ $shop->isActive() ? 'selected' : '' }}>{{ __('Active') }}</option>
<option value="0" {{ $shop->isActive() ? '' : 'selected' }}>{{ __('Inactive') }}</option>
</select>
@error('status')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="row">
<div class="col-sm-12">
<button type="submit" class="btn btn-primary w-100"><i class="fas fa-edit"></i> {{ __('Save Changes') }}</button>
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

