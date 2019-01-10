@for ($i = 0; $i < count($users); $i++)
  <?php
  $row = $users[$i];
  ?>
    <li>
      @component('components.user', ['row' => $row,'options'=>$options])
      @endcomponent
    </li>
@endfor
