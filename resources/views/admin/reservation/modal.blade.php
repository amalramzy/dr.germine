
@if ($type == 'comment')
<div class="modal fade" id="{{$type.$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add_comment')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="get" action="{{route('visit.current')}}">
            @csrf
            <input name="id" type="hidden" value="{{$id}}"/>
            <div class="form-group">
              <label for="message-text" class="col-form-label">{{__('messages.comment')}}:</label>
              <textarea name="comment" class="form-control" id="message-text" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@elseif ($type == 'price')

<div class="modal fade" id="{{$type.$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add_price')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="get" action="{{route('visit.current')}}">
            @csrf
            <input name="id" type="hidden" value="{{$id}}"/>
            <div class="form-group">
              <label for="message-text" class="col-form-label">{{__('messages.price')}}:</label>
              <input class="form-control" type="number" name='price' required/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>

@elseif ($type == 'notification')

<div class="modal fade" id="{{$type}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('messages.send message')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="get" action="" id="#notification">
            <div class="form-group">
                <label for="message-text" class="col-form-label">{{__('messages.title_notify')}}:</label>
                <input name="title" class="form-control" id="message-text" required>
              </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">{{__('messages.subject')}}:</label>
              <textarea name="description" class="form-control" id="message-text" required></textarea>
            </div>
            <div class="modal-footer">
                <button id='close' type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button id="submit" type="submit" class="btn btn-primary">{{__('messages.send')}}</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>

@endif

