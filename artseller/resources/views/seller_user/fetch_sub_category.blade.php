 <select name="subcategory" class="form-control">
    <option value="" selected disabled>Select</option>

        @foreach($prefrencesublist as  $prefrencesub)

            @if(!empty($artist))
                <option  @if($prefrencesub->preference_subcategories_id == $artist->sub_category_name) selected @endif value="{{ $prefrencesub->preference_subcategories_id }}">{{$prefrencesub->    preference_subcategories_name }}</option>
            @else
                <option value="{{ $prefrencesub->preference_subcategories_id }}">{{$prefrencesub->preference_subcategories_name }}</option>
            @endif    
        @endforeach
</select>