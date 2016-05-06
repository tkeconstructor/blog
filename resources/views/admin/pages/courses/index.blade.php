@extends('admin.layouts.default')

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
	            <div class="col-lg-6">
	                <h1>Danh sách khóa học</h1>
	            </div>
	            <div class="col-lg-6">
	                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Tạo mới</button>
	            </div>
            </div>
            <!-- Trigger the modal with a button -->
			
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Tạo khóa học mới</h4>
			      </div>
			      <form method="POST" action="{{asset('admin/courses')}}">
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
                                    Mã
                                </label>
                                <input type="text" class="form-control" name="code" />
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
						<th>Mã</th>
						<th>Mô tả</th>
						<th>Tùy chọn</th>
					</thead>
					<tbody>
						@foreach($courses as $course)
						<tr>
							<td>
								<div id="{{'labelName'.$course->id}}" >{{$course->name}}</div>
								<input type="text" class="form-control" id="{{'name'.$course->id}}" value="{{$course->name}}" style="display: none"/>
							</td>
							<td>
								{{$course->code}}
							</td>
							<td>
								<div id="{{'labelDesc'.$course->id}}" >{{$course->desc}}</div>
								<input type="text" class="form-control" id="{{'desc'.$course->id}}" value="{{$course->desc}}" style="display: none"/>
							</td>
							<td>
								<button class="btn btn-circle btn-success" id="{{'btn-edit'.$course->id}}" onclick="{{'showForm('.$course->id.')'}}">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-circle btn-primary" id="{{'btn-save'.$course->id}}" style="display: none" onclick="{{'update('.$course->id.')'}}">
									<i class="fa fa-save"></i>
								</button>
								<a class="btn btn-circle btn-primary" href="{{asset('admin/courses/'.$course->id)}}">
									<i class="fa fa-users"></i>
								</a>
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
			url = 'courses/update';
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
	                alert("Không update được khóa học");
	            }
	        });

		}
	</script>
@stop