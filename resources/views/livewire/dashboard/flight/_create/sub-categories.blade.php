<h4>{!! __('flights.sub_categories') !!}</h4>
<hr>

<h3 class="text-info mt-2">{!! __('flights.notes') !!}</h3>
<hr>
<div class="row">
    <div class="col-lg-12">
        @include('livewire.dashboard.flight._edit._subCategories.notes')
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <!-- begin: offer not including -------------------------------------------------------------------------------------------------------------------->
        @include('livewire.dashboard.flight._edit._subCategories.including')
    </div>

    <div class="col-md-6 col-sm-12">
        <!-- begin: offer not including -------------------------------------------------------------------------------------------------------------------->
        @include('livewire.dashboard.flight._edit._subCategories.notIncluding')

    </div>

</div>



<!-- begin: button -->
<div class="row {!! Lang() == 'ar' ? 'pull-left' : 'pull-right' !!}">
    <div class="col-md-12">
        <button type="button" wire:click ="backStep(3)" class="btn btn-info btn-glow">
            {!! __('flights.back') !!}
        </button>
        <button type="button" wire:click="forthStepSubmit" class="btn btn-primary btn-glow">
            {!! __('flights.next') !!}
            <span wire:loading wire:target="forthStepSubmit">
                <i class="la la-refresh spinner">
                </i>
            </span>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<!-- end: button -->
