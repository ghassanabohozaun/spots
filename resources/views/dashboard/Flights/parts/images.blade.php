<!-- begin: slider-->
<div class="text-center">
    <div id="carouselExampleControls_{!! $flight->id !!}" class="carousel slide" data-ride="carousel"
        style="width: 270px;">
        <div class="carousel-inner">
            @foreach ($flight->images as $key => $image)
                <div class="carousel-item {!! $key == 0 ? 'active' : '' !!}">
                    <img src="{!! asset('uploads/flights/' . $image->file_name) !!}" class="d-block w-100" alt="...">
                </div>
            @endforeach

            <a href="#carouselExampleControls_{!! $flight->id !!}" class="carousel-control-prev" type="button"
                data-target="#carouselExampleControls_{!! $flight->id !!}" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">{!! __('general.previous') !!}</span>
            </a>
            <a href="#carouselExampleControls_{!! $flight->id !!}" class="carousel-control-next" type="button"
                data-target="#carouselExampleControls_{!! $flight->id !!}" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{!! __('general.next') !!}</span>
            </a>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-glow px-2 mt-1" data-toggle="modal"
        data-target="#fullScreenModal_{!! $flight->id !!}">
        {!! __('flights.full_screen') !!}
    </button>
</div>
<!-- end: slider-->



<!-- begin: modal-->
<div class="modal fade" id="fullScreenModal_{!! $flight->id !!}" tabindex="-1" role="dialog"
    aria-labelledby="fullScreenModalLabel" aria-hidden="true" style="z-index: 10001">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--begin::modal header-->
            <div class="modal-header">
                <h5 class="modal-title test_answer_header" id="fullScreenModalLabel">{!! $flight->name !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--end::modal header-->

            <!--begin::modal body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="carouselExampleControlsModal_{!! $flight->id !!}" class="carousel slide"
                            data-ride="carousel" style="width: 100%">
                            <div class="carousel-inner">
                                @foreach ($flight->images as $key => $image)
                                    <div class="carousel-item {!! $key == 0 ? 'active' : '' !!}">
                                        <img src="{!! asset('uploads/flights/' . $image->file_name) !!}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                                <a href="#carouselExampleControlsModal_{!! $flight->id !!}"
                                    class="carousel-control-prev" type="button"
                                    data-target="#carouselExampleControlsModal_{!! $flight->id !!}"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{!! __('general.previous') !!}</span>
                                </a>
                                <a href="#carouselExampleControlsModal_{!! $flight->id !!}"
                                    class="carousel-control-next" type="button"
                                    data-target="#carouselExampleControlsModal_{!! $flight->id !!}"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{!! __('general.next') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::modal body-->
        </div>
    </div>
</div>
<!-- end: modal-->
