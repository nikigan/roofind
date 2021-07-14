<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        @foreach($fields as $field)
            <th>{{$field}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
            </td>
            <td><span class="badge bg-danger">55%</span></td>
        </tr>
    @endforeach
    </tbody>
</table>
