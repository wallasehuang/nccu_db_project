@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container invoice">
  <div class="card">
    <div class="card-header ">
      <h2>庫存管理</h2>
    </div>

    <div class="clearfix"></div>

    <table class="table i-table m-t-25 m-b-25">
      <thead class="text-uppercase">
        <th class="c-gray">＃</th>
        <th class="c-gray">商品</th>
        <th class="c-gray">庫存數量</th>
      </thead>

      <tbody>
        <?php $i=1;?>
        @foreach($products as $product)
        <tr>
          <td>{{$i}}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->purchase->sum('quantity')-$product->orderDetail->sum('quantity')}}</td>
        </tr>
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
@stop
@section('script')
<!-- Data Table -->
<script type="text/javascript">
  $(document).ready(function(){
  });
</script>
@stop
