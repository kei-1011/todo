<?php
// ユーザーモデル

namespace MyApp\Model;

use stdClass;

class User extends \MyApp\Model {

  // ユーザー作成
  public function create($values) {

    // メールアドレス重複チェック
    $user = $this->db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email=?');
    $user->execute(array($values['email']));    //email=?の部分に$_POST['email]を指定
    $record = $user->fetch();//メールアドレスのmemberがいれば1

    if ($record['cnt'] > 0) {  //0か1かが入ってくる
      throw new \MyApp\Exception\DuplicateEmail();    // email重複の例外を返す

    } else {
      // 重複なければ登録

      $stmt = $this->db->prepare("insert into users (user_name,email,password,created,modified) values (:user_name, :email, :password, now(), now())");
      $res = $stmt->execute([
        ':user_name' => $values['user_name'],
        ':email' => $values['email'],
        ':password' => password_hash($values['password'],PASSWORD_DEFAULT) // defaultのアルゴリズムでハッシュ化
      ]);
    }

    // dot install のこのコードは動かなかった。
    // if($res === false) {
    // throw new \MyApp\Exception\DuplicateEmail();¥
    // }
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return $user;
  }

  public function findAll() {
    $stmt = $this->db->query("select * from users order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
