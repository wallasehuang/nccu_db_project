@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container invoice">
  <div class="card">
    <div class="card-header ">
      <h2>訂單明細</h2>
      <span>訂單編號：{{{$order->orderNo}}}</span>
      @if($auth->role>5 || $auth->id == $order->userId)
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('order/detail/add?id='.$order->id)}}'" >新增訂單項目</button></li>
      </ul>
      @endif
    </div>

    <div class="row m-t-25 p-0 m-b-25">
      <div class="col-xs-3">
        <div class="bgm-amber brd-2 p-15">
          <div class="c-white m-b-5">訂購日期</div>
          <h2 class="m-0 c-white f-300">{{{date("Y-m-d",strtotime($order->created_at))}}}</h2>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="bgm-blue brd-2 p-15">
          <div class="c-white m-b-5">學生</div>
          <h2 class="m-0 c-white f-300" >{{{$order->student->name}}}</h2>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="bgm-green brd-2 p-15">
          <div class="c-white m-b-5">聯絡電話</div>
          <h2 class="m-0 c-white f-300">{{{$order->student->phone}}}</h2>
        </div>
      </div>

      <?php
      $amount=0;
      foreach($order->orderDetail as $detail){
        $amount += $detail->quantity*$detail->product->price;
      }
      ?>

      <div class="col-xs-3">
        <div class="bgm-red brd-2 p-15">
          <div class="c-white m-b-5">訂單總金額</div>
          <h2 class="m-0 c-white f-300 text-right">{{number_format($amount)}}</h2>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <table class="table i-table m-t-25 m-b-25">
      <thead class="text-uppercase">
        <th class="c-gray">＃</th>
        <th class="c-gray">商品</th>
        <th class="c-gray">數量</th>
        <th class="c-gray">金額</th>
        @if($auth->role>5 || $auth->id == $order->userId)
        <th class="c-gray">操作</th>
        @endif
      </thead>

      <tbody>
        <?php $i=1;?>
        @foreach($order->orderDetail as $detail)
        <tr>
          <td>{{$i}}</td>
          <td>{{$detail->product->name}}</td>
          <td>{{$detail->quantity}}</td>
          <td>{{number_format($detail->quantity*$detail->product->price)}}</td>
          @if($auth->role>5 || $auth->id == $order->userId)
          <td>
          <button type="button" onclick="location.href='{{url('order/detail/edit?id='.$detail->id)}}'" class="btn btn-icon bgm-teal waves-effect waves-circle">  <span class="zmdi zmdi-edit"></span></button>
          <button type="button" onclick="location.href='{{url('order/detail/del?id='.$detail->id.'&orderId='.$order->id)}}'" class="btn btn-icon btn-danger waves-effect waves-circle">  <span class="zmdi zmdi-delete"></span></button>
          </td>
          @endif
        </tr>
        <?php $i++;?>
        @endforeach
        <tr>
        @if($auth->role>5 || $auth->id == $order->userId)
        <td colspan="4"></td>
          <td class="highlight text-right">總計：{{number_format($amount)}}</td>
        </tr>
        @else
        <td colspan="3"></td>
          <td class="highlight text-right">總計：{{number_format($amount)}}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  <button class="btn btn-float bgm-red m-btn" onclick="location.href='{{URL::to('order/list')}}'" ><i class="zmdi zmdi-arrow-left"></i></button>
</div>


<span class="errorMsg">
  @foreach ($errors->create->all() as $message)
  {{{$message}}};
  @endforeach
</span>
@stop
@section('script')
<!-- Data Table -->
<script type="text/javascript">
  $(document).ready(function(){
  });
</script>
@stop
