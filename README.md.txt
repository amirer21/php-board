# PHP Simple Boad

Easy to understand classic web project with html, javascript, and php.
Session-based login, logout, and posting

# How to run

## Apache2 install

```
apt install apache2
```

## Php8.1 install

```
apt install php8.1
apt install php8.1-<extension>
```

### And modify the path in apache2 settings

```
/etc/apache2/apache2.conf
set to on session use.strict_mode, use_cookies,
use_only_cookies, cookie_httponly
```

## MySQL install

Install mysql and set password for security

```sql
CREATE DATABASE phpboard;
CREATE USER 'username' WITH ENCRYPTED PASSWORD 'password';
GRANT ALL PRIVILEGES ON DATABASE phpboard TO 'username';
```

참고 : 인프런, PHP 7+ 프로그래밍, 정상우
