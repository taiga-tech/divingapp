# [DivingApp](http://3.82.104.16/)

## 開発環境
|language|Version|
|---|---|
|Docker DeskTop|3.0.1|
|Docker Engine|20.10.0|
|docker-compose|1.27.4|
|aws-cli|2.1.1|
|PHP|7.4.13|
|Laravel|4.1.1|
|composer|2.0.8|
|Node|15.4.0|
|npm|7.0.15|
|Vue|2.6.12|

<br>

## インストール方法

``` bash
# Git Clone
  % git clone https://github.com/taiga-tech/divingapp.git
  % cd divingapp

# Docker Build時の環境変数設置
  % cp .docker-compose.env .env

# Lalavel内の環境変数設置
  % cp ./src/.env.example ./src/.env

# Docker build
  % docker compose -f docker-compose.local.yml build
  % docker compose -f docker-compose.local.yml up -d
  % docker compose -f docker-compose.local.yml run php php artisan migrate

# アセットコンパイル
  % docker compose -f docker-compose.local.yml run php npm install
  % docker compose -f docker-compose.local.yml run php npm run dev
```

<br>

## 概要
### サーバサイド
全てAPIで実装しました

- ログイン機能
  - GoogleOAuth
  - FacebookOAuth

- プロフィール機能
  - 新規登録時に新規プロフィール作成
  - プロフィール編集機能
    - S3へのプロフィール画像保存

- CRUD機能
  - 投稿一覧
  - 投稿機能
    - S3への投稿画像保存
  - 投稿編集機能
  - 投稿削除

- 投稿へのコメント機能
- 投稿へのGood機能
- 投稿、プロフィール検索機能
- 各機能のユニットテスト

## DB設計

### ER図

![ER図](https://user-images.githubusercontent.com/67569270/102034086-7e034e00-3e00-11eb-93d9-472d15fdc3ff.png)

### Users
|Column|Type|Options|
|------|----|-------|
|provider_id|string|unique, nullable|
|provider_name|string|unique, nullable|
|userid|string|nullable|
|email|string|unique|
|password|string|nullable|

#### Association
- hasOne->profile
- hasMany->posts
- hasMany->comments
- hasMany->goods

### profile
|Column|Type|Options|
|------|----|-------|
|name|string||
|image|string||
|comment|string|nullable|
|user_id|foreignId|unique|

#### Association
- bolongsTo->user
- hasMany->posts
- hasMany->comments
- hasMany->goods

### posts
|Column|Type|Options|
|------|----|-------|
|text|string||
|place|string|nullable|
|lat|double|nullable|
|lng|double|nullable|
|user_id|foreignId||
|profile_id|foreignId||

#### Association
- bolongsTo->user
- bolongsTo->profile
- hasMany->post_images
- hasMany->comments
- hasMany->goods

### post_images
|Column|Type|Options|
|------|----|-------|
|path|string||
|post_id|foreignId||

#### Association
- bolongsTo->post

### post_comments
|Column|Type|Options|
|------|----|-------|
|content|||
|post_id|foreignId||
|user_id|foreignId||
|profile_id|foreignId||

#### Association
- belongsTo->post
- belongsTo->user
- belongsTo->profile

### post_goods
|Column|Type|Options|
|------|----|-------|
|boolean|||
|post_id|foreignId||
|user_id|foreignId||
|profile_id|foreignId||

#### Association
- belongsTo->post
- belongsTo->user
- belongsTo->profile

### フロントエンド
- ダークモード対応
![darkmode](https://user-images.githubusercontent.com/67569270/102039475-3e8f2e80-3e0d-11eb-80b3-c222f52157f3.gif)

- Vueを使用したSPAの実装
- Vuexを使用した状態管理
- 外部APIを使用した都道府県、市町村の取得
- GmapAPIを使用したGeocoding


### インフラ
- ECRへのDockerイメージ保存
- EFSへのDockerボリューム保存
- AWS Fargate(サーバレス)へのデプロイ

<br>

## AppURL
http://3.82.104.16/

#### テストアカウント
- Email: test@test.com
- Password: test1234

## デプロイ方法
<b>AWSCloud Containers Conference2020で発表されたdocker-compose.ymlを使用してAWS Fargateへデプロイができる`"DockerCLIでのECS統合"`を使用してデプロイしました</b>
https://docs.docker.com/engine/context/ecs-integration/


### デプロイ手順
- Dockerイメージをビルド
- `aws-cli`を使用してECRへログイン
- `aws-cli`を使用してECRへ最新イメージをPush
- `docker context use ecs`を実行し、docker contextを作成したECS用のcontextに変更する
- `docker compose ls`を実行し、コンテナが立ち上がっていないことを確認する
  > ECSにコンテナが立ち上がっていたらエラーが出る。
- `docker compose up`を実行
- `docker compose ps`で全てコンテナが立ち上がっていたらデプロイ完了

``` bash
# Image Build
  % docker compose -f docker-compose.local.yml build

# ECR Login
  % aws ecr get-login-password --profile < profile名 > | docker login --username AWS --password-stdin xxxxxxxxxxxx.dkr.< リージョン >.amazonaws.com

# PHP Image Push
  % docker tag divingapp_php:latest xxxxxxxxxxxx.dkr.< リージョン >.amazonaws.com/< リポジトリ名 >:latest
  % docker push xxxxxxxxxxxx.dkr.< リージョン >.amazonaws.com/< リポジトリ名 >:latest

# Nginx Image Push
  % docker tag divingapp_nginx:latest xxxxxxxxxxxx.dkr.< リージョン >.amazonaws.com/< リポジトリ名 >:latest
  % docker push xxxxxxxxxxxx.dkr.< リージョン >.amazonaws.com/< リポジトリ名 >:latest

# Deploy
  % docker context use ecs
  % docker compose up
```
> CircleCIのデフォルトdockerバージョンでは、
  現在対応していないようなので、完全自動化に向けてバージョン変更方法を調査中


# ドメイン
http://www.freenom.com/ja/index.html

<br>

### デプロイで苦戦したこと
- ホストからのDockerボリュームが対応していないのでS3や、EFSなどのストレージに保存するか、イメージに保存するしかない
  - Laravel本体はDockerfileでイメージに保存
  - DBのデータはEFSに保存
- ECS統合でのデプロイは現状1コンテナに付き1つのボリュームしか対応していない様子
  > Docker公式Issuesにもあったので変更があるかも。[これと似たような現象？]('https://github.com/docker/compose-cli/issues/1054')
- docker-compose.ymlの`環境変数` を読み取らない
  > `env_file`でまとめて定義することで解決
- デプロイ後にコンテナへアクセス(`php artisan migrate`など)が出来ない
  > sshは推薦されていない
- IPアドレスが変動する

今回初めてECSを触り、さらにDockerの最新デプロイ方法を試してみたので、公式リファレンスしか頼るところがなかったので、非常に苦しいこともありましたが、その分issuesなどを見ながら解決する方法を知れたので非常に勉強になりました。

<br>

## CricleCIの動き
### Master Brunch 以外
- テスト
- テスト結果のSlack通知

### Master Brunch
- テスト
- テスト結果のSlack通知
- ~~ECR Push~~
- ~~ECR Push結果のSlack通知~~
- ~~ECS Deploy~~
- ~~ECS Deploy結果のSlack通知~~
> ECRへのPushは成功したが、必要な物がイメージに含まれてなかったので保留、現在調査中
  Docker ECS統合も動かなかったので、完全自動化に向けて調査中

<br>

#### Slack通知の参考画像
![Slack通知の参考画像](https://user-images.githubusercontent.com/67569270/96187946-d2ad5880-0f78-11eb-8eae-fb99a7af7cc7.png)

<br>

### 参考資料
- https://docs.docker.com/storage/volumes/
- https://docs.docker.com/engine/context/ecs-integration/
- https://docs.aws.amazon.com/ja_jp/AmazonECS/latest/userguide/efs-volumes.html
- https://matsuand.github.io/docs.docker.jp.onthefly/engine/context/ecs-integration/
- https://github.com/docker/compose-cli
- https://dev.classmethod.jp/articles/docker-ecs/#toc-1
- https://aws.amazon.com/jp/about-aws/whats-new/2020/07/docker-and-aws-collaborate-to-help-deploy-applications-to-amazon-ecs-on-aws-fargate/
