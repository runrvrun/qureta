<div class="outertight smimg">
<ul class="block">
  @foreach ($posts as $key=>$row)
    <li>
      @component('components.article_box_small', ['row' => $row])
      @endcomponent
    </li>
    @endforeach
</ul>
</div>
