@extends('admin.layouts.default')

@section('stylesheet')
	<link rel="stylesheet"
          href="{{URL::asset('table/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}"/>
@stop

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
	            <div class="col-lg-6">
	                <h1>Khóa học {{$course->name}}</h1>
	            </div>
            </div>
        </div>
        <hr/>
        <div class="row">
        	<form method="POST" action="{{asset('admin/courses/'.$course->id)}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">        		
				<div class="col-md-5 col-sm-5" align="center">
                    <label>Giảng viên trong khóa học</label>
                    <table class="table table-striped table-bordered table-hover" id="connect_lecturers">
                        <thead>
                            <th>Tài khoản</th>
                            <th>Họ và tên</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($lecturers_connect as $lecturer_connect)
                            <tr>
                                <td>{{$lecturer_connect->username}}</td>
                                <td>{{$lecturer_connect->name}}</td>
                                <td>
                                    <input type="checkbox" name="disconnect_lecturers[]" value="{{$lecturer_connect->id}}" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2 col-sm-2" align="center">
                    <label>Hành động</label>
                    <br/><br/><br/><br/>
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="fa fa-arrows-h"></i>
                    </button>
                </div>
                <div class="col-md-5 col-sm-5" align="center">
                    <label align="center">Giảng viên ngoài khóa học</label>
                     <table class="table table-striped table-bordered table-hover" id="disconnect_lecturers">
                        <thead>
                            <th>Tài khoản</th>
                            <th>Họ và tên</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($lecturers_disconnect as $lecturer_disconnect)
                            <tr>
                                <td>{{$lecturer_disconnect->username}}</td>
                                <td>{{$lecturer_disconnect->name}}</td>
                                <td>
                                    <input type="checkbox" name="connect_lecturers[]" value="{{$lecturer_disconnect->id}}" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        	</form>
        </div>
    </div>
@stop

@section('script')

	<script src="{{URL::asset('table/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('table/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('table/datatables-responsive/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#disconnect_lecturers').DataTable({
                responsive: true,
                language: {
                    "sProcessing":   "Đang xử lý...",
                    "sLengthMenu":   "Xem _MENU_ ",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                    "sInfo":         "",
                    "sInfoEmpty":    "",
                    "sInfoFiltered": "(được lọc từ _MAX_ bản ghi)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Tìm kiếm:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                    }
                },
            });

            $('#connect_lecturers').DataTable({
                responsive: true,
                language: {
                    "sProcessing":   "Đang xử lý...",
                    "sLengthMenu":   "Xem _MENU_",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                    "sInfo":         "",
                    "sInfoEmpty":    "",
                    "sInfoFiltered": "(được lọc từ _MAX_ bản ghi)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Tìm kiếm:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                    }
                },
            });
        });

    </script>
@stop