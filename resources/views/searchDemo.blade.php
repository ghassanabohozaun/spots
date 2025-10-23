<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Select2 JS Autocomplete Search Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Laravel 11 Select2 JS Autocomplete Search Example - ItSolutionStuff.com</h3>
            <div class="card-body">

                <form action="#" method="POST" enctype="multipart/form-data" class="mt-2">
                    @csrf

                    <select class="form-control" id="search" style="width:500px;" name="user_id"></select>

                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        var path = "{{ route('website.autocomplete') }}";

        $('#search').select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! __('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },
            language: {
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
            },

            ajax: {
                url: path,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.countryName,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

</body>

</html>
