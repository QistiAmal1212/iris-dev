
@foreach($menuData as $menu)
<optgroup label="{{ $menu['name'] }}">
    @foreach($menu['sub_menu'] as $subMenu)
<option value="{{ $subMenu->id }}" @if($subMenu->role != null) selected @endif>{{ $subMenu->name }}</option>
    @endforeach
</optgroup>
@endforeach
