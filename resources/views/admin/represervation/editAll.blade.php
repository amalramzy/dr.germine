@extends('layouts.master')

@section('content')

{{-- <form id="adminForm" name="adminForm"  > --}}
    <form method="POST" action="{{ route('represervation.store') }}" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
     <input type="hidden" name="represervation_id" id="represervation_id" value="{{$represervation->id}}">
    <input type="hidden" name="salePerson_id" id="represervation_id" value="{{$represervation->salePerson_id}}">
    <input type="hidden" name="is_follow_up" id="is_follow_up" value="0">

        <h5 class="mb-4 text-uppercase"><i class="fe-calendar"></i> {{__('messages.Edit Reservation Rep')}}</h5>

        <div class="row mt-3">
            </div>
            <div class="col-md-12 mt-3">
                <div class="mb-3">
                    <label for="comment" class="form-label">{{__('messages.comment Rep')}}</label>
                    <textarea id="comment" name="comment" class="form-control">{{$represervation->comment}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="doctor_comment" class="form-label">{{__('messages.Doctor Comment')}}</label>
                    <textarea id="doctor_comment" name="doctor_comment" class="form-control">{{$represervation->doctor_comment}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="secretarial_comment" class="form-label">{{__('messages.Secretarial Comment')}}</label>
                    <textarea id="secretarial_comment" name="secretarial_comment" class="form-control">{{$represervation->secretarial_comment}}</textarea>
                </div>

            </div>

            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-check">
                        <input type="radio" id="slots" name="age" class="form-check-input" value="slots" @if($represervation->slot_id != null) checked @endif>
                        <label class="form-check-label" for="slots">{{__('messages.Solts')}}</label>
                    </div>
                    <div class="mt-3 @if($represervation->slot_id == null) none @endif" id="showSlot" >
                        <select class="form-select" name="slot_id" id="slot_id">
                            <option value="null">{{__('messages.Select')}}</option>
                            @foreach ($slots as $slot)
                            <option value="{{ $slot->id }}" @if($represervation->slot_id == $slot->id)selected @endif >{{$slot->date}} - {{date('h:i a', strtotime($slot->from))}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mt-3">
                        <input type="radio" id="datetime" name="age" class="form-check-input ddd" value="datetime" @if($represervation->slot_id == null) checked @endif>
                        <label class="form-check-label " for="datetime">{{__('messages.Special Datetime')}}</label>
                    </div>
                    <div class="row mt-4 @if($represervation->slot_id != null) none @endif" id="showDatetime" >
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" value="{{$represervation->special_datetime}}">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2" id="saveBtn" value="create"><i class="mdi mdi-content-save"></i>{{ __('messages.Save') }}</button>
            </div>
        </div> <!-- end col -->


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
