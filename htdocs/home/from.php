<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /*the container must be positioned relative:*/
    .custom-select {
      position: relative;
      font-family: Arial;
    }
    
    .custom-select select {
      display: none; /*hide original SELECT element:*/
    }
    
    .select-selected {
      background-color: DodgerBlue;
    }
    
    /*style the arrow inside the select element:*/
    .select-selected:after {
      position: absolute;
      content: "";
      top: 14px;
      right: 10px;
      width: 0;
      height: 0;
      border: 6px solid transparent;
      border-color: #fff transparent transparent transparent;
    }
    
    /*point the arrow upwards when the select box is open (active):*/
    .select-selected.select-arrow-active:after {
      border-color: transparent transparent #fff transparent;
      top: 7px;
    }
    
    /*style the items (options), including the selected item:*/
    .select-items div,.select-selected {
      color: #ffffff;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
      user-select: none;
    }
    
    /*style items (options):*/
    .select-items {
      position: absolute;
      background-color: DodgerBlue;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 99;
    }
    
    /*hide the items when the select box is closed:*/
    .select-hide {
      display: none;
    }
    
    .select-items div:hover, .same-as-selected {
      background-color: rgba(0, 0, 0, 0.1);
    }
    .footer{
        
        height: 31em;
        background-image: url("img/1.jpg");
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    </style>
</head>
<body>

<div class="container">
  <h2>數位學伴</h2>
  <form class="form-horizontal" action="/action_page.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">學生姓名：</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="age">年齡：</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="age" placeholder="Enter age" name="age">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="add">居住地:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="add" placeholder="Enter address" name="add">
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-2" for="grade">成績:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="grade" placeholder="Enter grade" name="grade">
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-2" for="character">大五人格:</label>
      <div class="col-sm-10">          
                 <select class="custom-select" style="width:200px;" name="character">
            <option value="O">經驗開放性</option>
            　<option value="C">嚴謹自律性</option>
            　<option value="E">外向性</option>
            　<option value="A">親和性</option>
            <option value="N">情緒不穩定性</option>
          </select>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">送出</button>
      </div>
    </div>
  </form>
  <div class="footer"></div>
</div>

</body>
</html>
