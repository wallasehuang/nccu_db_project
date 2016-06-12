@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>後台帳號管理<small>請輸入關鍵字進行查詢</small></h2>
      @if($auth->role>5)
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg"onClick="location.href='{{URL::to('account/add')}}'">新增帳號</button></li>
      </ul>
      @endif
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="account">帳號</th>
          <th data-column-id="name">暱稱</th>
          <th data-column-id="phone">電話</th>
          <th data-column-id="role">身份</th>
          <th data-column-id="state">狀態</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="state_id" data-visible="false">state</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($users as $user)
        <tr>
         <td>{{$i}}</td>
         <td>{{$user->account}}</td>
         <td>{{$user->name}}</td>
         <td>{{$user->phone}}</td>
         @if($user->role===5)
         <td>一般使用者</td>
         @elseif($user->role===10)
         <td>管理者</td>
         @else
         <td>系統管理者</td>
         @endif
         @if($user->status===1)
         <td>啟用</td>
         @else
         <td>停用</td>
         @endif
         <td>{{$user->id}}</td>
         <td>{{$user->status}}</td>
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
          var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
          var stateOn="<button type=\"button\" onclick=\"state(this);\" class=\"btn btn-success btn-icon waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-lock-open\"></span></button>";
          var stateOff="<button type=\"button\" onclick=\"state(this);\" class=\"btn btn-danger btn-icon waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-lock-outline\"></span></button>";


          if({{{$auth->role}}}>5){
            if({{{$auth->id}}}==row.id){
              return edit;
            }else{
              if(row.state_id==1){
                return edit+stateOn;
              }else{
                return edit+stateOff;
              }
            }
          }else{
           if({{{$auth->id}}}==row.id){
            return edit;
          }
        }

      }
    }
  });
});

function edit(obj){
  var id = $(obj).data('row-id');
  window.location.replace("{{{URL::to('account/edit')}}}"+"?id="+id);
}

function state(obj){
  var id = $(obj).data('row-id');
  $.ajax('{{URL::to('/account/state')}}',{
    cache:false,
    type:"post",
    data:{
      '_token' : '{{ csrf_token() }}',
      'id' : id,
    },
    dateType:"json"
  }).done(function(json){
    console.log("success");
    location.reload();
  }).error(function(response){
    console.log("error");
    $('.errorMsg').html(response.responseText);

  });
}

</script>
@endSection
