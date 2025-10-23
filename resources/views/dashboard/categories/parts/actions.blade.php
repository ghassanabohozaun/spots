<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <a href="{!! route('dashboard.categories.edit', $category->id) !!}" class="btn btn-sm btn-outline-primary" title="{!! __('general.edit') !!}">
            <i class="la la-edit"></i>
        </a>


        {{-- <a href="#" class="btn btn-sm btn-outline-primary edit_category_button" title="{!! __('general.edit') !!}"
            category-id="{!! $category->id !!}" category-name-ar="{!! $category->getTranslation('name', 'ar') !!}"
            category-name-en="{!! $category->getTranslation('name', 'en') !!}" category-icon="{!! $category->icon !!}"
            category-status="{!! $category->status !!}">
            <i class="la la-edit"></i>
        </a> --}}

        <a href="#" data-id="{!! $category->id !!}" class="btn btn-sm btn-outline-danger delete_category_btn"
            title="  {!! __('general.delete') !!}">
            <i class="la la-trash"></i>
        </a>

    </div>
</div>
