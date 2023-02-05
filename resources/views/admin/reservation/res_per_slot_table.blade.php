@php
$slotsForDay = \App\Models\Slot::where('date',$date)->get()->pluck('id')->toArray();
$reservedSlots = \App\Models\Slot::whereIn('id',array_unique(\App\Models\Reservation::whereIn('slot_id',$slotsForDay)->get()->pluck('slot_id')->toArray()))->paginate(10);


@endphp


<table class="table dt-responsive nowrap w-100  no-footer dtr-inline">
<thead>
            <th>{{__('messages.appointment')}}</th>
            <th>{{__('messages.data')}}</th>

    </thead>
    <tbody>

    @foreach($reservedSlots as $slot)
            <tr>
                <td>{{\Carbon\Carbon::parse($slot->from)->translatedFormat('h:i a');}}</td>
                <td>
                    <table class="table dt-responsive nowrap w-100  no-footer dtr-inline dataTable-res">

                        <thead>
                        <th>{{__('messages.order')}}</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.father')}}</th>
                        <th>{{__('messages.mother')}}</th>
                        <th>{{__('messages.phone')}}</th>
                        <th>{{__('messages.secretarial_comment')}}</th>
                        <th>{{__('messages.patient_comment')}}</th>
                        <th>{{__('messages.arrive_time')}}</th>
                        <th>{{__('messages.enter_time')}}</th>
                        <th>{{__('messages.finish_time')}}</th>
                        <th>{{__('messages.canceled')}}</th>
                        <th>{{__('messages.price')}}</th>
                        <th>{{__('messages.Edit')}}</th>

                        </thead>
                        <tbody>
                        @foreach($slot->reservations as $res)
                        <tr>
                            <td>{{$res->slot_order}}</td>
                            <td>{{$res->child->name}}</td>
                            <td>{{$res->child->user->father}}</td>
                            <td>{{$res->child->user->mother}}</td>
                            <td>{{$res->child->user->phone1}} <br>{{$res->child->user->phone2}}</td>
                            <td class="">{{$res->secretarial_comment}}
                                <button type="button" class="" data-toggle="modal" data-target="#comment{{$res->id}}" data-whatever="@getbootstrap"><i class="mdi mdi-square-edit-outline"></i></button>
                                @include('admin.reservation.modal',['id'=>$res->id,'type'=>'comment'])
                            </td>
                            <td>{{$res->patient_comment}}</td>
                            <td>
                                @if($res->arrive_time)
                                    {{\Carbon\Carbon::parse($res->arrive_time)->translatedFormat('h:i a')}}
                                @else
                                {!! '<form method="POST" action= "'.route('timeArrive.store',[$res->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$res->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>' !!}
                                @endif
                            </td>
                            <td>
                                @if($res->enter_time)
                                    {{\Carbon\Carbon::parse($res->enter_time)->translatedFormat('h:i a')}}
                                @else
                                    {!! '<form method="POST" action= "'.route('timeEnter.store',[$res->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$res->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>' !!}
                                @endif
                            </td>

                            <td>
                                @if($res->finish_time)
                                    {{\Carbon\Carbon::parse($res->finish_time)->translatedFormat('h:i a')}}

                                @endif
                            </td>

                            <td>
                                @if($res->status == "canceled")
                                    {{$res->status}}
                                @else
                                    {!! '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$res->id.'" data-original-title="Cancel" class="cancel cancelReservation"><i class="mdi mdi-close"></i></a>' !!}
                                @endif
                            </td>
                            <td>{{$res->price}}
                                <button type="button" class="" data-toggle="modal" data-target="#price{{$res->id}}" data-whatever="@getbootstrap"><i class="mdi mdi-square-edit-outline"></i></button>
                                @include('admin.reservation.modal',['id'=>$res->id,'type'=>'price'])
                            </td>
                            <td>
                                {!! ' <a href="'.route('reservation.edit',[$res->id]).'" data-toggle="tooltip"  data-id="'.$res->id.'" data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>' !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

    @endforeach
    </tbody>
</table>
