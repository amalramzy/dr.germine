@extends('layouts.master')

@section('content')

{{-- <form id="adminForm" name="adminForm"  > --}}
    <form method="POST" action="{{ route('reservation.update', [$reservation->id]) }}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}

    {{-- <input type="hidden" name="reservation_id" id="reservation_id" value="{{$reservation->id}}"> --}}
    <input type="hidden" name="child_id" id="child_id" value="{{$reservation->child_id}}">
    <input type="hidden" name="is_follow_up" id="is_follow_up" value="0">

        <h5 class="mb-4 text-uppercase"><i class="fe-calendar"></i> {{__('messages.Edit Reservation')}}</h5>
        <div class="row">
            <div class="col-md-6">
                <h4 class="header-title mt-5 mt-sm-3">{{__('messages.Type')}}</h4>
                <div class="mt-3">
                    <select class="form-select" name="type" id="type">
                        <option value="examanation" @if($reservation->type == "examanation")selected @endif>{{__('messages.Examanation')}}</option>
                        <option value="vaccination" @if($reservation->type == "vaccination")selected @endif>{{__('messages.Vaccination')}}</option>
                        <option value="examanation,vaccination" @if($reservation->type == "examanation,vaccination")selected @endif >{{__('messages.Examanation & Vaccination')}}</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4" id="showVaccin" style="display: none">
                <div class="mt-3">
                    @foreach(\App\Models\Vaccination::where('days','<=', (int)$childDays)->get() as $vaccine)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck1" value="{{$vaccine->id}}" name="vaccin_id[]" @if(in_array($vaccine->id , $reservation->vaccinations()->pluck('vaccinations.id')->toArray()))checked @endif>
                        <label class="form-check-label" for="customCheck1">{{$vaccine->name}}</label>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
      
        <div class="row mt-3">
            <div class="col-md-12">

                <div class="mb-3">
                    <label for="patient_comment" class="form-label">{{__('messages.Patient Comment')}}</label>
                    <textarea id="patient_comment" name="patient_comment" class="form-control">{{$reservation->patient_comment}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="secretarial_comment" class="form-label">{{__('messages.Secretarial Comment')}}</label>
                    <textarea id="secretarial_comment" name="secretarial_comment" class="form-control">{{$reservation->secretarial_comment}}</textarea>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-check">
                        <input type="radio" id="slots" name="age" class="form-check-input" value="slots" @if($reservation->slot_id != null) checked @endif>
                        <label class="form-check-label" for="slots">{{__('messages.Solts')}}</label>
                    </div>
                    <div class="mt-3 @if($reservation->slot_id == null) none @endif" id="showSlot" >
                        <select class="form-select" name="slot_id" id="slot_id"> 
                            <option value="00">{{__('messages.Select')}}</option>
                            @foreach ($slots as $slot)
                            <option value="{{ $slot->id }}" @if($reservation->slot_id == $slot->id)selected @endif >{{$slot->date}} - {{date('h:i a', strtotime($slot->from))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mt-3">
                        <input type="radio" id="datetime" name="age" class="form-check-input ddd" value="datetime" @if($reservation->slot_id == null) checked @endif>
                        <label class="form-check-label " for="datetime">{{__('messages.Special Datetime')}}</label>
                    </div>
                    <div class="row mt-4 @if($reservation->slot_id != null) none @endif" id="showDatetime" >
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" value="{{$reservation->special_datetime}}">
                            </div>
                        </div>

                    </div>
                   
                </div>
            </div>

        </div> <!-- end row -->






      <div class="text-end">
          <button type="submit" class="btn btn-success waves-effect waves-light mt-2" id="saveBtn" value="create"><i class="mdi mdi-content-save"></i>{{ __('messages.Save') }}</button>
      </div>
  </form>


@endsection
@section('scripts')
<script type="text/javascript">
                        $(function () {
                          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
  
    //   /*------------------------------------------
    //   --------------------------------------------
    //   Create child Code
    //   --------------------------------------------
    //   --------------------------------------------*/
    //   $('#saveBtn').click(function (e) {
    //       e.preventDefault();
    //       $(this).html("{{ __('messages.Sending..') }}");
    //       var reservation_id = $(this).data("id");

    //       $.ajax({
    //         data: $('#adminForm').serialize(),
    //         url: "admin/reservation/"+reservation_id,
    //         type: "POST",
    //         dataType: 'json',
    //         success: function (data) {
            
    //             $('#adminForm').trigger("reset");
    //             $('#ajaxModel').modal('hide');
    //             table.draw();
             
    //         },
    //         error: function (xhr, status, error) {
    //             let err = JSON.parse(xhr.responseText);
    //             let item = err.errors;
    //             Object.keys(item).forEach(key => {
    //                 console.log(item[key].join(","))
    //                 $('#errors_list').append(
    //                     "<li class='text-white'>"+item[key].join(",")+"</li>"
    //                 );
    //                 $('#danger-alert-modal').modal('show');

    //             });

    //             $('#saveBtn').html('{{__("messages.Save")}}');
    //         }
    //     });
    
    // });
       //slots
       $(function() {
    $("input[name='age']").click(function() {
      if ($("#slots").is(":checked")) {
        $("#showSlot").show();
      } else {
        $("#showSlot").hide();
      }
    });
  });
  //specialtime
  $(function() {
    $("input[name='age']").click(function() {
      if ($("#datetime").is(":checked")) {
        $("#showDatetime").show();
        $("#showSlot").hide();
      } else {
        $("#showDatetime").hide();
      }
    });
  });

  //vaccin show
$("#type").change(function(){
$value = $(this).val();
if($value == "examanation,vaccination" || $value == "vaccination" ){
$("#showVaccin").show();
}else{
$("#showVaccin").hide();
}

});
});
</script>
@endsection
