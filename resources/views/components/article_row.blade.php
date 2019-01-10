@for ($i = 0; $i < count($posts); $i++)
  <?php $row = $posts[$i]; ?>
    <li>
      @component('components.article_box', ['row' => $row])
      @endcomponent
    </li>
@endfor
