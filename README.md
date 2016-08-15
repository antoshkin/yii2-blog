Как устанавливать (How install)
===============================

1. git clone https://github.com/antoshkin/yii2-blog.git
2. cd yii2-blog 
3. php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
4. composer install
5. ./init (production)
6. common/config/main-local.php <--- DB
7. php yii migrate
8. php yii rbac/init
9. cd frontend/web/uploads  <--- chmod +w (for webserver) 
10. admin:admin <--- login:pass
11. blog.ikw.pp.ua <--- frontend
12. blog.ikw.pp.ua/admin  <--- backend
