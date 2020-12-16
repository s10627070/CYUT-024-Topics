<?php
   
require_once 'php/db.php';


require_once 'php/functions.php';

$bidding = get_bidding($_GET['i']);
   
?>
<?php
        header("refresh: 1;");
        ?>
<div class="col-xs-12" style="margin-top:20px; //border: 2px solid blue;">
						<div class="col-xs-6" ><img src='<?php echo $bidding['image_path']; ?>' class="mx-auto d-block" width="500" height="450"></div>
						<?php if($bidding):?>
						 <div class="col-xs-6"> 
							<div class="thumbnail" align="center" style="font-size:20px">
                              <input type="hidden" id="id" value="<?php echo $bidding['id'];?>">
                              <input type="hidden" id="name" value="<?php echo $bidding['name'];?>">
                              <input type="hidden" id="now_price" value="<?php echo $bidding['now_price'];?>">
                              
                              <p>作品名稱:<?php echo $bidding['name']; ?></p>
                              <p>藝術家:<?php echo $bidding['artist']; ?></p>
                              <p>媒材:<?php echo $bidding['material']; ?></p>
                              <p>創作年代:<?php echo $bidding['year']; ?></p>
                              <p>尺寸:<?php echo $bidding['size']; ?></p>
                              <p>起標價格:<?php echo $bidding['price']; ?></p>
                              <p>目前價格:<?php echo $bidding['now_price']; ?></p>
                              <p>直購價:<?php echo $bidding['tobuy']; ?><button type="button" class="btn btn-danger" id="tobuy" value="<?php
                               echo $bidding['tobuy']; ?>" style="font-size:16px">立即結標</button></p>
                              <p>最高出價者:<?php echo $bidding['bidder_username']; ?></p>
                              <h4 style="font-size:25px; color:red;">截標倒數時間<div data-countdown="<?php echo $bidding['end_time']; ?>" style="font-size:20px"></div></h4>
                              <button type="button" class="btn btn-danger" id="fivehundred" style="font-size:16px" value=500>+500</button>
                            </div>
                         </div>
						 
						<?php else: ?>
							<h3 class="text-center">無此篇文章</h3>
					  <?php endif; ?>
					  
					</div>