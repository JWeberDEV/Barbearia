<?php 

function encrypt_decrypt($text, $method = 'encrypt'){ 
      
  if($method == 'encrypt'){ 
      $text = base64_encode(openssl_encrypt($text, 'AES-256-CBC', '457jk9@','0', '1234567891011121')); 
  }elseif($method == 'decrypt'){ 
      $text = openssl_decrypt(base64_decode($text), 'AES-256-CBC', '457jk9@','0', '1234567891011121'); 
  }                 

  return $text; 
}

?>