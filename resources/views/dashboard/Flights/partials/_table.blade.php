 <div class="card">
     <!-- begin: card header -->
     <div class="card-header">
         <h4 class="card-title" id="basic-layout-colored-form-control">
             {!! __('flights.show_all_flights') !!}
         </h4>
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
             <div class="table-responsive ">
                 <table id="yajra-datatable" class="table table-striped table-bordered ">
                     <thead>

                         <tr>
                             <th>#</th>
                             <th>{!! __('flights.images') !!}</th>
                             <th>{!! __('flights.name') !!}</th>
                             <th>{!! __('flights.country_id') !!}</th>
                             <th>{!! __('flights.governorate_id') !!}</th>
                             <th>{!! __('flights.status') !!}</th>
                             <th>{!! __('flights.manage_status') !!}</th>
                             <th>{!! __('general.actions') !!}</th>
                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <!-- end: card content -->
 </div>
 </div> <!-- end: card  -->
