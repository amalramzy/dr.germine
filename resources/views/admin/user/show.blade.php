@extends('layouts.master')
@section('content') 
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between mb-2">
                                            <div class="col-auto">
                                                <form>
                                                    <div class="mb-2">
                                                        <label for="inputPassword2" class="visually-hidden">Search</label>
                                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-sm-end">
                                                    {{-- <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-1"><i class="mdi mdi-cog"></i></button> --}}
                                                    <a class="btn btn-success" href="javascript:void(0)" id="createNewChild">{{__('messages.Create New Child')}}</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('messages.No')}}</th>
                                                        <th >{{__('messages.Name')}}</th>
                                                        <th >{{__('messages.Birthdate')}}</th>
                                                        <th>{{__('messages.Gender')}}</th>
                                                        <th > {{__('messages.Hospital')}}</th>
                                                        {{-- <th>{{__('messages.Father')}}</th> --}}
                                
                                                        <th>{{__('messages.Actions')}}</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                               </tbody>
                                            </table>
                                        </div>

                                        

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex  mb-3">
                                            <img class="d-flex me-3 rounded-circle avatar-xl" src="{{ asset('assets/images/admin/admin.jpg')}}" alt="Generic placeholder image">
                                            <div class="w-100">
                                                <h4 class="mt-0 mb-1">{{$user->father}}</h4>
                                                {{-- <p class="text-muted">Mother</p> --}}
                                                {{-- <p class="text-muted"><i class="mdi mdi-office-building"></i></p> --}}
    
                                                {{-- <a href="javascript: void(0);" class="btn- btn-xs btn-info">Email</a>
                                                <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">phone</a> --}}
                                                <button class="btn btn-danger btn-xs waves-effect mb-2 waves-light" type="button" data-toggle="modal" data-target="#send-notification">{{__('messages.Send Notification')}}</button>

                                                {{-- <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Send Notification</a> --}}
                                            </div>
                                        </div>
    
                                        <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i>{{__('messages.Personal Information')}}</h5>
                                        <div class="">
                                            <h4 class="font-13 text-muted text-uppercase">{{__('messages.Father')}}</h4>
                                            <p class="mb-3">
                                                {{$user->father}}
                                            </p>
    
                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Mother')}}</h4>
                                            <p class="mb-3">{{$user->mother}}</p>
    
                                            {{-- <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Area')}}</h4>
                                            <p class="mb-3">{{$user->area_id}}</p> --}}
    
                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Email')}}</h4>
                                            <p class="mb-3">{{$user->email}}</p>
    
                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Registration Phone')}}</h4>
                                            <p class="mb-0">{{$user->phone1}}</p>

                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Additional Phone')}}</h4>
                                            <p class="mb-0">{{$user->phone2}}</p>
    
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div>
                        </div>
                        <!-- end row -->
                    

<div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form id="adminForm" name="adminForm" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="child_id" id="child_id">
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">

                <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="birthdate" class="form-label">{{ __('messages.Birthdate') }}</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="" max={{ now()->toDateString('Y-m-d') }} required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">{{ __('messages.Gender') }}</label>
                                    <select name="gender" id="gender" class="form-control"  required>
                                        <option value="">{{__('messages.Gender')}}</option>

                                            <option value="male">{{__('messages.Male')}}</option>
                                            <option value="female">{{__('messages.Female')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hospital" class="form-label">{{ __('messages.Hospital') }}</label>
                                    <input type="text" id="hospital" name="hospital" required="" class="form-control">
                                </div>
                            </div>
                     
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('messages.Image') }}</label>
                                    <input type="file" id="image" name="image" required="" class="form-control">
                                </div>
                            </div>


                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn" value="create">{{ __('messages.Save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div><!-- /.modal -->
@include('admin.user.notification')


      

@endsection
@section('scripts')
        <script type="text/javascript">
            $(function () {
                $('#page-tage').html('{{__("messages.User Profile")}}');

              /*------------------------------------------
               --------------------------------------------
               Pass Header Token
               --------------------------------------------
               --------------------------------------------*/ 
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
              });
                
        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.dataTable').DataTable({

            bPaginate: false,//hide pagination
            bFilter: false, //hide Search bar
            bInfo: false, // "Showing 1 to 4 of 4 entries"
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.show',[$user->id]) }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'birthdate', name: 'birthdate'},
              {data: 'gender', name: 'gender'},
            //   {data: 'day', name: 'day'},
              {data: 'hospital', name: 'hospital'},
            //   {data: 'user_id', name: 'user_id'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewChild').click(function () {
          $('#saveBtn').val("create-child");
          $('#child_id').val('');
          $('#adminForm').trigger("reset");
          $('#modelHeading').html('{{__("messages.Create New Child")}}');
          $('#ajaxModel').modal('show');
      });
      /*------------------------------------------
      --------------------------------------------
      Create Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          $(this).html('{{__("messages.Sending..")}}');
          // Upload File logic
          let form_data = new FormData();
                let values =$('#adminForm').serializeArray();
                console.log(values)
                for ( var item in  values) {
                    form_data.append(values[item].name, values[item].value);
                }
                form_data.append('image',$('#image')[0].files[0])
          $.ajax({
            data: form_data,
            url: "{{ route('children.store') }}",
            type: "POST",
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
         
                $('#adminForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
             
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html("{{ __('messages.Save') }}");
            }
        });
      });
      /*------------------------------------------
      --------------------------------------------
      Delete Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.deleteChild', function () {
       
       var child_id = $(this).data("id");
       if(confirm("{{__('messages.Are You sure want to delete !')}}")){
         // event.preventDefault();
         $.ajax({
           type: "DELETE",
           url: "{{ route('children.store') }}"+'/'+child_id,
           success: function (data) {
               table.draw();
           },
           error: function (data) {
               console.log('Error:', data);
           }
       });
       }else{
         event.preventDefault();
       }
   });
      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editChild', function () {
        var child_id = $(this).data('id');
        $.get("{{ route('children.index') }}" +'/' + child_id +'/edit', function (data) {
            $('#modelHeading').html("{{ __('messages.Edit') }}");
            $('#saveBtn').val("edit-child");
            $('#ajaxModel').modal('show');
            $('#child_id').val(data.id);
            $('#name').val(data.name);
            $('#gender').val(data.gender);
            $('#hospital').val(data.hospital);
            $('#user_id').val(data.user_id);
            $('#birthdate').val(data.birthdate);
        })
      });


            });
  </script>
@endsection