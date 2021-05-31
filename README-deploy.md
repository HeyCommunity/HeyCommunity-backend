部署 HeyCommunity-core
=================================

HeyCommunity-core 是一个 PHP 项目，包含 WEB 端和运营管理后台，以及 API   
基于 Laravel 8.x，推荐部署在 ubuntu 20.04 系统中

## 项目依赖

- PHP: ^7.3 或 ^8.0; 推荐 7.4
- MySQL: 推荐 ^8.0
- HTTP Server: 推荐 Apache 2

## 项目安装

```
## 进入 HeyCommunity-core 项目根目录
cd /path/HeyCommunity-core

## 安装项目依赖
composer install

## 环境配置
cp .env.example .env
php artisan key:generate
vim .env                                                           ## 配置 DB_* 数据库连接
php artisan migrate                                                ## 构建数据库
php artisan admin:install                                          ## 管理后台安装
mysql -u root -p prod_heycommunity < admin-db.sql                  ## 导入后台数据库的默认数据

## 完成
按以上步骤即完成项目部署，接下来你可能需要配置 HTTP 服务器或 HTTPS 证书
HTTP 服务器: 推荐使用 Apache
HTTPS 证书: 推荐 https://certbot.eff.org/
```

## 管理和配置

登录管理后台，进入系统配置页面，进行管理和配置   
后台地址: https://youdomain.com/admin   
管理员用户名: admin   
管理员密码: HeyCommunity2021

### UGC 审核

此功能用于应对微信小程序上架审核的内容安全要求。

### 微信订阅消息

此功能默认为关闭，开启并配置模板 ID 后，消息通知将会通过微信小程序的一次性订阅消息发送给目标用户。   
请按下面表格在小程序管理平台中添加模板，模板中的内容字段按表格截图勾选。

模板名称 | 模板编号 | 类别 | 截图
--------|---------|------|------
好友点赞通知 | 20293 | 图片 | <img height="50" alt="好友点赞通知" src="https://user-images.githubusercontent.com/5748006/119845556-f471b380-bf3b-11eb-881c-3dc4d087d172.png">
新的评论通知 | 12442 | 笔记 | <img height="50" alt="新的评论通知" src="https://user-images.githubusercontent.com/5748006/119845666-0ce1ce00-bf3c-11eb-8394-ae04a38dc163.png">
评论回复通知 | 3206  | 社区/论坛 | <img height="50" alt="评论回复通知" src="https://user-images.githubusercontent.com/5748006/119845672-0eab9180-bf3c-11eb-99bd-f9b995279e8c.png">
