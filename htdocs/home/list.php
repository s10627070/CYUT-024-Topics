<?php
   
require_once 'php/db.php';


require_once 'php/functions.php';

$datas = get_list_record($_GET['i']);
   
?>
<h2 style="text-align:center">競標紀錄</h2>
<table class="table table-hover" style="text-align:center">
<thead>
<tr>
      <th style="text-align:center">競標者</th>
      <th style="text-align:center">競標商品</th>
      <th style="text-align:center">當前價格</th>
      <th style="text-align:center">更新時間</th>
    </tr>
</thead> 
<tbody> 
  <?php  foreach($datas as $row): ?>
        <tr>
            <td><?= $row['bidder'];?></td>
            <td><?= $row['name'];?></td>
            <td><?= $row['now_price'];?></td>
            <td><?= $row['now_time'];?></td>
        </tr>
  <?php endforeach;?>
  </tbody>
  </table>