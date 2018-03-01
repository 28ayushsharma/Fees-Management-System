 <table class="table table-bordered table-striped">
      <thead>
          <tr>
            <th width="5">S.N0.</th>
            <th>Name</th>
            <th>Father name</th>
            <th>Class Section</th>
            <th width="25%" colspan="3">Options</th>

          </tr>
      </thead>
      <tbody>
        @if(count($studentdata) > 0)
            @foreach ($studentdata as $key => $value)
                @php
                    $serial_no = $key+1;
                @endphp
                <tr>
                    <td>
                       {{$serial_no}} 
                    </td>
                    <?php /* @if(empty($value->gid))
                        <td>
                            <div class="checkbox">
                              <label>
                                <input data-name="{{$value->student_name}}" type="checkbox" class="stdcheck" value="{{CustomHelper::getEncrypted($value->id)}}">
                              </label>
                            </div>
                        </td>
                    @else
                        <td>Already Grouped</td>
                    @endif
                    */ ?>
                    <td>{{($value->student_name)? $value->student_name : "NA" }}</td>
                    <td>{{($value->father_name) ? $value->father_name : "NA" }}</td>
                    <td>
                    <!-- this is for class  -->
                        {{isset($value->classSec->clas)? $value->classSec->clas : 'NA'}}
                        {{$value->section}}
                    </td>
                    <td>
                        <a href="{{route('Student.view', CustomHelper::getEncrypted($value->id))}}">
                            <button type="button" class="btn btn-block btn-info">View</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('Student.edit', CustomHelper::getEncrypted($value->id))}}">
                            <button type="button" class="btn btn-block btn-primary">Edit</button>
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
