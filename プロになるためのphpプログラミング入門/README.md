# phppro.2015

本リポジトリは夜間の授業で使用する「プロになるためのPHPプログラミング入門」に関する  
追加情報等の情報共有に使用する

## Xdebugのインストール

1. リポジトリを最新にする  
$ sudo aptitude update
1. インストールモジュールを最新にする  
$ sudo aptitude upgrade
1. 開発環境のインストール  
$ sudo aptitude install php5-dev
1. Xdebugのインストール  
$ sudo pecl install xdebug
1. Xdebugの有効化
	1. sudo vi /etc/php5/apache2/php.ini
	1. 以下を追加  
	zend_extension=/usr/lib/php5/20131226/xdebug.so  
	xdebug.remote_enable=on  
	xdebug.remote_host=192.168.33.1
	1. Apache再起動  
	$ sudo service apache2 restart
1. 参考  
<a href="http://www.atmarkit.co.jp/ait/articles/1103/31/news106.html" target="_blank">PECLのXDebugでデバッグを簡単に(前編)</a>  
<a href="http://www.atmarkit.co.jp/ait/articles/1105/25/news125.html" target="_blank">PECLのXDebugでデバッグを簡単に(後編)</a>  


## HTML\_Template_Flexyのインストール

1. sudo pear install HTML\_Template_Flexy

## Apacheのドキュメントルートの設定変更

1.  sudo vi /etc/apache2/sites-available/000-default.conf
1. 以下のように変更  
\#DocumentRoot /var/www/html (旧)  
DocumentRoot /home/yamauchi/www (新)  
(「yamauchi」の部分は各自のログインユーザ)
1. 以下の追加(```</VirtualHost>```より前に追加)
```
<Directory /home/yamauchi/www/>
	Options Indexes FollowSymLinks
	AllowOverride FileInfo
	Require all granted
</Directory>
```
で、Apache再起動

## 郵便番号データの変換(文字コード/改行コード)

$ nkf -w -Lu --overwrite KEN_ALL.CSV

## MySQLでインポート/エクスポート(CSV)するための権限付与

mysql> grant file on \*.\* to ユーザ名@localhost;


## CakePHP 3.xインストール

1. システムの更新  
$ sudo aptitude update  
$ sudo aptitude upgrade
1. icuのインストール  
$ sudo aptitude install libicu-dev
1. intl拡張モジュールのインストール  
$ sudo pecl install intl  
or  
$ sudo aptitude install php5-intl
1. intl拡張モジュールの組み込み  
$ sudo vi /etc/php5/apache2/php.ini  
::: 以下を追加 :::  
extension=intl.so  
::: 以上を追加 :::  
1. curlのインストール  
$ sudo aptitude install curl
1. あとは以下の関連リンクの手順に従ってインストール

## ToneMeをCakePHP 3に移行する手順

1. プロジェクト作成(cake)
1. データベースの接続設定
1. tunesテーブルのModel、View(テンプレート)、Controller作成
1. feelingsテーブルのModel作成
1. artistsテーブルのModel作成
1. レイアウトとスタイルシートの適用
	1. css/imgフォルダ　追加
	1. cake/src/Controller/TunesController.php 修正
	1. cake/src/Template/Layout/toneme.ctp 追加/修正
	1. 動作確認
1. 検索機能
	1. cake/src/Template/Tunes/search.ctp　追加/修正
	1. cake/src/Controller/TunesController.php 修正
1. 追加機能
	1. cake/src/Template/Tunes/add.ctp　修正
	1. cake/src/Controller/TunesController.php 修正
1. 編集機能
	1. cake/src/Template/Tunes/edit.ctp　修正
	1. cake/src/Controller/TunesController.php 修正
1. 削除機能
	1. cake/src/Controller/TunesController.php 修正
1. キモチ曲検索機能
	1. cake/src/Template/Tunes/index.ctp　修正
	1. cake/src/Controller/TunesController.php 修正
	1. cake/src/Model/Table/TunesTable.php
1. ログイン認証機能
	1. usersテーブルのModel、View(テンプレート)、Controller作成
	1. 以下の手順に従って認証機能を追加
		- <a href="http://book.cakephp.org/3.0/en/tutorials-and-examples/blog-auth-example/auth.html" target="_blank">Blog Tutorial - Authentication and Authorization</a>
		- <a href="http://jmatsuzaki.com/archives/16505" target="_blank">CakePHP3.xでのAuthコンポーネントの使い方</a>
1. バリデーション機能
	1. 以下の手順に従ってバリデーション機能を追加
		- <a href="http://book.cakephp.org/3.0/ja/core-libraries/validation.html" target="_blank">バリデーション</a>
		- <a href="http://api.cakephp.org/3.0/class-Cake.Validation.Validation.html" target="_blank">Class Validation</a>
1. CSRF対策処理
	1. 以下の手順に従ってCSRF対策処理を追加
		- <a href="http://easyramble.com/csrf-component-with-cakephp.html" target="_blank">CakePHP3でCSRF対策</a>

## 関連リンク

- <a href="http://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html" target="_blank">郵便番号データダウンロード</a>
- <a href="https://github.com/cakephp/cakephp/tags" target="_blank">CakePHP ダウンロード</a>
- <a href="http://book.cakephp.org/3.0/ja/installation.html" target="_blank">CakePHP 3.xのインストール手順</a>
- <a href="http://book.cakephp.org/3.0/ja/orm/database-basics.html" target="_blank">CakePHP 3.x データベースの基本</a>
- <a href="http://qiita.com/ysnsyks2/items/176cfddbdf1f79d65a75" target="_blank">CakePHP3.0をインストールしてみる(自分用めもめも</a>
- <a href="http://libro.tuyano.com/index2?id=4536003" target="_blank">初心者のためのCakePHP3 プログラミング入門</a>
- <a href="http://jmatsuzaki.com/archives/16505" target="_blank">CakePHP3.xでのAuthコンポーネントの使い方</a>
- <a href="http://jquery.com/download/" target="_blank">jQueryダウンロード</a>