@extends('layouts.admin')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-4">
<div class="row align-items-center">
<div class="col-sm-6">
<h1 class="m-0 text-dark">{{ __('Customers') }}</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item">
<a href="{{ route('superadmin.dashboard') }}">{{ __('Dashboard') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('Customers') }}</li>
</ol>
</div>
</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 col-md-5 col-6 mb-2">
<form action="{{ route('superadmins.customers.index') }}" method="GET" role="search">
<div class="input-group">
<input type="text" name="term"
placeholder="{{ __('Type name or email ...') }}" class="form-control"
autocomplete="off" value="{{ request('term') ? request('term') : '' }}"
required>
<span class="input-group-append">
<button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
</span>
</div>
</form>
</div>
<div class="col-lg-9 col-md-7 col-6">
<div class="card-tools text-md-right">
<a class="btn btn-secondary" href="{{ route('superadmins.customers.pdf') }}">
<i class="fas fa-download"></i> @lang('Export')
</a>
<a href="{{ route('superadmins.customers.create') }}" class="btn btn-primary">
{{ __('Add Customer') }} <i class="fas fa-plus-circle"></i>
</a>
</div>
</div>
</div>

<div class="p-0 table-responsive table-custom my-3">
<table class="table">
<thead>
<tr>
<th>@lang('S.No')</th>
<th>{{ __('Picture') }}</th>
<th>{{ __('Name') }}</th>
<th>{{ __('Email') }}</th>
<th>{{ __('Status') }}</th>
<th>{{ __('Created') }}</th>
<th class="text-right">{{ __('Action') }}</th>
</tr>
</thead>
<tbody>

@if ($customers->total() > 0)
@foreach ($customers as $key => $customer)
<tr>
<td>{{ ++$key }}</td>
<td>
@if (!empty($customer->profile_picture))
<img src="{{ $customer->profilePic() }}" class="table-image-preview">
@else
<div class="no-preview"></div>
@endif
</td>
<td>
<a href="{{ route('superadmins.customers.edit', $customer->id) }}"> {{ $customer->name }}</a>
</td>
<td>{{ $customer->email }} </td>
<td>
@if ($customer->isActive())
<span class="badge badge-success">{{ __('Active') }}</span>
@else
<span class="badge badge-warning">{{ __('Inactive') }}</span>
@endif
</td>
<td>{{ \Carbon\Carbon::parse($customer->created_at)->format('d-M-Y') }}</td>
<td class="text-right">
<div class="btn-group">
<button type="button"
class="btn btn-secondary dropdown-toggle action-dropdown-toggle"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-ellipsis-v"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
@if ($customer->isActive())
<a href="{{ route('superadmins.customers.status', $customer->id) }}"
class="dropdown-item"><i class="fas fa-window-close"></i>
{{ __('Inactive') }}</a>
@else
<a href="{{ route('superadmins.customers.status', $customer->id) }}"
class="dropdown-item"><i class="fas fa-check-square"></i>
{{ __('Active') }}</a>
@endif
<a href="{{ route('superadmins.customers.edit', $customer->id) }}"
class="dropdown-item"><i class="fas fa-edit"></i>
{{ __('Edit') }}</a>

@if(Auth::guard('superadmin')->check()) <a href="{{ route('superadmins.customers.delete', $customer->id) }}"
class="dropdown-item delete-btn"
data-msg="{{ __('Are you sure you want to delete this customer?') }}"><i
class="fas fa-trash"></i> {{ __('Delete') }}</a>
@endif
</div>
</div>
</td>
</tr>
@endforeach
@else
<tr>
<td colspan="10">
<div class="data_empty">
<img src="{{ asset('img/result-not-found.svg') }}" alt="" title="">
<p>{{ __('Sorry, no customer found in the database. Create your very first customer.') }}</p>
<a href="{{ route('customers.create') }}" class="btn btn-primary">
{{ __('Add customer') }} <i class="fas fa-plus-circle"></i>
</a>
</div>
</td>
</tr>
@endif
</tbody>
</table>
</div>

<!-- pagination start -->
{{ $customers->links() }}
<!-- pagination end -->
</div>
</div>
@endsection
@section('extra-script')
@if($message=Session::get('customer-saved'))
<script>
Swal.fire({
  title: 'Saved!',
  text: '{{ $message }}',
  icon: 'success',
  iconColor:'green',
  showCloseButton: true,
  timer:3000,
});
</script>
@endif
@if($message=Session::get('customer-updated'))
<script>
Swal.fire({
  title: 'Updated!',
  text: '{{ $message }}',
  icon: 'success',
  iconColor:'orange',
  showCloseButton: true,
  timer:3000,
});
</script>
@endif
@if($message=Session::get('customer-deleted'))
<script>
Swal.fire({
  title: 'Deleted!',
  text: '{{ $message }}',
  icon: 'success',
  iconColor:'red',
  showCloseButton: true,
  timer:3000,
});
</script>
@endif
@if($message=Session::get('customer-status-updated'))
<script>
Swal.fire({
  title: 'Status Changed!',
  text: '{{ $message }}',
  icon: 'info',
  iconColor:'green',
  showCloseButton: true,
  timer:3000,
});
</script>
@endif
@endsection
