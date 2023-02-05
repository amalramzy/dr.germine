

@extends('layouts.master',['noCard'=>1])

@section('no-card-content')

    <div >
        @if($reservation)

        <resrvation-page :reservation_id="{{$reservation->id}}" :child_id="{{$reservation->child_id}}" :edit_mode="{{isset($editMode)? 1 :0}}" ></resrvation-page>
        @elseif($child)
{{--            To ADD previous visit--}}
            <resrvation-page  :child_id="{{$child->id}}" ></resrvation-page>

        @else
            <h3 style="text-align:center">{{__('messages.no_active_reservations')}}</h3>
        @endif
    </div>
@endsection
@section('scripts')
<script>

    // $( document ).ready(function() {
    //     $('div:contains("Claim")').hide()
    // });
    // Initiate the Pusher JS library
    let pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        encrypted: true,
        cluster:'eu'
    });
    var channel = pusher.subscribe('reservation-entrance');

    channel.bind('App\\Events\\ReservationEnteranceEvent', function(data) {
        // this is called when the event notification is received...
       // console.log('enter')
        location.reload();
    });
</script>
@endsection
