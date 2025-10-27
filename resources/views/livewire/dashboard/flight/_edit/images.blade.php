<h4>{!! __('flights.images') !!}</h4>
<hr>

<div class="row">
    <!-- begin: input -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="newImages">{!! __('flights.images') !!}</label>
            <input type="file" wire:model.live="newImages" class="form-control" multiple accept="image/*">
            <div wire:loading wire:target="newImages">{!! __('flights.uploading') !!}</div>
            @error('newImages')
                <span class="text text-danger">
                    <strong>{!! $message !!}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- end: input -->


    <!-- begin: new image -->
    @if ($newImages)
        <div class="col-md-12">
            <h3>{!! __('flights.new_images') !!}</h3>
            @foreach ($newImages as $key => $image)
                <div class="position-relative d-inline-block mr-2 mb-2">
                    <img src="{!! $image->temporaryUrl() !!}" class="img-fluid img-thumbnail round-md"
                        style="max-width: 300px; max-height: 300px;">

                    <!-- begin: delete image -->
                    <button type="button" wire:click="deleteNewImage({{ $key }})"
                        class="btn btn-danger btn-sm position-absolute" style=" top: 5px; right: 5px;">
                        <i class="la la-trash"></i>
                    </button>
                    <!-- end: delete image -->

                </div>
            @endforeach
            <hr>
        </div>

    @endif
    <!-- end: new  image -->


    <!-- begin: old image -->
    @if ($images)

        <div class="col-md-12">
            @foreach ($images as $key => $image)
                <div class="position-relative d-inline-block mr-2 mb-2">
                    <img src="{!! asset('uploads/flights/' . $image->file_name) !!}" class="img-fluid img-thumbnail round-md"
                        style="max-width: 300px; max-height: 300px;">

                    <!-- begin: delete image -->
                    <button type="button" wire:click="deleteOldImage({{ $key }} , {{ $image }})"
                        class="btn btn-danger btn-sm position-absolute" style=" top: 5px; right: 5px;">
                        <i class="la la-trash"></i>
                    </button>
                    <!-- end: delete image -->

                </div>
            @endforeach
        </div>
    @endif
    <!-- end: old image -->


</div>




<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!}">
    <div class="col-md-12">
        <button type="button" wire:click ="backStep(4)" class="btn btn-info btn-glow">
            {!! __('flights.back') !!}
        </button>
        <button type="button" wire:click="fifthStepSubmit" class="btn btn-primary btn-glow">
            {!! __('flights.next') !!}
            <span wire:loading wire:target="fifthStep">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
