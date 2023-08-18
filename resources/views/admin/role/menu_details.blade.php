
@foreach($menuData as $menu)
<optgroup label="{{ $menu['name'] }}">
    @foreach($menu['sub_menu'] as $subMenu)
<option value="{{ $subMenu->id }}">{{ $subMenu->name }}</option>
    @endforeach
</optgroup>
@endforeach
