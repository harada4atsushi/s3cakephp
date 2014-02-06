<?php
App::uses('AppController', 'Controller');

class HogesController extends AppController {
  public $name = 'Hoge';
  public $uses = array('Hoge');

  public function index() {}

  /**
   * ファイルアップロード用のアクション
   */
  public function update() {
    $hoge = $this->request->data['Hoge'];

    if (isset($hoge['upfile']['tmp_name'])) {
      $tmpfile = $hoge['upfile']['tmp_name'];
      $filename = $hoge['upfile']['name'];
      // S3にputする
      $result = $this->Hoge->putFile($hoge['upfile']['tmp_name'], $filename);
      if ($result) {
        $this->Session->setFlash("${result}にファイルを保存しました");
      } else {
        $this->Session->setFlash("ファイルの保存に失敗しました");
     	}
    }
    $this->render('index');
  }

  /**
   * /index のHTML文字列をそのまま保存するアクション
   */
  public function putHtml() {
    $this->render('index');
    $htmlString = $this->response->body();

    // HTML文字列をファイルに書き出す
    $filepath = TMP.'/index.html';
    $fo = fopen($filepath, 'w');
    fwrite($fo, $htmlString);
    fclose($fo);

    // S3にputする
    $result = $this->Hoge->putFile($filepath, "index.html");
    if ($result) {
      $this->Session->setFlash("${result}にファイルを保存しました");
    } else {
      $this->Session->setFlash("ファイルの保存に失敗しました");
    }
    unlink($filepath);
  }
}
