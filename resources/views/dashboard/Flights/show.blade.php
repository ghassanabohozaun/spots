@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="app-content content">

        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row">
                <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{!! __('children.children') !!}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.children.index') !!}">
                                        {!! __('children.children') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a href="{!! route('dashboard.children.show', $child->id) !!}">
                                        {!! $child->childFullName() !!}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12">
                    <div class="float-md-right mb-1">
                        <a href="{!! route('dashboard.children.edit', $child->id) !!}" class="btn btn-primary round btn-glow px-2">
                            {!! __('children.update_child') !!}
                        </a>
                        <a href="{!! route('dashboard.children.create') !!}" class="btn btn-info  btn-glow px-2">
                            {!! __('children.create_new_child') !!}
                        </a>
                    </div>
                </div>
                <!-- end: content header right-->

            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">

                <!-- begin: section -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- begin: card header -->
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-colored-form-control">
                                        {!! __('children.child_info') !!}
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload-form"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->

                                <!-- begin: card content -->
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="row mb-3" style="margin: 10px">
                                            <a href="{!! route('dashboard.children.download.pdf', $child->id) !!}" target="_blank"
                                                class="btn btn-warning btn-glow px-2">
                                                <i class="la la-file-pdf-o"></i> {!! __('children.download_sponsorship_form') !!}
                                            </a>
                                        </div>
                                        <!-- begin: basic info div -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @livewire('dashboard.child.show-child', compact('ChildID', 'child'))
                                            </div>
                                        </div>
                                        <!-- end: basic info div -->
                                    </div>
                                    <!-- end: card content -->
                                </div>
                            </div> <!-- end: card  -->
                        </div><!-- end: row  -->
                    </div>
                </section>
                <!-- end: section   -->

            </div><!-- end: content body  -->
        </div> <!-- end: content wrapper  -->

    </div><!-- end: content app  -->
@endsection
@push('scripts')
@endpush
