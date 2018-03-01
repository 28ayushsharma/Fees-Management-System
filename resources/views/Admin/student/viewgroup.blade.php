<table class="table table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Father name</th>
            <th>Class &amp; Section</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentdata as $student)
            <tr>
                <td>{{$student->student_name}}</td>
                <td>{{$student->father_name}}</td>
                <td>
                    @if(!empty($student->section))
                        {{$student->section}}
                    @else
                        No Section
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
