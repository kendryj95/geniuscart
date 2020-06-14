@if(Auth::guard('admin')->check())

<option data-href="" value="">Select City</option>
@foreach($cat->city as $sub)
<option data-href="{{ route('admin-neigh-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->city_name }}</option>
@endforeach

@else 

<option data-href="" value="">Select City</option>
@foreach($cat->city as $sub)
<option data-href="{{ route('vendor-neigh-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->city_name }}</option>
@endforeach
@endif