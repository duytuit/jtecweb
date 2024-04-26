<div class="table-responsive product-table">
    <table class="table table-bordered" id="exams_table">
        <thead>
            <tr>
                <th width="3%"><input type="checkbox" class="greyCheck checkAll" data-target=".checkSingle" /></th>
                <th>TT</th>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Công đoạn</th>
                <th>Kỳ thi</th>
                <th>Ngày thi</th>
                <th>Tổng câu</th>
                <th>Trả lời đúng</th>
                <th>Điểm</th>
                <th>Thời gian làm bài</th>
                <th>Trạng thái</th>
                {{-- <th>Kết quả</th> --}}
                <th>Người duyệt</th>
                <th width="100">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $code = 0;
                $cycle_name = 0;
                $check = 0;
            @endphp
            @foreach ($lists as $index => $item)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="greyCheck checkSingle" />
                    </td>
                    <td>{{ $index + 1 }}</td>
                    @if ($cycle_name != $item->cycle_name)
                        @php
                            $check = 1;
                            $cycle_name = $item->cycle_name;
                        @endphp
                    @else
                        @php
                            $check = 0;
                        @endphp
                    @endif
                    @if ($code != $item->code)
                        @php
                            $check = 1;
                            $code = $item->code;
                        @endphp
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->sub_dept == 1 ? 'Cắm' : '' }}</td>
                    @else
                        <td colspan="3"></td>
                    @endif
                    <td>{{ $item->cycle_name }}</td>
                    <td>{{ date('d-m-Y', strtotime(@$item->create_date)) }}</td>
                    <td>{{ $item->total_questions }}</td>
                    <td>{{ $item->results }}</td>
                    <td>{{ $item->scores }}</td>
                    <td>{{ $item->counting_time }}</td>
                    <td>
                        @if ($item->status)
                            <span class="badge badge-success font-weight-100">Đạt</span>
                        @else
                            <span class="badge badge-warning">Chưa Đạt</span>
                        @endif
                    </td>
                    {{-- @if ($cycle_name == $item->cycle_name && $check == 1)
                        <td rowspan="{{ $lists->where('code', $code)->where('cycle_name', $cycle_name)->count() }}"
                            style="vertical-align: middle;">
                            @php
                                $pass = $lists
                                    ->where('code', $code)
                                    ->where('cycle_name', $cycle_name)
                                    ->where('status', 1)
                                    ->count();
                            @endphp
                            @if ($pass >= 2)
                                <span class="badge badge-info font-weight-100">Đỗ</span>
                            @else
                                <span class="badge badge-secondary">Thi lại</span>
                            @endif
                        </td>
                    @endif --}}
                    <td>

                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
