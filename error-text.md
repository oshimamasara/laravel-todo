### npm install && npm run devの時のエラー

```
【error text】

WARN engine cross-env@7.0.0: wanted: {"node":">=10.14","npm":">=6","yarn":">=1"} (current:npm WARN deprecated popper.js@1.16.1: You can find the new Popper v2 at @popperjs/core, th
is package is dedicated to the legacy v1
```

+ 対策／ node, npm, yarn のバージョンチェック

```
node --version
npm --version
yarn  version

--> node.js version up(ubuntu)

sudo apt install -y nodejs npm
sudo npm install n -g
sudo apt purge -y nodejs npm
sudo apt autoremove
exec $SHELL -l
node --version
npm --version


--> yarn install

curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt-get update && sudo apt-get install yarn
```

```
composer require laravel/ui --dev
php artisan ui bootstrap
npm install && npm run dev
```

### php artisan migrate時のエラー

```
【error text】

Illuminate\Database\QueryException  : SQLSTATE[HY000] [2054] The server requested authentication method unknown......
```

+ 対策／ MySQLのログイン常識を確認

```
mysql -u root -p

select user, plugin from mysql.user;

    ★ change plugin ->   caching_sha2_password   to  normal password

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password01';

exit

php artisan migrate
```
