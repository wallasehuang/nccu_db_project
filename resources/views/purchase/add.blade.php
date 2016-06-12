@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
   <form class="form-horizontal" method="post" id="form" action="{{URL::to('purchase/add')}}">
    <div class="modal-content row">
      <div class="modal-header col-lg-12">
        <h4 class="modal-title">進貨管理 > 進貨</h4>
      </div>

      <div class="modal-body col-lg-12">
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*進貨商品</label>
          <div class="col-lg-7">
            <div class="fg-line">
              <select class="chosen" data-placeholder="請選擇進貨商品..." name="productId">
              @foreach($products as $product)
              <option value="{{$product->id}}" >{{$product->name}}</option>
              @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-2">
            <label class="control-label quantity"></label>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-2 col-lg-offset-1 control-label">*進貨數量</label>
          <div class="col-lg-8">
            <div class="fg-line">
              <input type="text" class="form-control input-sm"  name="quantity" placeholder="進貨數量">
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer col-lg-12">
        <button type="submit" class="btn btn-success">送出</button>
        <button type="button" class="btn btn-default" onClick="location.href='{{URL::to('purchase/list')}}'">取消</button>
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

    $("input[name='quantity']").TouchSpin({
        min: 0,
        max: 9999,
        step: 1,
        decimals: 0,
        boostat: 10,
        maxboostedstep: 100,
        prefix: '<i class="zmdi zmdi-money" aria-hidden="true"></i>'
      });

    var validator = $("#form").validate({
      rules: {
        productId:"required",
        quantity:{
          required:true,
          digits:true,
          min:0,
        }
      },
      messages: {
        productId: {
          required :"請選擇商品",
        },
        quantity:{
          required:"請輸入數量",
          digits:"請輸入數字",
          min:"數字請大於0"
        }
      }
    });

    $('#form').removeAttr('novalidate');
    $('#form').validate();

    inventory($("[name='productId']"));

    $("[name='productId']").change(function(){
      inventory($(this));
    });
  });

  function inventory(obj){

    <?php foreach($products as $product){ ?>
      if(obj.children('option:selected').val() == <?= $product->id?>){
        $('label.control-label.quantity').text('剩餘數量：<?= $product->purchase->sum('quantity')-$product->orderDetail->sum('quantity')?>');
        $('#inventory').val(<?= $product->purchase->sum('quantity')-$product->orderDetail->sum('quantity')?>);

      }
      <?php } ?>
    }


</script>
@endSection
