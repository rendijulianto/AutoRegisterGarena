<?php 
include 'curl.php';
//Default Password : garut123
function random($panjang)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';   
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter{
            $pos};
    }
    return $string;
}
function register ($username,$email) {
    $post_data = "username=$username&email=$email%40gmail.com&password=46d34a7ec73f7247f02d5193bc2bfe6afa021fccb0a781d4e54e5270451b4b784c46815d803c42c8ce8bebbca20ba232d60e8014afec15b05654024f2a044c81c7083196f3ff2f581cd4b1edad786e868751a00075a719386128635bb2b3c143828b3a3eff3ba2a9a63a3863bb356ce44f8ea97cea7b3eb9b526f964794092ad&location=ID&redirect_uri=https%3A%2F%2Fsso.garena.com%2Fui%2Flogin%3Fapp_id%3D10100%26redirect_uri%3Dhttps%253A%252F%252Faccount.garena.com%252F%253Flocale_name%253DID%26locale%3Did-ID&locale=id-ID&format=json&id=1603481318723";
    $curl = curl('https://sso.garena.com/api/register', $post_data);
    return $curl;
}
for($i = 0; $i < 99999; $i++) {
$email = random(10);
$username = random(7);
$dataRegister = register($username,$email);
$check_error = fetch_value($dataRegister, '"', '":');
if($check_error  == "error") {
    echo "[-] => Register Gagal \n";
    echo "[-] => Karena Terkena Captcha \n";
} else {
    $file = fopen("akun_garena.txt", "a");
    fwrite($file,"$email@gmail.com|$username|garut123 \r\n");
    fclose($file);
    echo "[+] => Register Berhasil \n";
}
}