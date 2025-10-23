@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/vendors/css/forms/selects/select2.min.css') !!}">
@endpush

<div class="card">
    <!-- begin: card header -->
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-colored-form-control">
            {!! __('general.filters') !!}
        </h4>
        <a class="heading-elements" data-action="collapse"><i class="ft-minus"></i></a>
    </div>
    <!-- end: card header -->

    <!-- begin: card content  show-->
    <div class="card-content collapse  ">
        <div class="card-body">
            <form class="form">
                <div class="form-body">

                    <div class="row">
                        <!-- begin: input  class="sr-only"-->
                        <div class="form-group col-md-2">
                            <label for="price">{!! __('tours.price') !!}</label>
                            <input type="number" class="form-control" placeholder="{!! __('tours.enter_price') !!}"
                                id="price" name="price">
                        </div>
                        <!-- end: input -->


                        <!-- begin: input -->
                        <div class="form-group col-md-2">
                            <label for="country_id">{!! __('tours.country_id') !!}</label>
                            <select class="country_id_select form-control" id="country_id" name="country_id"
                                style="width: 100%">

                            </select>
                        </div>
                        <!-- end: input -->

                        <!-- begin: input -->
                        <div class="form-group col-md-2">
                            <label for="governorate_id">{!! __('tours.governorate_id') !!}</label>
                            <select class="governorate_id_select form-control" id="governorate_id" name="governorate_id"
                                style="width: 100%">

                            </select>
                        </div>
                        <!-- end: input -->

                        <!-- begin: input -->
                        <div class="form-group col-md-2">
                            <label for="status">{!! __('tours.status') !!}</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">{!! __('general.select_from_list') !!}</option>
                                <option value="1">{!! __('general.enable') !!}</option>
                                <option value="0">{!! __('general.disabled') !!}</option>
                            </select>
                        </div>
                        <!-- end: input -->

                    </div>

                    <div class="form-actions" style="margin-top: -8px">
                        <button type="button" class="btn btn-sm btn-secondary mr-1" id="ticket_search_btn">
                            <i class="la la-search"></i> {!! __('general.search') !!}
                        </button>
                        <button type="submit" class="btn btn-sm btn-light-dark mr-1" id="ticket_reset_btn">
                            <i class="la la-close"></i> {!! __('general.reset') !!}
                        </button>

                        {{-- <a href="{!! route('dashboard.tours.export') !!}" type="button" class="btn btn-sm btn-light mr-1"
                            id="ticket_ecxel">
                            <i class="la la-file-excel-o"></i> {!! __('general.excel') !!}
                        </a>

                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-glow mr-1">
                            <span class="la la-file-pdf-o"></span> {!! __('general.pdf') !!}
                        </a> --}}
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- end: card content -->

</div> <!-- end: card  -->

@push('scripts')
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>

    <script>
        // $('body').on('click', '#ticket_ecxel', function(e) {
        //     e.preventDefault();

        //     var price = $('#price').val();
        //     var country_id = $('#country_id').val();
        //     var governorate_id = $('#governorate_id').val();
        //     var to_country_id = $('#to_country_id').val();
        //     var to_governorate_id = $('#to_governorate_id').val();
        //     var status = $('#status').val();

        //     $.ajax({
        //         url: "{{ route('dashboard.tours.export') }}",

        //         type: 'get',
        //         data: {
        //             price: price,
        //             country_id: country_id,
        //             governorate_id: governorate_id,
        //             to_country_id: to_country_id,
        //             to_governorate_id: to_governorate_id,
        //             status: status,
        //         },
        //         success: function(data) {
        //             console.log(data);
        //         }, //end success
        //     })

        // })


        // search
        $('body').on('click', '#ticket_search_btn', function(e) {
            e.preventDefault();
            var price = $('#price').val();
            var country_id = $('#country_id').val();
            var governorate_id = $('#governorate_id').val();
            var status = $('#status').val();

            loadData(price, country_id, governorate_id, status);
        })


        // reset
        $('body').on('click', '#ticket_reset_btn', function(e) {
            e.preventDefault();
            $('#price').val('');
            $(".country_id_select").val('').trigger('change');
            $(".governorate_id_select").val('').trigger('change');
            $('#status').val('');

            loadData();
        });



        // select 2 language
        var select2Language = {
            inputTooShort: function() {
                return "{!! __('general.inputTooShort') !!}";
            },
            inputTooLong: function() {
                return "{!! __('general.inputTooLong') !!}";
            },
            errorLoading: function() {
                return "{!! __('general.errorLoading') !!}";
            },
            noResults: function() {
                return "<span>{!! __('general.noResults2') !!}";
            },
            searching: function() {
                return " {!! __('general.searching') !!}";
            }
        };


        // select 2
        var countryPath = "{{ route('dashboard.governorates.autocomplete.country') }}";
        $(".country_id_select").select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! __('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },

            language: select2Language,

            ajax: {
                url: countryPath,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            if ('{!! Lang() !!}' === 'en') {
                                return {
                                    text: item.country_en,
                                    id: item.id
                                }
                            } else {
                                return {
                                    text: item.country_ar,
                                    id: item.id
                                }
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // select 2
        $(".to_country_id_select").select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! __('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },

            language: select2Language,

            ajax: {
                url: countryPath,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            if ('{!! Lang() !!}' === 'en') {
                                return {
                                    text: item.country_en,
                                    id: item.id
                                }
                            } else {
                                return {
                                    text: item.country_ar,
                                    id: item.id
                                }
                            }
                        })
                    };
                },
                cache: true
            }
        });


        // select 2
        var governoratePath = "{{ route('dashboard.cities.autocomplete.govnerorate') }}";
        $(".governorate_id_select").select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! __('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },

            language: select2Language,

            ajax: {
                url: governoratePath,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            if ('{!! Lang() !!}' === 'en') {
                                return {
                                    text: item.country_en,
                                    id: item.id
                                }
                            } else {
                                return {
                                    text: item.country_ar,
                                    id: item.id
                                }
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // select 2
        $(".to_governorate_id_select").select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! __('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },

            language: select2Language,

            ajax: {
                url: governoratePath,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            if ('{!! Lang() !!}' === 'en') {
                                return {
                                    text: item.country_en,
                                    id: item.id
                                }
                            } else {
                                return {
                                    text: item.country_ar,
                                    id: item.id
                                }
                            }

                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endpush
