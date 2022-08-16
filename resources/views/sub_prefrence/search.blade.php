@forelse($subPreferenceList as $no => $prefrence)
 <tr>    
    <td>{{ $no +1 }}</td>
    <td>{{ $prefrence->preferences_name }}</td>
    <td>{{ $prefrence->preference_subcategories_name }}</td>
    <td>
       
        <a href="{{route('sub-prefrence.edit',$prefrence->preference_subcategories_id) }}">
            <i class="fas fa-edit"  aria-hidden="true"></i>
        </a>
        &nbsp;&nbsp;
    
        <a href="{{route('sub-prefrence.destroy',$prefrence->preference_subcategories_id) }}">
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