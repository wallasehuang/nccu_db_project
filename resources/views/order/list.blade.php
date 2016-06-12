@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>訂單管理<small>請輸入關鍵字進行查詢</small></h2>
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('order/add')}}'">新增訂單</button></li>
      </ul>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="orderNo">訂單編號</th>
          <th data-column-id="date">訂單日期</th>
          <th data-column-id="student">學生</th>
          <th data-column-id="amount">訂單總金額</th>
          <th data-column-id="user">訂單負責人</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($orders as $order)
        <?php
        $amount =0;
        foreach($order->orderDetail as $detail){
          $amount += $detail->quantity*$detail->product->price;
        }
        ?>
        <tr>
         <td>{{$i}}</td>
         <td>{{$order->orderNo}}</td>
         <td>{{$order->created_at}}</td>
         <td>{{$order->student->name}}</td>
         <td>{{number_format($amount)}}</td>
         <td>{{$order->user->name}}</td>
         <td>{{$order->id}}</td>
         <?php $i++;?>
         @endforeach
       </tbody>
     </table>
   </div>
 </div>
 <span class="errorMsg">
  @foreach ($errors->create->all() as $message)
  {{{$message}}};
  @endforeach
</span>
@endSection
@section('script')
<!-- Data Table -->
<script src="{{asset('vendors/bootgrid/jquery.bootgrid.updated.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //Command Buttons
    var grid = $("#data-table-command").bootgrid({
      css: {
        icon: 'zmdi icon',
        iconColumns: 'zmdi-view-module',
        iconDown: 'zmdi-expand-more',
        iconRefresh: 'zmdi-refresh',
        iconUp: 'zmdi-expand-less'
      },
      formatters: {
        "commands": function(column, row) {
          var view="<button type=\"button\" onclick=\"location.href='{{url('order/detail')}}?id=" + row.id +"'\" class=\"btn btn-icon bgm-cyan waves-effect command-delete waves-circle\">  <span class=\"zmdi zmdi-view-module\"></span></button> ";
          var trash="<button type=\"button\" onclick=\"location.href='{{url('order/del')}}?id=" + row.id +"'\" class=\"btn btn-icon btn-danger waves-effect waves-circle\">  <span class=\"zmdi zmdi-delete\"></span></button> ";
          @if($auth->role>5||$auth->id == $order->userId)
          return view+trash;
          @else
          return view;
          @endif
        }
      }
    });
  });

</script>
@endSection
