# php.2015

- php1 => 基礎からのMySQL(Chapter15以降)
- php2 => 初めてのPHP5

## phpMyAdminのインストール

1. <a href="https://www.phpmyadmin.net/downloads/" target="_blank">ここからダウンロード</a>
1. サーバ(Debian)にコピー
1. ファイルの解凍
1. ディレクトリ名変更
1. DocumentRootに移動  
<br>
(起動でjson関連のエラーになるなら...)
1. $ sudo aptitude install php5-json
1. apache再起動  
sudo service apache2 restart

## MDB2(pear)のインストール

- pearのインストール  
$ sudo aptitude install php-pear
- 本体  
$ sudo pear install MDB2
- ドライバ(MySQL)  
$ sudo pear install MDB2\_Driver_mysql

## 関連リンク

- <a href="http://www.oreilly.co.jp/books/9784873115801/" target="_blank">初めてのPHP5</a>
- <a href="http://urlencode.net/" target="_blank">UrlEncode.net(urlのエンコードを行える)</a>