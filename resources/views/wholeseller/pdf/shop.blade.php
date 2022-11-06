@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All shops')</h3>
    <table class="table-listing table table-bordered">
        <thead>
            <tr>
                <th>@lang('S.No')</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Shopkeeper') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Created') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shops as $key => $shop)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $shop->name }}
                    </td>
                    <td>{{ $shop->shopkeeper->name }} </td>
                    <td>
                        @if ($shop->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($shop->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
