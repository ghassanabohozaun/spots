<h4>{!! __('flights.prices') !!}</h4>
<hr>


<div class="table_responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    {!! __('flights.price_text_ar') !!}
                </th>
                <th>
                    {!! __('flights.price_text_en') !!}
                </th>
                <th>
                    {!! __('flights.price') !!}
                </th>
                <th class="text-center">
                    {!! __('flights.main_option') !!}
                </th>
                <th class="text-center">
                    <a href="#" wire:click.prevent="addNewPrice" class="text-white badge badge-info">
                        <li class="la la-plus"></li>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pricesItems as $index => $row)
                <tr wire:key="row-{{ $index }}">
                    <td class="col-lg-5 col-md-5 col-sm-12">
                        <input type="text" wire:model="pricesItems.{!! $index !!}.price_text_ar"
                            class="form-control" placeholder="{!! __('flights.enter_price_text_ar') !!}"
                            @error('pricesItems.' . $index . '.price_text_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                        @error('pricesItems.' . $index . '.price_text_ar')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-5 col-md-5 col-sm-12">
                        <input type="text" wire:model="pricesItems.{!! $index !!}.price_text_en"
                            class="form-control" placeholder="{!! __('flights.enter_price_text_en') !!}"
                            @error('pricesItems.' . $index . '.price_text_en')  style="border-color: rgb(246, 78, 96)"  @enderror />

                        @error('pricesItems.' . $index . '.price_text_en')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-4 col-md-4 col-sm-12">
                        <input type="number" wire:model="pricesItems.{!! $index !!}.price"
                            class="form-control" placeholder="{!! __('flights.price') !!}"
                            @error('pricesItems.' . $index . '.price')  style="border-color: rgb(246, 78, 96)"  @enderror>

                        @error('pricesItems.' . $index . '.price')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>



                    <td class="col-lg-2 col-md-2 col-sm-12  text-center">
                        <input type="checkbox" wire:model="pricesItems.{!! $index !!}.main_option"
                            {!! $row['main_option'] == true ? 'checked' : '' !!} wire:change="mainOptionChange({!! $index !!})">
                        {{-- {!! $row['main_option'] !!} --}}

                        @error('pricesItems.' . $index . '.main_option')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-2">
                        <a href="#" wire:click.prevent ="removePrice({{ $index }})"
                            class="text-white  badge badge-danger">
                            <li class="la la-trash"></li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>

{{--
@foreach ($pricesItems as $index => $row)
    <div class="row mt-1" wire:key="row-{{ $index }}">

        <!-- begin: input  price_text_ar-->
        <div class="col-md-4">
            <div class="form-group">
                <label class="sr-only" for="price_text_ar">{!! __('flights.price_text_ar') !!} </label>
                <input type="text" wire:model="pricesItems.{!! $index !!}.price_text_ar" class="form-control"
                    placeholder="{!! __('flights.enter_price_text_ar') !!}"
                    @error('pricesItems.' . $index . '.price_text_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('pricesItems.' . $index . '.price_text_ar')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  price_text_ar-->

        <!-- begin: input  price_text_en-->
        <div class="col-md-4">
            <div class="form-group">
                <label class="sr-only" for="price_text_en">{!! __('flights.price_text_en') !!} </label>
                <input type="text" wire:model="pricesItems.{!! $index !!}.price_text_en"
                    class="form-control" placeholder="{!! __('flights.enter_price_text_en') !!}"
                    @error('pricesItems.' . $index . '.price_text_en')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('pricesItems.' . $index . '.price_text_en')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  price_text_en-->


        <!-- begin: input  price-->
        <div class="col-md-2">
            <div class="form-group">
                <label class="sr-only" for="price">{!! __('flights.price') !!} </label>
                <input type="number" wire:model="pricesItems.{!! $index !!}.price" class="form-control"
                    placeholder="{!! __('flights.price') !!}"
                    @error('pricesItems.' . $index . '.price')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('pricesItems.' . $index . '.price')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  price-->


        <!-- begin: input  main_option-->
        <div class="col-md-1" style="margin-top: 10px">
            <div class="form-group">
                <label class=" " for="price">{!! __('flights.main_option') !!} </label>
                <input type="checkbox" wire:model="pricesItems.{!! $index !!}.main_option">

                @error('pricesItems.' . $index . '.main_option')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  main_option-->



        <div class="col-md-1">
            <label class="sr-only" for=""></label>
            <button type="button" wire:click.prevent ="removePrice({{ $index }})"
                class="btn btn-danger btn-glow px-2">
                <li class="la la-trash"></li>
            </button>
        </div>
    </div>
@endforeach

<hr style="background-color: rgb(119, 116, 116)">
<button type="button" wire:click.prevent="addNewPrice" class="btn btn-success btn-glow px-2">
    <li class="la la-plus"></li>
</button> --}}



<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!}">
    <div class="col-md-12">
        <button type="button" wire:click ="backStep(2)" class="btn btn-info btn-glow">
            {!! __('flights.back') !!}
        </button>
        <button type="button" wire:click="thirdStepSubmit" class="btn btn-primary btn-glow">
            {!! __('flights.next') !!}
            <span wire:loading wire:target="thirdStepSubmit">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
