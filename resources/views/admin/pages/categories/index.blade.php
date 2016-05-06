@extends('admin.layouts.default')

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Danh mục loại câu hỏi</h1>
            </div>
            <!-- Trigger the modal with a button -->
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Tạo mới</button>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Tạo mới loại câu hỏi</h4>
			      </div>
			      <form method="POST" action="{{asset('admin/categories')}}">
			      <input type="hidden" name="_token" value="{{ csrf_token() }}">
			      <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group connected-group">
                                <label class="control-label">
                                    Tên
                                </label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group connected-group">
                                <label class="control-label">
                                    Mô tả
                                </label>
                                <input type="text" class="form-control" name="desc" />
                            </div>
                        </div>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			        <button type="submit" class="btn btn-primary">Tạo</button>
			      </div>
			      </form>
			    </div>

			  </div>
			</div>
			<div class="col-lg-12">
				<table class="table table-striped" id="OMTStaffTable">
					<thead>
						<th>Tên</th>
						<th>Mô tả</th>
						<th>Tùy chọn</th>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>
								<div id="{{'labelName'.$category->id}}" >{{$category->name}}</div>
								<input type="text" class="form-control" id="{{'name'.$category->id}}" value="{{$category->name}}" style="display: none"/>
							</td>
							<td>
								<div id="{{'labelDesc'.$category->id}}" >{{$category->desc}}</div>
								<input type="text" class="form-control" id="{{'desc'.$category->id}}" value="{{$category->desc}}" style="display: none"/>
							</td>
							<td>
								<button class="btn btn-circle btn-success" id="{{'btn-edit'.$category->id}}" onclick="{{'showForm('.$category->id.')'}}">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-circle btn-primary" id="{{'btn-save'.$category->id}}" style="display: none" onclick="{{'update('.$category->id.')'}}">
									<i class="fa fa-save"></i>
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
        </div>
    </div>
@stop

@section('script')
	<script type="text/javascript">
		function showForm(id){
			$("[id^='labelName']").show();
			$("[id^='labelDesc']").show();
			$("[id^='btn-edit']").show();
			$("[id^='name']").hide();
			$("[id^='desc']").hide();
			$("[id^='btn-save']").hide();

			$("#labelName"+id).hide();
			$("#labelDesc"+id).hide();
			$("#btn-edit"+id).hide();
			$("#name"+id).show();
			$("#desc"+id).show();
			$("#btn-save"+id).show();
		}

		function update(id){
			url = 'categories/update';
			var name = $('#name'+id).val() , desc = $('#desc'+id).val();
	        $.ajax({
	            url      : url,
	            type     : "POST",
	            data     : {
	                        'id':id,
	                        'name': name,
	                        'desc': desc
	                        },
	            success  : function (data){
	                    if(data==1){
	                    	$("#labelName"+id).html(name);
							$("#labelDesc"+id).html(desc);
							$('#name'+id).val(name);
							$('#desc'+id).val(desc);
	                    }
	                    $("[id^='labelName']").show();
						$("[id^='labelDesc']").show();
						$("[id^='btn-edit']").show();
						$("[id^='name']").hide();
						$("[id^='desc']").hide();
						$("[id^='btn-save']").hide();
	                },
	            error:function(){ 
	                alert("Không update được loại câu hỏi");
	            }
	        });

		}
	</script>
@stop