@extends('layout.default')
@section('title','雜貨店管理系統')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>學生管理<small>請輸入關鍵字進行查詢</small></h2>
      <ul class="actions">
        <li ><button type="button" class="btn btn-info btn-lg" onClick="location.href='{{URL::to('student/add')}}'">新增學生</button></li>
      </ul>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
      <thead>
        <tr>
          <!-- <th data-column-id="id" data-type="numeric" data-visible="false">編號</th> -->
          <th data-column-id="num" data-type="numeric">#</th>
          <th data-column-id="studentNo">學號</th>
          <th data-column-id="name">姓名</th>
          <th data-column-id="phone">聯絡電話</th>
          <th data-column-id="id" data-visible="false">id</th>
          <th data-column-id="commands" data-formatter="commands" data-sortable="false">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;?>
        @foreach($students as $student)
        <tr>
         <td>{{$i}}</td>
         <td>{{$student->studentNo}}</td>
         <td>{{$student->name}}</td>
         <td>{{$student->phone}}</td>
         <td>{{$student->id}}</td>
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
          var edit="<button type=\"button\" onclick=\"edit(this);\" class=\"btn btn-icon bgm-teal command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button>";
          return edit;
        }
      }
    });
  });

  function edit(obj){
    var id = $(obj).data('row-id');
    window.location.replace("{{{URL::to('student/edit')}}}"+"?id="+id);
  }

</script>
@endSection
