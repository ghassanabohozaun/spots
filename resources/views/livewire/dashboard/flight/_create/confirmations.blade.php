@push('style')
    <style>
        .p-1 {
            padding: 0.7rem !important;
        }
    </style>
@endpush
<h4>{!! __('flights.confirmations') !!}</h4>
<hr>

<!-- begin: basic information -->
<h2>{!! __('flights.basic') !!}</h2>


<table class="table table-responsive" style=" width:100%;">
    <tbody>
        <tr>
            <td style="background-color: #f1f1f1">{!! __('flights.name_ar') !!}</td>
            <td>{!! $name_ar !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.name_en') !!}</td>
            <td>{!! $name_en !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.details_ar') !!}</td>
            <td>{!! $details_ar !!}</td>

        </tr>

        <tr>
            <td style="background-color: #f1f1f1">{!! __('flights.details_ar') !!}</td>
            <td>{!! $details_en !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.days_num') !!}</td>
            <td>{!! $days_num !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.nights_num') !!}</td>
            <td>{!! $nights_num !!}</td>

        </tr>

        <tr>
            <td style="background-color: #f1f1f1">{!! __('flights.offer_duration_from') !!}</td>
            <td>{!! $offer_duration_from !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.offer_duration_to') !!}</td>
            <td>{!! $offer_duration_to !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.country_id') !!}</td>
            <td>{!! $country_id ? $countries->where('id', $country_id)->first()->getTranslation('name', Lang()) : '' !!}</td>

        </tr>
        <tr>
            <td style="background-color: #f1f1f1">{!! __('flights.city_id') !!}</td>
            <td> {!! $city_id ? $cities->where('id', $city_id)->first()->getTranslation('name', Lang()) : '' !!}</td>
            <td style="background-color: #f1f1f1">{!! __('flights.category_id') !!}</td>
            <td>{!! $category_id ? $categories->where('id', $category_id)->first()->getTranslation('name', Lang()) : '' !!}</td>
        </tr>

    </tbody>

</table>

<!-- end: basic information -->


{{-- <div class="row">
    <div class="col-md-6">
        <div class="card mb-1" style="background-color: #f1f1f1">
            <div class="card-content">
                <div class="p-1">
                    <p class="mb-0 p-1" style="background-color: white">
                        <strong>Blue Grey Lighten 1</strong>
                        <small class="text-muted float-right blue-grey">#78909C</small>
                    </p>
                </div>
            </div>
        </div>


    </div>


    <div class="col-md-6">
        <div class="card mb-1">
            <div class="card-content" style="background-color: #f1f1f1">
                <div class="p-1">
                    <p class="mb-0">
                        <strong>Blue Grey Darken 1</strong>
                        <small class="text-muted float-right blue-grey darken-1">#546E7A</small>
                    </p>
                    <p class="mb-0">.blue-grey.darken-1</p>
                </div>
            </div>
        </div>


    </div>
</div> --}}



<!------------------------------------- services --------------------------------------------------->
<div class="row mt-1">
    <div class="col-md-12">
        <h3><span class="ft-list text-primary"></span> &nbsp; {!! __('flights.services') !!}</h3>
        <div class="card mb-0" style="background-color: #f1f1f1">
            @foreach ($servicesItems as $index => $service)
                <div class="card-content">
                    <div class="p-1 round">
                        <div class="mb-0 p-1 " style="background-color: white">
                            <p> <span class="ft-check"></span> {!! $service['service_name_ar'] !!}</p>
                            <hr>
                            <p> <span class="ft-check"></span> {!! $service['service_name_en'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!------------------------------------- services --------------------------------------------------->

<!------------------------------------- prices --------------------------------------------------->
<div class="row mt-1">
    <div class="col-md-12">
        <h3><span class="icon-wallet text-warning"></span> &nbsp; {!! __('flights.prices') !!}</h3>
        <div class="card mb-0" style="background-color: #f1f1f1">
            @foreach ($pricesItems as $index => $price)
                <div class="card-content">
                    <div class="p-1 round">
                        <div class="mb-0 p-1 " style="background-color: white">
                            <small class="text-muted float-right danger" style="font-size: 1rem">
                                {!! __('flights.price') !!} &nbsp; {!! $price['price'] !!} &nbsp;&nbsp;

                                @if ($price['main_option'] == 1)
                                    <span class="badge badge-success">
                                        {!! __('general.enable') !!}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        {!! __('general.disabled') !!}
                                    </span>
                                @endif
                            </small>
                            <p> <span class="ft-check"></span> {!! $price['price_text_ar'] !!}</p>

                            <hr>
                            <p> <span class="ft-check"></span> {!! $price['price_text_en'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!------------------------------------- prices --------------------------------------------------->


<!------------------------------------- Notes --------------------------------------------------->
<div class="row mt-1">
    <div class="col-md-12">
        <h3><span class="icon-notebook text-info"></span> &nbsp; {!! __('flights.notes') !!}</h3>
        <div class="card mb-0" style="background-color: #f1f1f1">
            @foreach ($notesItems as $index => $note)
                <div class="card-content">
                    <div class="p-1 round">
                        <div class="mb-0 p-1 " style="background-color: white">
                            <p> <span class="ft-check"></span> {!! $note['note_text_ar'] !!}</p>
                            <hr>
                            <p> <span class="ft-check"></span> {!! $note['note_text_en'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!------------------------------------- Notes --------------------------------------------------->


<!------------------------------------- including and not including --------------------------------------------------->
<div class="row">
    <div class="col-md-6 mt-1">
        <h3><span class="ft-plus-circle text-success"></span> &nbsp; {!! __('flights.offer_including') !!}</h3>
        <div class="card mb-0" style="background-color: #f1f1f1">
            @foreach ($offerIncludingItems as $index => $offerIncluding)
                <div class="card-content">
                    <div class="p-1 round">
                        <div class="mb-0 p-1 " style="background-color: white">
                            <p> <span class="ft-check"></span> {!! $offerIncluding['including_text_ar'] !!}</p>
                            <hr>
                            <p> <span class="ft-check"></span> {!! $offerIncluding['including_text_en'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6 mt-1">
        <h3><span class="ft-minus-circle text-danger" style="font-size: 20px"></span> &nbsp; {!! __('flights.offer_not_including') !!}
        </h3>
        <div class="card mb-0" style="background-color: #f1f1f1">
            @foreach ($offerNotIncludingItems as $index => $offerNotIncluding)
                <div class="card-content">
                    <div class="p-1 round">
                        <div class="mb-0 p-1 " style="background-color: white">
                            <p> <span class="ft-check"></span>{!! $offerNotIncluding['not_including_text_ar'] !!}</p>
                            <hr>
                            <p> <span class="ft-check"></span> {!! $offerNotIncluding['not_including_text_en'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!------------------------------------- Notes --------------------------------------------------->



{{-- <div class="row">
    <!-- begin: services -->
    <div class="col-md-6 col-sm-12">
        <h2 class=" mt-3">{!! __('flights.services') !!}</h2>
        <table class="table table-responsive  mb-3" style=" width:100%;">
            <thead>
                <tr>
                    <th>{!! __('flights.service_name_ar') !!}</th>
                    <th>{!! __('flights.service_name_en') !!}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($servicesItems as $index => $service)
                    <tr>
                        <td> {!! $service['service_name_ar'] !!}</td>
                        <td> {!! $service['service_name_en'] !!}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end:services -->


    <!-- begin: prices -->
    <div class="col-md-6 col-sm-12">
        <h2 class="mt-3">{!! __('flights.prices') !!}</h2>
        <table class="table table-responsive" style=" width:100%;">
            <thead>
                <tr>
                    <th>{!! __('flights.price_text_ar') !!}</th>
                    <th>{!! __('flights.price_text_en') !!}</th>
                    <th>{!! __('flights.price') !!}</th>
                    <th>{!! __('flights.main_option') !!}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pricesItems as $index => $price)
                    <tr>
                        <td> {!! $price[''] !!}</td>
                        <td> {!! $price[''] !!}</td>
                        <td> {!! $price['price'] !!}</td>
                        <td>
                            @if ($price['main_option'] == 1)
                                <span class="badge badge-success">
                                    {!! __('general.enable') !!}
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    {!! __('general.disabled') !!}
                                </span>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end:prices -->
</div>



<div class="row">
    <!-- begin: notes -->
    <div class="col-md-4 col-sm-12">
        <h2 class="mt-3">{!! __('flights.notes') !!}</h2>
        <table class="table table-responsive" style=" width:100%;">
            <thead>
                <tr>
                    <th>{!! __('flights.note_text_ar') !!}</th>
                    <th>{!! __('flights.note_text_en') !!}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($notesItems as $index => $note)
                    <tr>
                        <td> {!! $note['note_text_ar'] !!}</td>
                        <td> {!! $note['note_text_en'] !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end:notes -->

    <!-- begin: offer including -->
    <div class="col-md-4 col-sm-12">
        <h2 class=" mt-3">{!! __('flights.offer_including') !!}</h2>
        <table class="table table-responsive  mb-3" style=" width:100%;">
            <thead>
                <tr>
                    <th>{!! __('flights.including_text_ar') !!}</th>
                    <th>{!! __('flights.including_text_en') !!}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($offerIncludingItems as $index => $offerIncluding)
                    <tr>
                        <td> {!! $offerIncluding['including_text_ar'] !!}</td>
                        <td> {!! $offerIncluding['including_text_en'] !!}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end:offer including -->


    <!-- begin: offer not including -->
    <div class="col-md-4 col-sm-12">
        <h2 class=" mt-3">{!! __('flights.offer_not_including') !!}</h2>
        <table class="table table-responsive  mb-3" style=" width:100%;">
            <thead>
                <tr>
                    <th>{!! __('flights.not_including_text_ar') !!}</th>
                    <th>{!! __('flights.not_including_text_en') !!}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($offerNotIncludingItems as $index => $offerNotIncluding)
                    <tr>
                        <td> {!! $offerNotIncluding['not_including_text_ar'] !!}</td>
                        <td> {!! $offerNotIncluding['not_including_text_en'] !!}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end:offer not including -->

</div>

 --}}


<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!} mt-3">
    <div class="col-md-12">
        <button type="button" wire:click ="backStep(5)" class="btn btn-info btn-glow">
            {!! __('flights.back') !!}
        </button>
        <button type="button" wire:click ="submitForm" class="btn btn-primary  btn-glow">
            {!! __('flights.submit') !!}
            <span wire:loading wire:target="submitForm">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
