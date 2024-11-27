<!DOCTYPE html>
<html lang="ja">

<body>
    {{ $name }}先生<br>
    <br>
    {{ $email}}
    <br>
    {{ $password }}
    <br>
    この度は、ドクターズレシピにお申し込み頂きありがとうございます。<br>
    <br>
    先生の確認が終わり、承認させて頂きました。<br>
    承認までお時間を頂き、ありがとうございました。<br>
    <br>
    さっそくログインして、ご利用を開始してください。<br>
    ≪ログイン≫<br>
    http;//localhost:8000/login<br>
    <br>
    <div class="container">
      {!!$qrCode!!}
    </div>
</body>

</html>
