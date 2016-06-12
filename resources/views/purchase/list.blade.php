@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>進貨管理<small>請輸入關鍵字進行查詢</small></h2>
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('purchase/add')}}'">進貨</button></li>
      </ul>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="date">進貨日期</th>
          <th data-column-id="product">商品</th>
          <th data-column-id="quantity">數量</th>
          <th data-column-id="amount">進貨成本</th>
          <th data-column-id="user">進貨負責人</th>
          <th data-column-id="id" data-visible="false">id</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($purchases as $purchase)
        <tr>
         <td>{{$i}}</td>
         <td>{{date("Y-m-d",strtotime($purchase->created_at))}}</td>
         <td>{{$purchase->product->name}}</td>
         <td>{{$purchase->quantity}}</td>
         <td>{{number_format($purchase->quantity*$purchase->product->cost)}}</td>
         <td>{{$purchase->user->name}}</td>
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
      }
    });
  });

</script>
@endSection
