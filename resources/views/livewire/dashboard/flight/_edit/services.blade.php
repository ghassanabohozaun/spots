<h4>
    {!! __('flights.services') !!}</h4>
<hr>

<div class="table_responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    {!! __('flights.service_name_ar') !!}
                </th>
                <th>
                    {!! __('flights.service_name_en') !!}
                </th>
                <th>
                    <a href="#" wire:click.prevent="addNewService" class="text-white badge badge-info">
                        <li class="la la-plus"></li>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicesItems as $index => $row)
                <tr wire:key="row-{{ $index }}">

                    <td class="col-lg-5 col-md-5 col-sm-6">
                        <input type="text" wire:model="servicesItems.{!! $index !!}.service_name_ar"
                            class="form-control" placeholder="{!! __('flights.enter_service_name_ar') !!}"
                            @error('servicesItems.' . $index . '.service_name_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                        @error('servicesItems.' . $index . '.service_name_ar')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-5 col-md-5 col-sm-6">
                        <input type="text" wire:model="servicesItems.{!! $index !!}.service_name_en"
                            class="form-control" placeholder="{!! __('flights.enter_service_name_en') !!}"
                            @error('servicesItems.' . $index . '.service_name_en')  style="border-color: rgb(246, 78, 96)"  @enderror />

                        @error('servicesItems.' . $index . '.service_name_en')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>
                    <td class="col-lg-1 col-md-1 col-sm-1">
                        <a href="#" wire:click.prevent ="removeService({{ $index }})"
                            class="text-white  badge badge-danger">
                            <li class="la la-trash"></li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>

{{-- @foreach ($servicesItems as $index => $row)
    <div class="row mt-1" wire:key="row-{{ $index }}">

        <!-- begin: input  service_name_en-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="sr-only" for="service_name_ar">{!! __('flights.service_name_ar') !!} </label>
                <input type="text" wire:model="servicesItems.{!! $index !!}.service_name_ar"
                    class="form-control" placeholder="{!! __('flights.enter_service_name_ar') !!}"
                    @error('servicesItems.' . $index . '.service_name_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('servicesItems.' . $index . '.service_name_ar')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  service_name_en-->

        <!-- begin: input  service_name_en-->
        <div class="col-md-5">
            <div class="form-group">
                <label class="sr-only" for="service_name_en">{!! __('flights.service_name_en') !!} </label>
                <input type="text" wire:model="servicesItems.{!! $index !!}.service_name_en"
                    class="form-control" placeholder="{!! __('flights.enter_service_name_en') !!}"
                    @error('servicesItems.' . $index . '.service_name_en')  style="border-color: rgb(246, 78, 96)"  @enderror />

                @error('servicesItems.' . $index . '.service_name_en')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  service_name_en-->

        <div class="col-md-1">
            <label class="sr-only" for=""></label>
            <button type="button" wire:click.prevent ="removeService({{ $index }})"
                class="btn btn-danger btn-glow px-2">
                <li class="la la-trash"></li>
            </button>
        </div>
    </div>
@endforeach --}}
{{--
<hr style="background-color: rgb(119, 116, 116)">
<button type="button" wire:click.prevent="addNewService" class="btn btn-success btn-glow px-2">
    <li class="la la-plus"></li>
</button> --}}



<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!}">
    <div class="col-md-12 ">
        <button type="button" wire:click ="backStep(1)" class="btn btn-info btn-glow">
            {!! __('flights.back') !!}
        </button>
        <button type="button" wire:click="secondStepSubmit" class="btn btn-primary btn-glow">
            {!! __('flights.next') !!}
            <span wire:loading wire:target="secondStepSubmit">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
