<?php
   
require_once 'php/db.php';


require_once 'php/functions.php';

$datas = get_list_record($_GET['i']);
   
?>

<h2 style="text-align:center; margin-top:20px;">競標紀錄</h2>
<div id="npclist">
<table class="table table-hover" style="text-align:center">
<thead>
<tr>
      <th class="col-xs-4" style="text-align:center">競標者</th>
      <th class="col-xs-4" style="text-align:center">當前價格</th>
      <th class="col-xs-4" style="text-align:center">競標時間</th>
    </tr>
</thead> 
<tbody> 
  <?php  foreach($datas as $row): ?>
        <tr>
            <td><?= $row['bidder'];?></td>
            <td><?= $row['now_price'];?></td>
            <td><?= $row['now_time'];?></td>
        </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<script>
    setInterval(function() {
        $("#npclist").load(location.href+" #npclist>*");
      }, 500);
</script>
