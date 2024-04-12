<div class="table-responsive product-table">
    <h4>{{$title}}</h4>
    <table class="table table-bordered" id="exams_table">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $index=> $item)
            <tr>
                <td>{{$item->code}}</td>
                <td>{{$item->first_name.' '.$item->last_name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

