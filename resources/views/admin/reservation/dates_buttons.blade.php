<div style="text-align: center;margin:10px">
    @for($start=$begining ; $start->lte($end);$start->addDays($step))
        <a href="{{url($url.'?date='.$start->toDateString())}}" class="btn btn-success "> {{$start->dayName}} <br> {{$start->format('d-m-Y')}}</a>
    @endfor
</div>
