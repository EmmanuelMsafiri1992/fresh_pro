@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All customers')</h3>
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
            @foreach ($customers as $key => $customer)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $customer->name }}
                    </td>
                    <td>{{ $customer->email }} </td>
                    <td>
                        @if ($customer->iscustomer())
                            <span class="badge badge-success"><i class="fas fa-customer-secret"></i>
                                {{ __('customer customer') }}</span>
                        @else
                            <span class="badge badge-primary"><i class="fas fa-customer-tie"></i>
                                {{ __('Genereal customer') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($customer->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
