
<?php
if(isset($_POST['text'])  && isset($_POST['location'])){
   $File = $_POST['location'];  
   $Handle = fopen($File, 'w') or die("can't open file");
   $Data = $_POST['text']; 
   fwrite($Handle, $Data); 
   fclose($Handle); 
} 

?>