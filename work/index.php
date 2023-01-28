<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>問い合わせフォーム</title>
  </head>
  <body>
    <p><お問い合わせフォーム></p>
    <form id="contact-form">
      <dl>
        <dt>氏名【必須】</dt>
        <dd>
            <input type="text" name="name" size="7" maxlength="51" required>
        </dd>
        <dt>性別【必須】</dt>
        <dd>
          <input type="radio" name="gender" value="0" required checked>男性
          <input type="radio" name="gender" value="1" required>女性
          <input type="radio" name="gender" value="2" required>その他
        </dd>
        <dt>生年月日【必須】</dt>
        <dd>
            <input type="date" name="birthday" required>
        </dd>
        <dt>〒郵便番号【必須】</dt>
        <dd>
          <input type="text" name="postnumber" required>
        </dd>
        <dt>住所【必須】</dt>
        <dd>
          <input type="text" name="address" maxlength="201" required>
        </dd>
        <dt>電話番号【任意】</dt>
        <dd>
          <input type="tel" name="phone">
        </dd>
        <dt>メールアドレス【任意】</dt>
        <dd>
          <input type="text" name="email" maxlength="201">
        </dd>
        <dt>お問い合わせの種類【必須】</dt>
        <dd>
          <select name="question1" required>
            <option value="0">新規お取引のご相談</option>
            <option value="1">会社資料請求</option>
            <option value="2">セミナーのご相談</option>
            <option value="3">プログラムのご相談</option>
            <option value="4">広報・取材依頼などのお問い合わせ</option>
            <option value="5">その他</option>
        </select>
        </dd>
        <dt>相談内容【必須】</dt>
        <dd>
          <textarea name="question2" rows="10" cols="50" maxlength="1001" required></textarea>
        </dd>
      </dl>
      <input type="submit" value="送信" class="send-btn" id="submit">
    </form>
    <p class="contact-result"></p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
    $('#contact-form').submit(function(event){
        event.preventDefault();
        var $form = $(this);
        var $button = $('#submit');
        $.ajax({
            url:"send.php",
            type:'POST',
            data: $form.serialize(),
            timeout:1000000,
            beforeSend: function(xhr, settings) {
                $button.attr('disabled', true);
            },
            complete: function(xhr, textStatus) {
                $button.attr('disabled', false);
            }
        }).done(function(data, textStatus, jqXHR){
            // 成功の場合処理
            // $form[0].reset();
            $(".contact-result").text(data);
            $(".contact-result").slideToggle(200);
            $(".contact-result").delay(3000).slideToggle(200);
        }).fail(function(jqXHR, textStatus, errorThrown){
            // エラーの場合処理
            $(".contact-result").text("エラーが発生しました。ステータス：" + jqXHR.status);
            $(".contact-result").slideToggle(100);
            $(".contact-result").delay(3000).slideToggle(200);
        });
    });
</script>
  </body>
</html>