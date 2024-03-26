<?php

require_once "vendor/autoload.php";
use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    ''=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputerPart();

        return new HTMLRenderer('list', ['part'=>$part]);
    },
    'list'=>function(): HTTPRenderer{
        $snippets = DatabaseHelper::getAllSnippet();

        return new HTMLRenderer('list', ['snippets'=>$snippets]);
    },
    'create'=>function(): HTTPRenderer{

        return new HTMLRenderer('new-snippet', []);
    },
    'register' => function (): HTTPRenderer {
        // スニペットの登録→表示ページへ遷移

        //登録するスニペットのバリデーション
        // $titleRes = ValidationHelper::validateText($_POST['title'] ?? null,1,100);

        // $textRes = ValidationHelper::validateText($_POST['text'] ?? null,1,1000);

        // $syntaxRes = ValidationHelper::validateSyntax($_POST['syntax'] ?? null);

        // $expireRes = ValidationHelper::validateExpireDatetime($_POST['expire'] ?? null);
        // if (count($textRes["error"]) > 0 || count($syntaxRes["error"]) > 0 || count($expireRes["error"]) > 0) {
        //     $allErrors = array_merge($textRes["error"], $syntaxRes["error"], $expireRes["error"]);
        //     //全てのエラーをスニペット作成ページに引き渡す
        // return new HTMLRenderer('new-snippet', ['errors'=>$allErrors]);

        // }

        // エラーがなかった場合、スニペットをテーブルに登録
        // urlを生成する
        try{
            $result = DatabaseHelper::insertSnippet($_POST['title'],$_POST['text'],$_POST['syntax'],$_POST['expire']);
            // print_r($result);

            return new HTMLRenderer('register-result', ["url"=>$result["url"]]);
        }catch(Exception $e){
            return new HTMLRenderer('register-result', []);

        }
      
        
    },
    // 'random/part'=>function(): HTTPRenderer{
    //     $part = DatabaseHelper::getRandomComputerPart();

    //     return new HTMLRenderer('random-part', ['part'=>$part]);
    // },
    // 'parts'=>function(): HTTPRenderer{
    //     // IDの検証
    //     $id = ValidationHelper::integer($_GET['id']??null);

    //     $part = DatabaseHelper::getComputerPartById($id);
    //     return new HTMLRenderer('parts', ['part'=>$part]);
    // },
    // 'api/random/part'=>function(): HTTPRenderer{
    //     $part = DatabaseHelper::getRandomComputerPart();
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'api/parts'=>function(){
    //     $id = ValidationHelper::integer($_GET['id']??null);
    //     $part = DatabaseHelper::getComputerPartById($id);
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'api/types'=>function(){
    //     $pagenum = ValidationHelper::integer($_GET['page']??null);
    //     $perpage = ValidationHelper::integer($_GET['perpage']??null);
    //     $part = DatabaseHelper::getComputerPartByType($_GET['type']);
    //     return new JSONRenderer(['part'=>$part,'pagenum'=>$pagenum,'perpage'=>$perpage]);
    // },
    // 'api/random/computer'=>function(){

    //     $part = DatabaseHelper::get5RandomComputerPart();
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'api/parts/newest'=>function(){

    //     $part = DatabaseHelper::getNewestComputerPart();
    //     return new JSONRenderer(['part'=>$part]);
    // },

    // //以下、text snippet sharing serviceのエンドポイント 
    // 'api/random/snippet'=>function(){

    //     $part = DatabaseHelper::getRandomSnippetText();
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'api/newest/snippet'=>function(){

    //     $part = DatabaseHelper::getNewestSnippetData();
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'api/registry/snippet'=>function(){
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    //     header("Access-Control-Allow-Headers: Content-Type");
    //     if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    //         // プリフライトリクエストを処理して終了
    //         exit();
    //     }
    //     // JSONからPHP配列へ変換
    //     $json = file_get_contents('php://input');
    //     $data = json_decode($json, true);
    //     $part = DatabaseHelper::registSnippetText($data['content']);
    //     return new JSONRenderer(['part'=>$part]);
    // },
    // 'snippet'=>function(): HTTPRenderer{
    //     // IDの検証
    //     $id = ValidationHelper::integer($_GET['id']??null);

    //     $part = DatabaseHelper::getComputerPartById($id);
    //     return new HTMLRenderer('parts', ['part'=>$part]);
    // },
];