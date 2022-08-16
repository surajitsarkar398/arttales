@forelse ($users as $no => $users)
   
        <tr>
            <td>{{ $no +1 }}</td>
            <td>
                @if($users->image != null) 
                    <img src="{{ URL('public/images/artistLover') }}/{{ $users->image }}" alt="" height="50px" width="50px">
                @else
                    <img src="public/images/avatar.png" alt="" height="50px" width="50px">
                @endif    
            </td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->email }}</td>
            <td>({{ $users->country_code }}) {{ $users->mobile }}</td>
            <td>
                @php
                    $date = str_replace('/', '-',  $users->dob);
    
                @endphp
                {{ date('d-M-y', strtotime($date)) }}
            </td>
            <td>
                @if($users->status == 0)
                    <a onClick="ChangeStatus({{$users->register_id}}, 1)" style="cursor:pointer">
                        <button class="btn btn-success btn-sm">
                          Active
                        </button>
                    </a>    
                @else
                    <a onClick="ChangeStatus({{$users->register_id}}, 0)" style="cursor:pointer">

                       <button class="btn btn-danger btn-sm">
                        Block
                        </button>
                    </a>    
                @endif()  
            </td>
            <td>
                <a href="{{route('artist.detail',$users->register_id) }}">
                    <i class="fa fa-eye" aria-hidden="true" 
                    style="color:green;"></i>
                </a>
                &nbsp;&nbsp;
               
                <a href="{{route('artist.edit',$users->register_id) }}">
                    <i class="fas fa-edit"  aria-hidden="true"></i>
                </a>
                &nbsp;&nbsp;
            
                <a href="{{route('artist.destroy',$users->register_id) }}">
                    <i class="fa fa-trash" aria-hidden="true"
                    style="color:red"></i>
                </a>
            </td>
        
        </tr>    
  
@empty
  <tr class="text-center">
    <td colspan="8">No record found </td>
  </tr> 
@endforelse 