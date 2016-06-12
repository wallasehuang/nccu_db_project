@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('account/add')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
        <h4 class="modal-title">後台帳號管理 > 新增</h4>
      </div>

      <div class="modal-body col-lg-12">
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*姓名</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm" name="name" placeholder="請輸入姓名">
            </div>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*帳號</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="account" placeholder="請輸入帳號">
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
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*密碼</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼">
            </div>
          </div>
        </div>

        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*確認密碼</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"placeholder="請再次輸入密碼">
            </div>
          </div>
        </div>

        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*身份</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <select class="chosen" data-placeholder="請選擇身份..." name="role">
                <option value="5">一般使用者</option>
                <option value="10">管理者</option>
                <option value="15">系統管理者</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('account/list')}}'">取消</button>
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

    jQuery.validator.addMethod("phonenumber", function(value, element) {
      return this.optional(element) || /^09\d{2}-?\d{3}-?\d{3}$/.test(value) || /^0\d{1}-?\d{4}-?\d{4}$/.test(value);
    },"請輸入正確電話");

    var validator = $("#form").validate({
      rules: {
        name:"required",
        account:{
          required:true,
          remote:"{{URL::to('account/check')}}"
        },
        password:"required",
        phone: {
          required:true,
          phonenumber:true,
        },
        password_confirmation: {
          equalTo: "#password",
        },
      },
      messages: {
        name: {
          required :"姓名為必填",
        },
        account:{
          required:"帳號為必填",
          remote:"帳號不的重複",
        },
        phone:{
          required:"聯絡電話為必填",
          phonenumber:"請輸入正確電話"
        },
        password:{
          required:"密碼為必填",
        },
        password_confirmation:{
          equalTo: "請再次確認密碼",
        }

      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();
  });


</script>
@endSection
