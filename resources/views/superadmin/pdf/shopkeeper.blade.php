@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All shopkeepers')</h3>
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
            @foreach ($shopkeepers as $key => $shopkeeper)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $shopkeeper->name }}
                    </td>
                    <td>{{ $shopkeeper->email }} </td>
                    <td>
                        @if ($shopkeeper->isshopkeeper())
                            <span class="badge badge-success"><i class="fas fa-shopkeeper-secret"></i>
                                {{ __('shopkeeper shopkeeper') }}</span>
                        @else
                            <span class="badge badge-primary"><i class="fas fa-shopkeeper-tie"></i>
                                {{ __('Genereal shopkeeper') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($shopkeeper->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($shopkeeper->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
