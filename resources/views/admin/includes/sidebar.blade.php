
<ul class="sidebar-nav ">
                <li class="sidebar-brand">
                    <a href="#">
                        Trang chủ
                    </a>
                </li>
                
                <li><a href="#demo1" class="dropdown-toggle" data-toggle="collapse">Danh sách người dùng<b class="caret"></b></a>
              <ul class="collapse" id="demo1">
                  <li><a href="{{ url('lecturer/quiz') }}">Danh sách khóa học</a></li>
              </ul></li>

                <li><a href="#demo2" class="dropdown-toggle" data-toggle="collapse">Ngân hàng câu hỏi  <b class="caret"></b></a>
              <ul class="collapse" id="demo2">
                  <li><a href="{{ url('lecturer/question') }}">Danh sách câu hỏi</a></li>
                  <li><a href="{{ url('lecturer/question/create') }}">Tạo mới câu hỏi</a></li>
              </ul></li>

            </ul>