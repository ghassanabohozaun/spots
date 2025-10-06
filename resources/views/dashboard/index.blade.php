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
                    <h3 class="content-header-title mb-0 d-inline-block">{!! __('dashboard.dashboard') !!}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->
            </div> <!-- end :content header -->

            <!-- begin: staticstics -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-user info font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{!! $admins_count !!}</h3>
                                        <span>{!! __('children.admins_count') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-user-following warning font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>1</h3>
                                        <span>{!! __('children.programs_count') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-pointer success font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{!! $governorates_count !!}</h3>
                                        <span>{!! __('children.governorates_count') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-pointer danger font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{!! $cities_count !!}</h3>
                                        <span>{!! __('children.cities_count') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: staticstics -->

            <!-- begin: children -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- begin: card header -->
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->

                                <!-- begin: card content -->
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        {{-- <!--begin::Body-->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="table-responsive ">
                                                    <table class="table"
                                                        style="text-align: center;vertical-align: middle;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">{!! __('children.picture_of_the_orphan_child') !!}</th>
                                                                <th scope="col">{!! __('children.full_name') !!}</th>
                                                                <th scope="col">{!! __('children.personal_id') !!}</th>
                                                                <th scope="col">{!! __('children.birthday') !!}</th>
                                                                <th scope="col">{!! __('children.gender') !!}</th>
                                                                <th scope="col">{!! __('children.class') !!}</th>
                                                                <th scope="col">{!! __('children.authorized_contact_number') !!}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($children as $key => $child)
                                                                <tr>
                                                                    <td>{!! $loop->iteration !!}</td>
                                                                    <td>
                                                                        @if ($child->childFile->picture_of_the_orphan_child)
                                                                            <img src="{{ asset('uploads/children/' . $child->childFile->picture_of_the_orphan_child) }}"
                                                                                class="img-fluid img-thumbnail table-image " />
                                                                        @else
                                                                            <img src="{{ asset('adminBoard/images/images-empty.png/') }}"
                                                                                class="img-fluid img-thumbnail table-image " />
                                                                        @endif
                                                                    </td>
                                                                    <td>{!! $child->childFullName() !!} </td>
                                                                    <td>{!! $child->personal_id !!}</td>
                                                                    <td>{!! $child->birthday !!}</td>
                                                                    <td>{!! $child->childGender() !!}</td>
                                                                    <td>{!! $child->class !!}</td>
                                                                    <td>{!! $child->authorized_contact_number !!}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Body--> --}}
                                    </div>
                                </div>
                                <!-- end: card content -->
                            </div>
                        </div> <!-- end: card  -->
                    </div><!-- end: row  -->
                </section><!-- end: sections  -->
            </div>
            <!-- end: children  -->


        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->
@endsection
