@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('student/add')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
      <h4 class="modal-title">學生管理 > 新增</h4>
      </div>

      <div class="modal-body col-lg-12">
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*學號</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm" name="studentNo" placeholder="請輸入學號">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*姓名</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="name" placeholder="請輸入姓名">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*聯絡電話</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="phone" placeholder="請輸入聯絡電話">
            </div>
          </div>
        </div>
      </div>


      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('student/list')}}'">取消</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" id="id" name="id" value=""/>
    </div>
  </form>
</div>
</div>

@endSection
@section('script')
<script src="{{URL::asset('js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script>
  $(document).ready(function(){

    jQuery.validator.addMethod("phonenumber", function(value, element) {
      return this.optional(element) || /^09\d{2}-?\d{3}-?\d{3}$/.test(value) || /^0\d{1}-?\d{4}-?\d{4}$/.test(value);
    },"請輸入正確電話");

    var validator = $("#form").validate({
      rules: {
        studentNo:{
          required:true,
          digits:true,
          remote:"{{URL::to('student/check')}}"
        },
        name:"required",
        phone:{
          required:true,
          phonenumber:true,
        }
      },
      messages: {
        studentNo:{
          required:"學號為必填",
          digits:"學號必須為數字",
          remote:"學號不能重複"
        },
        name: {
          required :"學生姓名為必填",
        },
        phone:{
          required:"聯絡電話為必填",
          phonenumber:"請輸入正確的電話"
        }
      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


</script>
@endSection
