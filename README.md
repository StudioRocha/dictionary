# DICTIONARY　辞書登録アプリ

## 画面一覧

| 画面名 | URL | 説明 | 認証 |
|--------|-----|------|:----:|
| 辞書一覧 | `/` | 登録済み辞書の一覧・検索・並び替え | — |
| ログイン | `/login` | ユーザーログイン | — |
| ユーザー登録 | `/register` | 新規ユーザー登録 | — |
| パスワードリセット申請 | `/forgot-password` | パスワード再設定メール送信 | — |
| パスワードリセット | `/reset-password` | 新しいパスワード設定 | — |
| 辞書登録（新規作成） | `/dictionaries/create` | 辞書の新規登録 | 要 |
| 辞書編集 | `/dictionaries/{id}/edit` | 既存辞書の編集・削除 | 要 |

### 画面遷移

- **辞書一覧** (`/`)
  - 「登録画面へ」→ **辞書登録**（未ログイン時は **ログイン** へリダイレクト）
  - 一覧の「編集」→ **辞書編集**（本人の投稿のみ表示）
  - 一覧の「削除」→ 削除処理後、**辞書一覧**のまま
  - ヘッダー「ログイン」→ **ログイン**（未ログイン時）
  - ヘッダー「新規登録」→ **ユーザー登録**（未ログイン時）
  - ヘッダー「辞書アプリ」→ 辞書一覧（同一画面）

- **ログイン** (`/login`)
  - ログイン成功 → **辞書一覧**
  - ヘッダー「辞書一覧/検索画面へ」→ **辞書一覧**
  - 「新規登録」リンク → **ユーザー登録**

- **ユーザー登録** (`/register`)
  - 登録成功 → **辞書一覧**（またはログイン画面）
  - ヘッダー「辞書一覧/検索画面へ」→ **辞書一覧**
  - 「ログイン」リンク → **ログイン**

- **辞書登録** (`/dictionaries/create`)
  - 登録ボタン送信成功 → **辞書登録**（同一画面、成功メッセージ表示）
  - ヘッダー「辞書一覧/検索画面へ」→ **辞書一覧**
  - ヘッダー「ログアウト」→ **辞書一覧**

- **辞書編集** (`/dictionaries/{id}/edit`)
  - 更新ボタン送信成功 → **辞書一覧**
  - ヘッダー「辞書一覧/検索画面へ」→ **辞書一覧**
  - ヘッダー「ログアウト」→ **辞書一覧**

- **パスワードリセット申請** (`/forgot-password`) → メール送信後、**ログイン** 等へ
- **パスワードリセット** (`/reset-password`) → 完了後 **ログイン** へ

※ 認証が必要な画面（辞書登録・辞書編集）に未ログインでアクセスした場合、**ログイン** 画面へリダイレクトされます。

## テーブル

| テーブル名 | カラム | 型・制約 | NULL | 説明 |
|-----------|--------|----------|:----:|------|
| **users** | id | BIGINT, PK | × | ユーザーID |
| | name | VARCHAR(255) | × | 名前 |
| | email | VARCHAR(255), UNIQUE | × | メールアドレス |
| | email_verified_at | TIMESTAMP | 〇 | メール認証日時 |
| | password | VARCHAR(255) | × | パスワード（ハッシュ） |
| | two_factor_secret | TEXT | 〇 | 2要素認証シークレット |
| | two_factor_recovery_codes | TEXT | 〇 | 2要素認証リカバリーコード |
| | two_factor_confirmed_at | TIMESTAMP | 〇 | 2要素認証有効日時 |
| | remember_token | VARCHAR(100) | 〇 | ログイン維持用トークン |
| | created_at, updated_at | TIMESTAMP | × | 作成・更新日時 |
| **dictionaries** | id | BIGINT, PK | × | 辞書ID |
| | keyword | VARCHAR(10) | × | キーワード（英単語など） |
| | description | VARCHAR(50) | × | 説明（日本語など） |
| | user_id | BIGINT, FK→users, CASCADE | × | 登録者ユーザーID |
| | created_at, updated_at | TIMESTAMP | × | 作成・更新日時 |

## ER 図

<img src="docs/images/ER.drawio.svg" width="640" alt="ER図">

ソース（編集用）: [docs/images/ER.drawio.svg](docs/images/ER.drawio.svg)

## 環境構築

**Docker ビルド**

1. `git clone git@github.com:StudioRocha/dictionary.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
4. .env に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. ブラウザで開発環境に接続

http://localhost/

もし接続時に UnexpectedValueException ページエラーが出た場合。<BR>
![Warning](https://img.shields.io/badge/Warning-Permission%20denied-red)

Windows WSL 環境で http://localhost/　接続時にファイル権限のエラーが出る場合があります。
"Permission denied"というエラーが発生した場合は、
このプロジェクトの root ディレクトリで下記のコマンドを実行してパーミッションを変更後に再接続。

```bash
sudo chmod -R 777 src/*
```

8. シーディングの実行

```bash
php artisan db:seed
```

**生成されるダミーデータ**

- **ユーザー**: 3名（固定。パスワードはすべて `password` でログイン可能）
    - 山田 太郎（yamada@example.com）
    - 佐藤 花子（sato@example.com）
    - 鈴木 一郎（suzuki@example.com）
- **辞書データ**: 各ユーザーが 5 件ずつ登録され、計 **15 件**
- **内容**: 英単語（キーワード）→ 日本語（説明）のペア。例：`apple` → リンゴ、`book` → 本、`water` → 水、`sun` → 太陽、`dog` → 犬、`cat` → 猫、`car` → 車、`tree` → 木、`star` → 星、`house` → 家、`school` → 学校、`friend` → 友達、`music` → 音楽、`flower` → 花、`cloud` → 雲

## 使用技術(実行環境)

- PHP8.3.0
- Laravel8.83.27
- MySQL8.0.26



## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
