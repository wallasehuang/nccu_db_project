@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('order/add')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
        <h4 class="modal-title">訂單管理 > 新增</h4>
      </div>

      <div class="modal-body col-lg-12">

        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*學生</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <select class="chosen" data-placeholder="請選擇學生..." name="studentId">
                @foreach($students as $student)
                <option value="{{$student->id}}" >{{$student->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('order/list')}}'">取消</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" id="id" name="id" value=""/>
    </div>
  </form>
</div>
</div>

@endSection
@section('script')
<script>
  $(document).ready(function(){

    var validator = $("#form").validate({
      rules: {
        studentId:"required",
      },
      messages: {
        studentId: {
          required :"請選擇學生",
        }
      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


</script>
@endSection
