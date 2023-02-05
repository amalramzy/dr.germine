<form id="adminForm2" name="adminForm" >
    {{-- <input type="hidden" name="reservation_id" id="reservation_id"> --}}
    <input type="hidden" name="child_id" id="child_id" value="{{$child->id}}">
    <input type="hidden" name="is_follow_up" id="is_follow_up" value="1">

        <h5 class="mb-4 text-uppercase"><i class="fe-calendar"></i> {{__('messages.Follow Up Reservation')}}</h5>
        <div class="row">
            <div class="col-md-6">
                <h4 class="header-title mt-5 mt-sm-3">{{__('messages.Type')}}</h4>
                <div class="mt-3">
                    <select class="form-select" name="type" id="type2">
                        <option value="examanation">{{__('messages.Examanation')}}</option>
                        <option value="vaccination">{{__('messages.Vaccination')}}</option>
                        <option value="examanation,vaccination">{{__('messages.Examanation & Vaccination')}}</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4" id="showVaccin2" style="display: none">
                <div class="mt-3">
                    @foreach(\App\Models\Vaccination::where('days','<=', (int)$childDays)->get() as $vaccine)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck1" value="{{$vaccine->id}}" name="vaccin_id[]">
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
                    <textarea id="patient_comment" name="patient_comment" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="secretarial_comment" class="form-label">{{__('messages.Secretarial Comment')}}</label>
                    <textarea id="secretarial_comment" name="secretarial_comment" class="form-control"></textarea>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-check">
                        <input type="radio" id="slots2" name="age" class="form-check-input" value="slots">
                        <label class="form-check-label" for="slots">{{__('messages.Solts')}}</label>
                    </div>
                    <div class="mt-3" id="showSlot2" style="display: none">
                        <select class="form-select" name="slot_id" id="slot_id">
                            <option value="00">{{__('messages.Select')}}</option>
                            @foreach ($slots as $slot)
                            <option value="{{ $slot->id }}">{{$slot->date}} - {{date('h:i a', strtotime($slot->from))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mt-3">
                        <input type="radio" id="datetime2" name="age" class="form-check-input ddd" value="datetime">
                        <label class="form-check-label " for="datetime">{{__('messages.Special Datetime')}}</label>
                    </div>
                    <div class="row mt-4" id="showDatetime2" style="display: none">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" value="" maxlength="50" >
                            </div>
                        </div>

                    </div>
                    {{-- <div class="row mt-4" >
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="arrive_time" class="form-label">{{ __('messages.arrive_time') }}</label>
                                <input type="time" class="form-control" id="arrive_time" name="arrive_time" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="enter_time" class="form-label">{{ __('messages.enter_time') }}</label>
                                <input type="time" class="form-control" id="enter_time" name="enter_time" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="finish_time" class="form-label">{{ __('messages.finish_time') }}</label>
                                <input type="time" class="form-control" id="finish_time" name="finish_time" value="" >
                            </div>
                        </div>

                    </div> --}}
                </div>
            </div>

        </div> <!-- end row -->






      <div class="text-end">
          <button type="submit" class="btn btn-success waves-effect waves-light mt-2" id="saveBtn2" value="create"><i class="mdi mdi-content-save"></i>{{ __('messages.Save') }}</button>
      </div>
  </form>
 