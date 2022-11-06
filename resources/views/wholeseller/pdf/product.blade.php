@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All products')</h3>
    <table class="table-listing table table-bordered">
        <thead>
            <tr>
                <th>@lang('S.No')</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Created') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>{{ $product->quantity }} </td>
                    <td>{{ $product->price }} </td>
                    <td>
                        @if ($product->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ $product->category->name }} </td>
                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
