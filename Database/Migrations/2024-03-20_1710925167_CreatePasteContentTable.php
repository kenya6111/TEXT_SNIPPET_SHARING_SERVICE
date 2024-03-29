<?php
    
namespace Database\Migrations;
    
use Database\SchemaMigration;
    
class CreatePasteContentTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーションロジックをここに追加してください
        return ["CREATE TABLE PasteContent (
            snippet_id INT AUTO_INCREMENT NOT NULL primary key,
            title VARCHAR(256),
            content TEXT,
            url varchar(256),
            syntax VARCHAR(50),
            expired_limit DATETIME,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );"];
    }

    public function down(): array
    {
        // ロールバックロジックを追加してください
        return ["DROP TABLE PasteContent"];
    }
}