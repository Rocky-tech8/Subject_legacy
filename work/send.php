<?php
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST"){
    // ブラウザからHTMLページを要求された場合
    header("HTTP/1.1 404 Not Found");
    exit ();//処理の終了
}
// データベースに接続する
$pdo = new PDO('mysql:host=db;dbname=sampledb', 'dbuser', '1234');
$pdo->query('SET NAMES utf8;');


// テーブルが存在しなかったら実行
$sql = 'SHOW TABLE LIKE "dataList";';
if(!($pdo->prepare($sql)->execute())){

    // テーブル作成
    $sql = "CREATE TABLE dataList (id INTEGER(11) AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, gender INTEGER(1) NOT NULL, birthday DATE NOT NULL, postNumber INTEGER(7) NOT NULL, address VARCHAR(200) NOT NULL, phone VARCHAR(11), email VARCHAR(200), question1 INTEGER(1) NOT NULL, question2 TEXT(1000) NOT NULL, PRIMARY KEY(id));";
    $pdo->prepare($sql)->execute();
};

// 実行したいSQL文をセットする
$stmt = $pdo->prepare('INSERT INTO dataList(name, gender, birthday, postnumber, address, phone, email, question1, question2) VALUES(:name, :gender, :birthday, :postnumber, :address, :phone, :email, :question1, :question2)');

// SQLに対してパラメータをセットする
$stmt->bindValue(':name', $_POST["name"],PDO::PARAM_STR);
$stmt->bindValue(':gender', $_POST["gender"],PDO::PARAM_INT);
$stmt->bindValue(':birthday', $_POST["birthday"],PDO::PARAM_STR);
$stmt->bindValue(':postnumber', $_POST["postnumber"],PDO::PARAM_INT);
$stmt->bindValue(':address', $_POST["address"],PDO::PARAM_STR);
$stmt->bindValue(':phone', $_POST["phone"],PDO::PARAM_STR);
$stmt->bindValue(':email', $_POST["email"],PDO::PARAM_STR);
$stmt->bindValue(':question1', $_POST["question1"],PDO::PARAM_INT);
$stmt->bindValue(':question2', $_POST["question2"],PDO::PARAM_STR);

// 実際に実行する
$stmt->execute();

// データベースから切断する
unset($pdo);
?>