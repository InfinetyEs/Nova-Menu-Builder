@php

    $menu_class = $active_top_class ?? 'menu-item-has-children';
    $child_class = $active_child_class ?? ' current-menu-item';

    $has_children = count($menu->children) > 0 ? $menu_class : false;
    $is_active = set_active($menu->type == 'route' ? $menu->route : $menu->link, $child_class);

@endphp
<li class="{{$has_children . $is_active}}">
    <a href="{{$menu->link}}" target="{{$menu->target}}">{{ $menu->name }}</a>
    @if($has_children)
        <ul class="sub-menu">
        @foreach ($menu->children as $subMenu)
            @include('front.parts.menu_item', ['menu' => $subMenu])
        @endforeach
        </ul>
    @endif
    {{ $slot ?? '' }}
</li>
