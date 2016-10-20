<?php
  if(isset($_POST['clicked'])){
  echo <<<_END1
    <script>
    function clicks(){
      document.getElementById('clickText').innerHTML = "Clicked"
      }
      </script>
      <p id="clickText">Click this button</p>
      <button type="button" onclick="clicks()" value"Button">Button</button>
_END1;
  }
  else{
    echo <<<_END2
    <p>Click button</p>
    <form action="aaaa.php" method="POST">
    <input type="hiden" name="clicked" value="true">
    <input type="submit" value="Button">
_END2;
  }
?>
