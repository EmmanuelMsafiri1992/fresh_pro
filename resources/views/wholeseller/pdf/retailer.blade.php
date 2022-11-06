@extends('layouts.pdf')
<style>
table tr th, table tr td
{
text-align:center;
}
</style>

@section('content-area')
    <h3>@lang('All Retailers')</h3>
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
            @foreach ($retailers as $key => $retailer)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $retailer->name }}
                    </td>
                    <td>{{ $retailer->email }} </td>
                    <td>
                        @if ($retailer->isretailer())
                            <span class="badge badge-success"><i class="fas fa-retailer-secret"></i>
                                {{ __('retailer retailer') }}</span>
                        @else
                            <span class="badge badge-primary"><i class="fas fa-retailer-tie"></i>
                                {{ __('Genereal retailer') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($retailer->isActive())
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($retailer->created_at)->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
