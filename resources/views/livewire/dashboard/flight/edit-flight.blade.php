@push('style')
    {{-- <style>
        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.95rem;
            line-height: 1.0;
        }
    </style> --}}
@endpush
<form class="form" method="POST">
    @csrf
    <div class="form-body">

        @if (!empty($successMessage))
            <div class="container-fluid">
                <div class="alert alert-success">
                    {!! $successMessage !!}
                </div>
            </div>
        @endif

        <!-- begin: steps row -->
        <div class="container">
            <div class="col-md-10 col-sm-10">
                <div class="step-wizard ">
                    <ul class="step-wizard-list">
                        <li class="step-wizard-item  {!! $currentStep == 1 ? 'current-item' : '' !!}" wire:click ="backStep(1)">
                            <span class="progress-count">1</span>
                        </li>
                        <li class="step-wizard-item {!! $currentStep == 2 ? 'current-item' : '' !!}" wire:click ="backStep(2)">
                            <span class="progress-count">2</span>
                        </li>
                        <li class="step-wizard-item {!! $currentStep == 3 ? 'current-item' : '' !!}" wire:click ="backStep(3)">
                            <span class="progress-count">3</span>
                        </li>
                        <li class="step-wizard-item {!! $currentStep == 4 ? 'current-item' : '' !!}" wire:click ="backStep(4)">
                            <span class="progress-count">4</span>
                        </li>
                        <li class="step-wizard-item {!! $currentStep == 5 ? 'current-item' : '' !!}" wire:click ="backStep(5)">
                            <span class="progress-count">5</span>
                        </li>
                        <li class="step-wizard-item {!! $currentStep == 6 ? 'current-item' : '' !!}" wire:click ="backStep(1)">
                            <span class="progress-count">6</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- end: steps row -->


        <!-- begin: first basic -->
        <div class="container-fluid {!! $currentStep != 1 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.basic')
        </div>
        <!-- end: first basic  -->


        <!-- begin: second services -->
        <div class="container-fluid {!! $currentStep != 2 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.services')
        </div>
        <!-- end: second services -->


        <!-- begin: third prices -->
        <div class="container-fluid {!! $currentStep != 3 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.prices')
        </div>
        <!-- end: third prices -->


        <!-- begin: third sub categories -->
        <div class="container-fluid {!! $currentStep != 4 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.sub-categories')
        </div>
        <!-- end: third prices -->

        <!-- begin: fourth images -->
        <div class="container-fluid {!! $currentStep != 5 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.images')

        </div>
        <!-- end: fourth child file -->

        <!-- begin: fifth confirmations -->
        <div class="container-fluid {!! $currentStep != 6 ? 'displayNone' : '' !!}">
            @include('livewire.dashboard.flight._edit.confirmations')
        </div>
        <!-- end: fifth confirmations -->

    </div>
</form>
