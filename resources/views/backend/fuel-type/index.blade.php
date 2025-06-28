@extends('backend.layout.master')
@section('title')
    {{ __('Todays Fuel Price') }}
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Todays Fuel Price') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('fuel-type-price.create') }}" class="ui button small blue"><i class="bi bi-plus-circle-fill icon"></i>{{ __('Add new') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="ui buttons tiny">
                                <button class="ui button" id="printButton"><i class="bi bi-printer icon"></i>{{ __('Print') }}</button>
                                <button class="ui button"><i class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</button>
                                <button class="ui button"><i class="bi bi-file-earmark-spreadsheet icon"></i>{{ __('Excel') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="myresponsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-start">{{__('S.R')}}</th>
                                        <th scope="col">{{__('Fuel Type')}}</th>
                                        <th scope="col" class="text-start">{{__('Fuel Price')}}</th>
                                        <th scope="col" class="text-start">{{__('Editor Name')}}</th>
                                        <th scope="col" class="text-start" colspan="2">{{__('Edit Date')}}</th>
                                        {{-- <th scope="col" class="text-end">{{__('Actions')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($fuels as $fuel)
                                        <tr>
                                            <th scope="row" class="text-center">{{$i}}</th>
                                            <td class="text">
                                                <p>{{$fuel->fuel_type_kh}}</p>
                                                <p class="text-capitalize">{{$fuel->fuel_type_en}}</p>
                                            </td>
                                            <td class="text-start"><i class="bi bi-currency-dollar icon text-muted"></i>{{$fuel->today_price}}</td>
                                            <td class="text">
                                                <p>{{$fuel->user->fullname_kh}}</p>
                                                <p class="text-capitalize">{{$fuel->user->fullname_en}}</p>
                                            </td>
                                            <td>{{Carbon\Carbon::parse($fuel->updated_at)->format('d m Y - h:i:s A')}}</td>
                                            <td class="text-end">
                                                <div class="ui mini label text-start {{ $fuel->visibility == 1 ? 'green' : 'red' }}">{{ $fuel->visibility == 1 ? __('Show') : __("Hidden")}}</div>
                                                <div class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $i }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <a href="{{ route('fuel-type-price.edit', $fuel->id) }}" class="item"><i class="bi bi-pencil-square icon"></i>{{__("Edit Fuel")}}</a>
                                                        <div class="item"><i class="bi bi-eye-slash-fill icon"></i>{{__("Hide Fuel")}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.direct-chat -->
        </div>
    </div>
    <!-- /.row (main row) -->
@endsection

@section('js')
    @if ($fuels != null)
        <script>
            @php
                $i = 1;
            @endphp
            @foreach ($fuels as $index => $student)
                $(".ui.dropdown{{ $i++ }}").dropdown();
            @endforeach
        </script>
    @endif

@endsection
