<div class="badge badge-md {!! $governorate->status == 'on' ? 'badge-success' : 'badge-danger' !!} governorate_status_{!! $governorate->id !!}" id=''>
    {!! $governorate->status == 'on' ? __('general.enable') : __('general.disabled') !!}
</div>
