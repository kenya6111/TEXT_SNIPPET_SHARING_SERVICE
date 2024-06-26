<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
    public static function getRandomComputerPart(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM PasteContent ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        //if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getAllSnippet(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM PasteContent ");
        
        $stmt->execute();

        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function deleteExpiredSnippet(): void{
        $db = new MySQLWrapper();
        $today = date("Y-m-d H:i:s");

        $stmt = $db->prepare("DELETE FROM PasteContent WHERE expired_limit < ? ");
        $stmt->bind_param("s", $today);
        $stmt->execute();
    }

    public static function insertSnippet($title,$text,  $syntax, $expireDatetime): array {
        //$db = new MySQLWrapper();
    
        // INSERT文を準備
        // $stmt = $db->prepare("INSERT INTO snippets (uid,title,text,  syntax, expire_datetime) VALUES (?,?, ?, ?, ?)");
    
        // // パラメータをバインド
        // $stmt->bind_param('sssss', $uid,$title, $text, $syntax, $expireDatetime);
    
        // // SQLを実行
        // $stmt->execute();
    
        // // // 挿入された行のIDを取得
        // // $insertedId = $stmt->insert_id;
    
        // // 挿入された行を取得
        // $stmt = $db->prepare("SELECT * FROM snippets WHERE uid = ?");
        // $stmt->bind_param('i', $uid);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $snippet = $result->fetch_assoc();
    
        // if (!$snippet) throw new Exception('Could not retrieve the inserted snippet');
    
        // return $snippet;
//-----------------
        $db = new MySQLWrapper();

        $stmt = $db->prepare("INSERT INTO PasteContent (title,content,url,syntax,expired_limit) VALUES(?,?,?,?,?);");
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 16;
        $random_string = str_shuffle($characters);
        $random_string = substr($random_string, 0, $length);
        $date='';
        if($expireDatetime=='tenMin'){
            $date=date("Y/m/d H:i:s", strtotime("10 min"));
        }else if($expireDatetime=='oneHour'){
            $date=date("Y/m/d H:i:s", strtotime("1 hour"));
        }else if($expireDatetime=='oneDay'){
            $date=date("Y/m/d H:i:s", strtotime("1 day"));
        }else{
            $date=null;
        }
           // バインドパラメータ
        $stmt->bind_param("sssss", $title,$text,$random_string,$syntax, $date);
        $stmt->execute();


        $stmt = $db->prepare("SELECT * FROM PasteContent ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $snippet = $result->fetch_assoc();

        return $snippet;
    }

    public static function getComputerPartByType(string $type): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ?");
        $stmt->bind_param('s', $type);
        $stmt->execute();

        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function get5RandomComputerPart(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_all();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getNewestComputerPart(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY created_at DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getRandomSnippetText(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM PasteContent ORDER BY RAND() LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_all(MYSQLI_ASSOC);

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function registSnippetText($data): bool{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("INSERT INTO PasteContent (content,url,expired_limit) VALUES(?,?,?);");
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 16;
        $random_string = str_shuffle($characters);
        $random_string = substr($random_string, 0, $length);
        $url = 'http://127.0.0.1/snippet/'.$random_string; // 実際の値
        $expired_limit = '2024-04-04'; // 実際の値

           // バインドパラメータ
        $stmt->bind_param("sss", $data, $url, $expired_limit);
        $stmt->execute();

        return true;
        

    }
    public static function getNewestSnippetData(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM PasteContent ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }
}               