<div class="dataTables_wrapper dt-bootstrap5 no-footer">
    <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
        <thead class="table-light">
            <tr>
                <th>{{__('messages.No')}}</th>
                <th width="200px">{{__('messages.Reservation Date')}}</th>
                {{-- <th>{{__('messages.Diagnostic')}}</th> --}}
                {{-- <th>{{__('messages.Age')}}</th> --}}
                <th>{{__('messages.Weight')}}</th>
                <th>{{__('messages.Height')}}</th>
                <th>{{__('messages.Head Size')}}</th>
                <th>{{__('messages.Temperature')}}</th>
            </tr>
        </thead>

    </table>
</div>
<hr>
<ul>
    <div class="row">
        @if (count(array($child->child_tests)) > 0)
            @foreach($child->child_tests ?? [] as $media)
                {{-- @foreach(json_decode(json_encode($child->child_tests),true) as $images) --}}
                <div class="col-md-12">
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <img class="card-img-top img-fluid" src="{{ $media->getFullUrl() }}">

                            </div>
                            <div class="card-body">
                                <form id="delete-form" action="{{route('delete.child_history',['img'=>$media->id])}}" method="POST">@csrf
                                    {{method_field('DELETE')}}
                                </form>
                                <a href="#" onclick="if(confirm('Do you want to delete?')){
                                                                        event.preventDefault();
                                                                        document.getElementById('delete-form').submit()
                                                                    }else{
                                                                        event.preventDefault();
                                                                    }
                                                                    ">
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </a>
                                {{-- <form id="delete-form" method="POST" action="{{route('child.destroyPhoto',['id'=>$media])}}" >@csrf
                                    {{method_field('DELETE')}}
                                </form>
                                    <a href="#" onclick="if(confirm('Do you want to delete?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit()
                                    }else{
                                        event.preventDefault();
                                    }
                                    ">
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </a> --}}
                                {{-- <a href="javascript:void(0);" class="btn btn-danger waves-effect waves-light">Delete</a> --}}
                            </div>
                        </div>
                    </li>
                </div>
                {{-- @endforeach --}}

            @endforeach
        @endif
    </div>
</ul>

@section('scripts')
<script type="text/javascript">
$(function () {
            // $('#page-tage').html('{{__("messages.Blog")}}');
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
                dom: 'Bfrtip',
                buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                ],
                language: {
                       search: "{{__('messages.Search')}}",
                       url: "/dataTables/i18n/de_de.lang",
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('child.summary',['child'=>$child->id]) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'special_datetime', name: 'special_datetime'},
                    {data: 'weight', name: 'weight'},
                    {data: 'height', name: 'height'},
                    {data: 'head_size', name: 'head_size'},
                    {data: 'temperature', name: 'temperature'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

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


/* When click show user */
$(function () {

$('body').on('click', '#show-reservation', function () {

    var reservationURL = $(this).data('url');
    $.get(reservationURL, function (data) {
        $('#reservationShowModel').modal('show');
        $('#type').text(data.type);
        $('#special_datetime').text(data.special_datetime);
        $('#patient_comment').text(data.patient_comment);
        $('#secretarial_comment').text(data.secretarial_comment);
    })
});

});
//////////////////////////////////
  //slots2
  $(function() {
$("input[name='age']").click(function() {
if ($("#slots2").is(":checked")) {
$("#showSlot2").show();
} else {
$("#showSlot2").hide();
}
});
});
//specialtime2
$(function() {
$("input[name='age']").click(function() {
if ($("#datetime2").is(":checked")) {
$("#showDatetime2").show();
$("#showSlot2").hide();
// window.onload=function(){//from ww  w . j  a  va2s. c  o  m
// var today = new Date().toISOString().split('T')[0];
// document.getElementsByName("date")[0].setAttribute('min', today);
//     }


// var dtToday = new Date();
 
//     var month = dtToday.getMonth() + 1;
//     var day = dtToday.getDate();
//     var year = dtToday.getFullYear();
//     if(month < 10)
//         month = '0' + month.toString();
//     if(day < 10)
//      day = '0' + day.toString();
//     var maxDate = year + '-' + month + '-' + day;
//     // $('#date').attr('min', maxDate);
//     document.getElementsByName("date")[0].setAttribute('min', maxDate);

} else {
$("#showDatetime2").hide();
}
});
});
//vaccin show2
$("#type2").change(function(){
$value = $(this).val();
if($value == "examanation,vaccination" || $value == "vaccination" ){
$("#showVaccin2").show();
}else{
$("#showVaccin2").hide();
}

});

/*------------------------------------------
--------------------------------------------
Create reservation Code
--------------------------------------------
--------------------------------------------*/
$('#saveBtn').click(function (e) {
e.preventDefault();
$(this).html("{{ __('messages.Sending..') }}");

$.ajax({
data: $('#adminForm').serialize(),
url: "{{ route('reservation.store') }}",
type: "POST",
dataType: 'json',
success: function (data) {

    $('#adminForm').trigger("reset");
    $('#saveBtn').html('{{__("messages.Save")}}');
    if(data.success == true){
        var url = "{{ route('visit.current') }}"
        location.href = url;
    }
    // $('#ajaxModel').modal('hide');
    // table.draw();

},
error: function (xhr, status, error) {
    let err = JSON.parse(xhr.responseText);
    let item = err.errors;
    Object.keys(item).forEach(key => {
        console.log(item[key].join(","))
        $('#errors_list').append(
            "<li class='text-white'>"+item[key].join(",")+"</li>"
        );
        $('#danger-alert-modal').modal('show');

    });

    $('#saveBtn').html('{{__("messages.Save")}}');
}
});
});

/*------------------------------------------
--------------------------------------------
Create follow up Code
--------------------------------------------
--------------------------------------------*/
$('#saveBtn2').click(function (e) {
e.preventDefault();
$(this).html("{{ __('messages.Sending..') }}");

$.ajax({
data: $('#adminForm2').serialize(),
url: "{{ route('reservation.store') }}",
type: "POST",
dataType: 'json',
success: function (data) {

    $('#adminForm2').trigger("reset");
    $('#saveBtn2').html('{{__("messages.Save")}}');
    if(data.success == true){
        var url = "{{ route('visit.current') }}"
        location.href = url;
    }
    // $('#ajaxModel').modal('hide');
    // table.draw();

},
error: function (xhr, status, error) {
    let err = JSON.parse(xhr.responseText);
    let item = err.errors;
    Object.keys(item).forEach(key => {
        console.log(item[key].join(","))
        $('#errors_list').append(
            "<li class='text-white'>"+item[key].join(",")+"</li>"
        );
        $('#danger-alert-modal').modal('show');

    });

    $('#saveBtn').html('{{__("messages.Save")}}');
}
});
});

});
  </script>
@endsection


