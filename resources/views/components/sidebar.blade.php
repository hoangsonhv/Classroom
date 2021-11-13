<div class="sidebar sidebar-style-2">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<ul class="nav nav-primary">
				<li class="nav-item active">
					<a class="collapsed">
						<i class="fas fa-home"></i>
						<p>Lớp Học Toán Cô Phượng</p>
						<!-- <span class="caret"></span> -->
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Danh Mục</h4>
				</li>
                <li class="nav-item">
                    <a href="{{ url('attendance') }}">
                        <i class="fas fa-list-ol"></i>
                        <p><b>Điểm Danh</b></p>
                        {{--                        <span class="caret"></span>--}}
                    </a>
                    {{--                    <div class="collapse" id="base5">--}}
                    {{--                        <ul class="nav nav-collapse">--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ url('list-shift') }}">--}}
                    {{--                                    <span class="sub-item">Danh sách các ca học</span>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-users"></i>
                        <p>Học Sinh</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('list-student') }}">
                                    <span class="sub-item">Danh sách học sinh</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

				<li class="nav-item">
					<a data-toggle="collapse" href="#base1">
						<i class="fas fa-layer-group"></i>
						<p>Thời Khóa Biểu</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="base1">
						<ul class="nav nav-collapse">
							<li>
								<a href="{{ url('list-schedule') }}">
									<span class="sub-item">Thời khóa biểu</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item">
					<a data-toggle="collapse" href="#base2">
                        <i class="fas fa-table"></i>
						<p>Môn Học</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="base2">
						<ul class="nav nav-collapse">
							<li>
								<a href="{{ url('list-subject') }}">
									<span class="sub-item">Danh sách môn học</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#base4">
                        <i class="fas fa-clock"></i>
                        <p>Ca Học</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base4">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('list-shift') }}">
                                    <span class="sub-item">Danh sách các ca học</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#base3">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Học Phí</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base3">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('list-tuition') }}">
                                    <span class="sub-item">Danh sách học phí</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
			</ul>
		</div>
	</div>
</div>
