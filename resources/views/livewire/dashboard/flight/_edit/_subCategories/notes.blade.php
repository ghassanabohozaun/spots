<!-- begin: notes ------------------------------------------------------------------------------------------------------------------------------>

<div class="table_responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    {!! __('flights.note_text_ar') !!}
                </th>
                <th>
                    {!! __('flights.note_text_en') !!}
                </th>
                <th>
                    <a href="#" wire:click.prevent="addNewNote" class="text-white badge badge-info">
                        <li class="la la-plus"></li>
                    </a>
                </th>
            </tr>

        </thead>
        <tbody>
            @foreach ($notesItems as $index => $row)
                <tr wire:key="row-{{ $index }}">
                    <td class="col-lg-6 col-md-6 col-sm-6">
                        <input type="text" wire:model="notesItems.{!! $index !!}.note_text_ar"
                            class="form-control" placeholder="{!! __('flights.enter_note_text_ar') !!}"
                            @error('notesItems.' . $index . '.note_text_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                        @error('notesItems.' . $index . '.note_text_ar')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-6 col-md-6 col-sm-6">
                        <input type="text" wire:model="notesItems.{!! $index !!}.note_text_en"
                            class="form-control" placeholder="{!! __('flights.enter_note_text_en') !!}"
                            @error('notesItems.' . $index . '.note_text_en')  style="border-color: rgb(246, 78, 96)"  @enderror />

                        @error('notesItems.' . $index . '.note_text_en')
                            <span class="text text-danger">
                                <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                    </td>

                    <td class="col-lg-1 col-md-1 col-sm-1">
                        <a href="#" wire:click.prevent ="removeNote({{ $index }})"
                            class="text-white  badge badge-danger">
                            <li class="la la-trash"></li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>


{{-- @foreach ($notesItems as $index => $row)
    <div class="row mt-1" wire:key="row-{{ $index }}">

        <!-- begin: input  note_text_ar-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="sr-only" for="note_text_ar">{!! __('flights.note_text_ar') !!} </label>
                <input type="text" wire:model="notesItems.{!! $index !!}.note_text_ar" class="form-control"
                    placeholder="{!! __('flights.enter_note_text_ar') !!}"
                    @error('notesItems.' . $index . '.note_text_ar')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('notesItems.' . $index . '.note_text_ar')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  note_text_ar-->

        <!-- begin: input  note_text_en-->
        <div class="col-md-5">
            <div class="form-group">
                <label class="sr-only" for="note_text_en">{!! __('flights.note_text_en') !!} </label>
                <input type="text" wire:model="notesItems.{!! $index !!}.note_text_en" class="form-control"
                    placeholder="{!! __('flights.enter_note_text_en') !!}"
                    @error('notesItems.' . $index . '.note_text_en')  style="border-color: rgb(246, 78, 96)"  @enderror>

                @error('notesItems.' . $index . '.note_text_en')
                    <span class="text text-danger">
                        <strong>{!! $message !!}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <!-- end: input  note_text_en-->


        <div class="col-md-1">
            <label class="sr-only" for=""></label>
            <button type="button" wire:click.prevent ="removeNote({{ $index }})"
                class="btn btn-danger btn-glow ">
                <li class="la la-trash"></li>
            </button>
        </div>
    </div>
@endforeach

<hr style="background-color: rgb(167, 163, 163)">
<button type="button" wire:click.prevent="addNewNote" class="btn btn-success btn-glow ">
    <li class="la la-plus"></li>
</button> --}}
