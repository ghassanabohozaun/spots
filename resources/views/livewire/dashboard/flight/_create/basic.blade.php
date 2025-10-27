<h4>{!! __('flights.basic') !!}</h4>
<hr>

<!-- begin: name-->
<div class="row mt-1">
    <!-- begin: input -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="name_ar">{!! __('flights.name_ar') !!}</label>
            <input type="text" wire:model.live="name_ar" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_name_ar') !!}"
                @error('name_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('name_ar')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->


    <!-- begin: input -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="name_en">{!! __('flights.name_en') !!}</label>
            <input type="text" wire:model.live="name_en" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_name_en') !!}"
                @error('name_en')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('name_en')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

</div>
<!-- end: name -->

<!-- begin: details-->
<div class="row mt-1">
    <!-- begin: input -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="details_ar">{!! __('flights.details_ar') !!}</label>
            <textarea type="text" wire:model.live="details_ar" class="form-control" autocomplete="off" rows="5"
                placeholder="{!! __('flights.enter_details_ar') !!}" @error('details_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>
            </textarea>
            @error('details_ar')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->


    <!-- begin: input -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="details_en">{!! __('flights.details_en') !!}</label>
            <textarea type="text" wire:model.live="details_en" class="form-control" autocomplete="off" rows="5"
                placeholder="{!! __('flights.enter_details_en') !!}" @error('details_en')  style="border-color: rgb(246, 78, 96)"  @enderror></textarea>
            @error('details_en')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

</div>
<!-- end: details -->


<!-- begin: days_num-->
<div class="row mt-1">
    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="days_num">{!! __('flights.days_num') !!}</label>
            <input type="number" wire:model.live="days_num" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_days_num') !!}"
                @error('days_num')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('days_num')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->


    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="nights_num">{!! __('flights.nights_num') !!}</label>
            <input type="number" wire:model.live="nights_num" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_nights_num') !!}"
                @error('nights_num')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('nights_num')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="offer_duration_to">{!! __('flights.offer_duration_from') !!}</label>
            <input type="date" wire:model.live="offer_duration_from" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_offer_duration_from') !!}"
                @error('offer_duration_from')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('offer_duration_from')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="offer_duration_to">{!! __('flights.offer_duration_to') !!}</label>
            <input type="date" wire:model.live="offer_duration_to" class="form-control" autocomplete="off"
                placeholder="{!! __('flights.enter_offer_duration_to') !!}"
                @error('offer_duration_to')  style="border-color: rgb(246, 78, 96)"  @enderror>
            @error('offer_duration_to')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

</div>
<!-- end: days_num -->


<!-- begin: country_id , city_id , category_id-->
<div class="row">


    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="country_id">{!! __('flights.country_id') !!}</label>
            <select type="text" wire:model="country_id" wire:change="changeCountry($event.target.value)"
                id="country_id" name="country_id" class="form-control">
                <option value="" selected='selected'>
                    {!! __('flights.select') !!} {!! __('flights.country_id') !!}
                </option>
                @foreach ($countries as $key => $country)
                    <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                @endforeach
            </select>
            @error('country_id')
                <span class="text text-danger">
                    <strong class="strong-weight">{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="city_id">{!! __('flights.city_id') !!}</label>
            <select type="text" wire:model="city_id" id="city_id" name="city_id" {!! $disabledGovernorate == 1 ? 'disabled' : '' !!}
                class="form-control" @error('city_id')  style="border-color: rgb(246, 78, 96)"  @enderror>
                <option value="" selected='selected'>
                    {!! __('flights.select') !!} {!! __('flights.city_id') !!}
                </option>
                @foreach ($cities as $key => $city)
                    <option value="{!! $city->id !!}">{!! $city->name !!}</option>
                @endforeach
            </select>
            @error('city_id')
                <span class="text text-danger">
                    <strong class="strong-weight">{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->


    <!-- begin: input -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="category_id">{!! __('flights.category_id') !!}</label>
            <select type="text" wire:model="category_id" id="category_id" name="category_id"
                class="form-control">
                <option value="">
                    {!! __('flights.select') !!} {!! __('flights.category_id') !!}
                </option>
                @foreach ($categories as $key => $category)
                    <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text text-danger">
                    <strong class="strong-weight">{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->

</div>
<!-- end: country_id , city_id , category_id -->




<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!} mt-2">
    <div class="col-md-12">

        <button type="button" wire:click ="firstStepSubmit" class="btn btn-primary  btn-glow">
            {!! __('flights.next') !!}
            <span wire:loading wire:target="firstStepSubmit">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>

        {{-- <button type="button" wire:click ="submitForm" class="btn btn-primary  btn-glow">
            {!! __('flights.submit') !!}
            <span wire:loading wire:target="submitForm">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button> --}}
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
