@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All Wholesellers')</h3>
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
            @foreach ($wholesellers as $key => $wholeseller)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $wholeseller->name }}
                    </td>
                    <td>{{ $wholeseller->email }} </td>
                    <td>
                        @if ($wholeseller->iswholeseller())
                            <span class="badge badge-success"><i class="fas fa-wholeseller-secret"></i>
                                {{ __('wholeseller wholeseller') }}</span>
                        @else
                            <span class="badge badge-primary"><i class="fas fa-wholeseller-tie"></i>
                                {{ __('Genereal wholeseller') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($wholeseller->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($wholeseller->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
