@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All admins')</h3>
    <table class="table-listing table table-bordered">
        <thead>
            <tr>
                <th>@lang('S.No')</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Created') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $key => $admin)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $admin->name }}
                    </td>
                    <td>{{ $admin->email }} </td>
                    <td>
                        @if ($admin->isAdmin())
                            <span class="badge badge-success"><i class="fas fa-admin-secret"></i>
                                {{ __('Admin admin') }}</span>
                        @else
                            <span class="badge badge-primary"><i class="fas fa-admin-tie"></i>
                                {{ __('Genereal admin') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($admin->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($admin->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
