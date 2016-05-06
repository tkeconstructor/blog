
<ul class="sidebar-nav ">
    <li class="sidebar-brand">
        <a href="#">
            Trang chủ
        </a>
    </li>

    <li class="sidebar-brand">
        <a href="{{asset('admin/categories')}}">
            Loại câu hỏi
        </a>
    </li>

    <li class="sidebar-brand">
        <a href="{{asset('admin/courses')}}">
            Danh sách khóa học
        </a>
    </li>
    
      <ul class="collapse" id="demo2">
          <li><a href="{{ url('lecturer/question') }}">Danh sách câu hỏi</a></li>
          <li><a href="{{ url('lecturer/question/create') }}">Tạo mới câu hỏi</a></li>
      </ul></li>

</ul>