 <table class="table table-bordered table-striped">
      <thead>
          <tr>
            <th>Name</th>
            <th>Father name</th>
            <th>Class Section</th>
            <th>Options</th>

          </tr>
      </thead>
      <tbody>
        @if(count($studentdata) > 0)
            @foreach ($studentdata as $key => $value)
                <tr>
                    <td>{{($value->student_name)? $value->student_name : "NA" }}</td>
                    <td>{{($value->father_name) ? $value->father_name : "NA" }}</td>
                    <td>
                    <!-- this is for class  -->
                        {{isset($value->classSec->clas)? $value->classSec->clas : 'NA'}}
                        {{$value->section}}
                    </td>
                    <td>
                        <a href="#">
                            <button type="button" class="btn btn-block btn-info">View</button>
                        </a>
                    </td>
                  </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4"><center>No Record Found</center></td>
            </tr>
        @endif
    </tbody>
</table>
