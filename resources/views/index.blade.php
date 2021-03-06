@extends(config('laravel-xero-payroll-au.app_layout'))

@section('content')
    <div class="max-w-7xl mx-autos sm:px-6 lg:px-8">
        <div class="font-semibold text-xl text-gray-800 leading-tight">@lang('xero-payroll-au-translations::xero-payroll-au.heading')</div>

        <div>

            <a href="{{ route('xero_payroll.sync') }}"
               class="px-4 py-2 rounded-md text-sm font-medium border-0 focus:outline-none focus:ring transition text-blue-600 bg-blue-50 hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300">@lang('xero-payroll-au-translations::xero-payroll-au.buttons.sync')
            </a>

            <br/>

            <form action="{{ route('xero_payroll.update') }}" method="POST">
                @csrf
                <table class="table-auto w-full border-collapse">
                    <tbody>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_default_payroll_calendar')->pluck('name')->first() }}
                        </td>
                        <td>
                            <select name="xero_default_payroll_calendar" id="xero_default_payroll_calendar">
                                <option>@lang('xero-payroll-au-translations::xero-payroll-au.placeholder.default_select')</option>
                                @foreach($configurations->where('key', 'xero_payroll_calendars')->pluck('value')->flatten(1)->toArray() as $option)
                                    <option value="{{ data_get($option, 'PayrollCalendarID') }}" {{ $configurations->where('key', 'xero_default_payroll_calendar')->pluck('value')->first() == data_get($option, 'PayrollCalendarID') ? ' selected' : '' }}>{{ data_get($option, 'Name') }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_default_ordinary_earnings_rate_id')->pluck('name')->first() }}
                        </td>
                        <td>
                            <select name="xero_default_ordinary_earnings_rate_id"
                                    id="xero_default_ordinary_earnings_rate_id">
                                <option>@lang('xero-payroll-au-translations::xero-payroll-au.placeholder.default_select')</option>
                                @foreach($configurations->where('key', 'xero_earnings_rates')->pluck('value')->flatten(1)->toArray() as $option)
                                    <option value="{{ data_get($option, 'EarningsRateID') }}" {{ $configurations->where('key', 'xero_default_ordinary_earnings_rate_id')->pluck('value')->first() == data_get($option, 'EarningsRateID') ? ' selected' : '' }}>{{ data_get($option, 'Name') }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_default_time_and_a_half')->pluck('name')->first() }}
                        </td>
                        <td>
                            <select name="xero_default_time_and_a_half" id="xero_default_time_and_a_half">
                                <option>@lang('xero-payroll-au-translations::xero-payroll-au.placeholder.default_select')</option>
                                @foreach($configurations->where('key', 'xero_earnings_rates')->pluck('value')->flatten(1)->toArray() as $option)
                                    <option value="{{ data_get($option, 'EarningsRateID') }}" {{ $configurations->where('key', 'xero_default_time_and_a_half')->pluck('value')->first() == data_get($option, 'EarningsRateID') ? ' selected' : '' }}>{{ data_get($option, 'Name') }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_default_double_time')->pluck('name')->first() }}
                        </td>
                        <td>
                            <select name="xero_default_double_time" id="xero_default_double_time">
                                <option>@lang('xero-payroll-au-translations::xero-payroll-au.placeholder.default_select')</option>
                                @foreach($configurations->where('key', 'xero_earnings_rates')->pluck('value')->flatten(1)->toArray() as $option)
                                    <option value="{{ data_get($option, 'EarningsRateID') }}" {{ $configurations->where('key', 'xero_default_double_time')->pluck('value')->first() == data_get($option, 'EarningsRateID') ? ' selected' : '' }}>{{ data_get($option, 'Name') }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_payroll_calendars')->pluck('name')->first() }}
                        </td>
                        <td>

                            <ul>
                                @foreach($configurations->where('key', 'xero_payroll_calendars')->pluck('value')->flatten(1)->toArray() as $item)
                                    <li>{{ data_get($item, 'Name') }}</li>
                                @endforeach
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_earnings_rates')->pluck('name')->first() }}
                        </td>
                        <td>
                            <ul class="list-none">
                                @foreach($configurations->where('key', 'xero_earnings_rates')->pluck('value')->flatten(1)->toArray() as $item)
                                    <li>{{ data_get($item, 'Name') }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                            {{ $configurations->where('key', 'xero_leave_types')->pluck('name')->first() }}
                        </td>
                        <td>
                            <ul>
                                @foreach($configurations->where('key', 'xero_leave_types')->pluck('value')->flatten(1)->toArray() as $item)
                                    <li>{{ data_get($item, 'Name') }}</li>
                                @endforeach
                            </ul>

                        </td>
                    </tr>

                    </tbody>
                </table>

                <button type="submit" value="save"
                        class="px-4 py-2 rounded-md text-sm font-medium border-0 focus:outline-none focus:ring transition text-blue-600 bg-blue-50 hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300">@lang('xero-payroll-au-translations::xero-payroll-au.buttons.submit')</button>
            </form>

        </div>
    </div>
@endsection