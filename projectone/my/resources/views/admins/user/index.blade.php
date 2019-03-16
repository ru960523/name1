@extends('layout.admin')

@section('title','用户的列表页')
@section('content')
<div class="mws-panel grid_8">
                	<div class="mws-panel-header"><span><i class="icon-table"></i>用户列表</div>
                	@if (session('info'))
                	<div class="mws-form-message info">
                		{{session('info')}}
                	</div>
                	@endif

                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        <form action="/admin/user/index" merthod="get">
                        	<div id="DataTables_Table_1_length" class="dataTables_length">
                        		<label>显示
                        			  <select size="1" name="num" aria-controls="DataTables_Table_1">
								      <option value="10" @if($request->num == '10') 
								      selected="selected" @endif>10</option>
								      <option value="25" @if($request->num == '25') 
								      selected="selected" @endif>25</option>
								      <option value="50" @if($request->num == '50') 
								      selected="selected" @endif>50</option>
								      <option value="100" @if($request->num == '100')selected="selected" @endif>100</option>
								      </select>条数据
                        		</label>
                        	</div>
                        	<div class="dataTables_filter" id="DataTables_Table_1_filter">
                        		<label>关键字: 
                        			<input type="text" name='search' value="{{$request->search}}" aria-controls="DataTables_Table_1">
                        		</label>
                        		<button class='btn btn-md btn-info'>搜索</button>
                        	</div>
                    	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row">
	                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 163px;">用户id</th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 217px;">用户名</th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 198px;">邮箱</th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 142px;">手机号</th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 106px;">头像
	                                </th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 106px;">状态
	                                </th>
	                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 106px;">操作
	                                </th>
                                </tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
							@foreach($res as $k => $v) 
                        		<tr class="@if($k % 2 == 1) odd @else even @endif">
                                    <td class="  sorting_1">{{$v->id}}</td>
                                    <td class=" ">{{$v->username}}</td>
                                    <td class=" ">{{$v->email}}</td>
                                    <td class=" ">{{$v->phone}}</td>
                                   	<td class=" "><img src="{{$v->profile}}" alt="" width="100" height="100"></td> 
                                   	<td class=" ">{{$v->status? '已激活' : '未激活' }}</td> 
                                   	<td class=" ">
 									<a href="/admin/user/edit/{{$v->id}}" class="btn btn-md btn-info">修改</a>  
 									<a href="/admin/user/delete/{{$v->id}}" class="btn btn-md btn-danger">删除</a>
 									</td> 
                                </tr>
                                
                               @endforeach
                                </tbody>
                              </table>
                              
                             <style type="text/css">
                             #page li{
                             	float: left;
								height: 20px;
								padding: 0 10px;
								display: block;
								font-size: 12px;
								line-height: 20px;
								text-align: center;
								cursor: pointer;
								outline: none;
								background-color: #444444;
							    border-left: 1px solid rgba(255, 255, 255, 0.15);
							    border-right: 1px solid rgba(0, 0, 0, 0.5);
							    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
							    color: #fff;
							    cursor: pointer;
							    display: block;
                             }
                             #page .active{
                             	background-color: #c5d52b;
                             	color: #323232;
								border: none;
								background-image: none;
								box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
                             }
                             #page a{
								color: #fff;
                             }
                             #page .disabled{
								color: #666666;
					    		cursor: default
							}
								#page ul{
									margin:0px;
								}
							.dataTables_wrapper .dataTables_info {
							    color: #ffffff;
							    float: right;
							    margin-top: 2px;
							    display: block;
							}
                             </style>
                            <div class="dataTables_info" id="DataTables_Table_1_info">
                              <div id="page">
                              {!! $res->appends($request->all())->render() !!}
                              </div>
                            </div>
                          </div>
   					</div>
</div>	
@endsection
@section('js')
	<script type="text/javascript">
	setTimeout(function(){
		$('.mws-form-message').slideUp(2000);
	},3000)
	</script>

@endsection