<?php
    function enkripsi($x){
        return base64_encode(openssl_encrypt($x, "AES-256-CBC", "sisteminformasi", 0, "0123456789abcdef"));
    }
    
    function dekripsi($x){
        return openssl_decrypt(base64_encode($x), "AES-256-CBC", "sisteminformasi", 0, "0123456789abcdef");
    }
?>