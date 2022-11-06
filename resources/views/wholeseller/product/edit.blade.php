@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-4">
<div class="row align-items-center">
<div class="col-sm-6">
<h1 class="m-0 text-dark">{{ __('Create Product') }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item">
<a href="{{ route('superadmin.dashboard') }}">{{ __('Dashboard') }}</a>
</li>
<li class="breadcrumb-item">
<a href="{{ route('superadmins.products.index') }}">{{ __('Products') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('Create Product') }}</li>
</ol>
</div>
</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="card">
<div class="card-header">
<h3 class="card-title">{{ __('Update a Product') }}</h3>
<div class="card-tools">
<a href="{{ route('superadmins.products.index') }}" class="btn btn-block btn-primary">
<i class="fas fa-long-arrow-alt-left"></i> {{ __('Go Back') }}
</a>
</div>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
<form class="form-horizontal" action="{{ route('superadmins.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
@method('PUT')
@csrf
<div class="card-body">
<div class="row">
<div class="form-group col-md-6">
<label for="name">{{ __('Product Name') }}<span class="required-field">*</span></label>
<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('Product Name') }}" value="{{ $product->name }}">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="form-group col-md-6">
<label for="price">{{ __('Product Price') }}<span class="required-field">*</span></label>
<input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="{{ __('Product Price') }}" value="{{ $product->price }}">
@error('price')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="row">
<div class="form-group col-md-12">
<label for="description" class="col-form-label">{{ __('Product Description') }}</label>
<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="{{ __('Product Description') }}">{{ $product->description }}</textarea>
@error('description')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="row">
<div class="form-group col-md-6">
<label for="status" class="col-form-label">{{ __('Status') }}</label>
<select class="form-control @error('status') is-invalid @enderror form-select" id="status" name="status">
<option value="2">{{ __('Select A Status') }}</option>
<option value="1" {{$product->status==1?'selected':''}} >{{ __('Active') }}</option>
<option value="0" {{$product->status==0?'selected':''}}>{{ __('Inactive') }}</option>
</select>
@error('status')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

</div>
<div class="form-group col-md-6">
<label for="quantity" class="col-form-label">{{ __('Quantity') }}</label>
<input type="number" class="form-control @error('status') is-invalid @enderror" name="quantity" id="quantity" value="{{$product->quantity}}"/>
@error('quantity')
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
<div class="form-group col-md-6">
<label for="category_id" class="col-form-label">{{ __('Category') }}</label>
<select class="form-control @error('category_id') is-invalid @enderror form-select" id="category_id" name="category_id">
<option value="0">{{ __('Select A Category') }}</option>
@foreach($categories as $category)
<option value="{{$category->id}}" {{$product->category_id==$category->id ? 'selected':''}} >{{$category->name}}</option>
@endforeach
</select>
@error('category_id')
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
<i class="fas fa-save"></i>
<strong>
{{ __('Update Product') }}
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
</div></div>
<!-- /.card-body -->
</form>
</div>
<!-- /.card-body -->
</div>
</div>
<!-- /.content -->
@endsection


