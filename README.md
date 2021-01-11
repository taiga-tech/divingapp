<h1 align="center">DivingApp</h1>


<div align="center">
 <img src="https://user-images.githubusercontent.com/67569270/102722777-c2ce3e00-4346-11eb-8d7f-291a6f651e6b.png" width="100px">
</div>

<div align="center">
<img src="https://user-images.githubusercontent.com/67569270/102722956-0c6b5880-4348-11eb-9e94-6cc06fae88f3.png" width="90px">
<img src="https://user-images.githubusercontent.com/67569270/102723036-a4694200-4348-11eb-8202-004f80b38d9c.png" width="140px">
<img src="https://user-images.githubusercontent.com/67569270/102747430-9e547f00-43a3-11eb-8bd5-c6305fa19bdd.png" width="100px">
</div>

<div align="center">
  <img src="https://user-images.githubusercontent.com/67569270/102721953-4d13a380-4341-11eb-9d04-d5f1668a2db7.png" width="120px">
<img src="https://user-images.githubusercontent.com/67569270/102721957-4f75fd80-4341-11eb-9d6e-302c8fb8e733.png" width="120px">
 <img src="https://user-images.githubusercontent.com/67569270/102723037-a7643280-4348-11eb-80c3-62bb678ceb50.png" width="70px">
  <img src="https://user-images.githubusercontent.com/67569270/102721168-839aef80-433c-11eb-9a0f-b32accd56384.png" width="60px">
</div>

## インストール方法

``` bash
# Git Clone
  % git clone https://github.com/taiga-tech/divingapp.git
  % cd divingapp

# Docker Build時の環境変数設置
  % cp .docker-compose.env .env

# Lalavel内の環境変数設置
  % cp ./src/.env.example ./src/.env

# Docker setup
  % docker-compose -f docker-compose.local.yml build
  % docker-compose -f docker-compose.local.yml up -d

# Laravel setup
  % docker-compose -f docker-compose.local.yml run --rm php php artisan migrate

# アセットコンパイル
  % docker-compose -f docker-compose.local.yml run --rm php npm install
  % docker-compose -f docker-compose.local.yml run --rm php npm run dev
```

<br>

## 開発環境
|language|Version|
|---|---|
|Docker DeskTop|3.0.1|
|Docker Engine|20.10.0|
|docker-compose|1.27.4|
|aws-cli|2.1.1|
|PHP|7.4.13|
|Laravel|8.11.2|
|composer|2.0.8|
|Node|15.4.0|
|npm|7.0.15|
|Vue|2.6.12|

<br>

## 概要
行ったことのない南国へ旅行に行った際、GoogleMapなどで調べても海が多すぎてどこに行くか迷います、
一年ほど宮古島に住んでた頃に、あまり観光客が知らないようなローカルな海でも魅力的な海が非常にたくさんありました。
そこで写真で海の魅力を伝えつつ、位置情報まで共有できるようなSNSがあるといいなと思い、作成してみました。

### サーバサイド
全てAPIで実装しました

- ログイン機能
  - GoogleOAuth
  - FacebookOAuth

- プロフィール機能
  - 新規登録時に新規プロフィール作成
  - プロフィール編集機能
    - S3へのプロフィール画像保存

- 投稿機能
  - 投稿一覧
  - 投稿機能
    - S3への投稿画像保存
  - 投稿編集機能
  - 投稿削除

- 投稿へのコメント機能
- 投稿へのGood機能
- 投稿・プロフィール検索機能
- 各機能のユニットテスト

### サーバーサイドで苦戦したこと
- Railsでは意識しなかったような実装や、コマンドの動きの違いがたくさんあり、勉強できることが非常にたくさんありました。
- Laravel8だと他のバージョンと少し記法が違うところがあり、バージョン違いの記事を参照しているとエラーが起きた際の原因特定が非常に困難でした。
  > 公式リファレンスが非常に読みやすかったので公式にかじりついてました。


## DB設計

### ER図

![ER図](https://user-images.githubusercontent.com/67569270/102034086-7e034e00-3e00-11eb-93d9-472d15fdc3ff.png)

### テーブル
<details>
<summary>開く</summary>

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

</details>

### フロントエンド
- ダークモード対応
![darkmode](https://user-images.githubusercontent.com/67569270/102039475-3e8f2e80-3e0d-11eb-80b3-c222f52157f3.gif)

- Vueを使用したSPAの実装
- Vuexを使用した状態管理
- 外部APIを使用した都道府県、市町村の取得
- Geocoding APIを使用した緯度経度の取得
- Maps JavaScript APIを使用したGmap表示
- 取得した緯度経度を使用してGmapへのピン立て
- レスポンシブ対応
- PWA対応(Localhost・iPhoneのみ検証)
- [Electronでデスクトップアプリ化](https://github.com/taiga-tech/divingapp_for_electron-local/blob/master/README.md)

### PWA参考画像
#### for Mac
<p align="center">
  <img width="250" alt="スクリーンショット 2020-12-21 17 22 37" src="https://user-images.githubusercontent.com/67569270/102755028-28efab00-43b1-11eb-9d38-8e7537e3e9db.png">
  <img width="250" src="https://user-images.githubusercontent.com/67569270/102752353-c399bb00-43ac-11eb-9468-a04d09656a38.png"><br>
</p>

#### for iPhone
<p align="center">
  <img width="200" src="https://user-images.githubusercontent.com/67569270/102755160-5e949400-43b1-11eb-817d-395cce66d808.jpeg">
  <img width="200" src="https://user-images.githubusercontent.com/67569270/102751788-c9db6780-43ab-11eb-9b67-12a5ab1b44ab.jpeg">
  <img width="200" src="https://user-images.githubusercontent.com/67569270/102751736-a6182180-43ab-11eb-857b-468577e25279.jpeg">
</p>

### Electron参考画像
<p align="center"><img width="250" src="https://user-images.githubusercontent.com/67569270/102720950-d2e02080-433a-11eb-9152-4e99f1911aac.png"></p>


### フロントエンドで苦戦したこと
RailsではSassなどのコンパイルは自動でしていたらしく、コンパイルが必要なことすら知らなかったので、変更点が反映されなかったときに非常に困惑しました。

### インフラ
- dockerを使用した環境構築
  > docker-composeでデプロイをするので、docker-compose.ymlをローカル・本番で使い分けています。
- ECRへのDockerイメージ保存
- EFSへのDockerボリューム保存
- AWS Fargate(サーバレス)へのデプロイ

<br>

## AppURL
~~http://54.86.66.12/~~


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

![画面収録-2020-12-21-21 57 59_1](https://user-images.githubusercontent.com/67569270/102783935-02e0ff80-43df-11eb-8b69-fa24ad2052ac.gif)
10分ほどの動画を12倍速＆カットしてます

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
> ECRへのPushは成功したが、必要な物がイメージに含まれてなかったので保留しました、現在調査中
  Docker ECS統合(`docker compose up`)も動かなかったので、完全自動化に向けて調査中

<br>

#### Slack通知の参考画像
![Slack通知の参考画像](https://user-images.githubusercontent.com/67569270/96187946-d2ad5880-0f78-11eb-8eae-fb99a7af7cc7.png)

<br>

## 参考資料
- https://docs.docker.com/storage/volumes/
- https://docs.docker.com/engine/context/ecs-integration/
- https://docs.aws.amazon.com/ja_jp/AmazonECS/latest/userguide/efs-volumes.html
- https://matsuand.github.io/docs.docker.jp.onthefly/engine/context/ecs-integration/
- https://github.com/docker/compose-cli
- https://dev.classmethod.jp/articles/docker-ecs/#toc-1
- https://aws.amazon.com/jp/about-aws/whats-new/2020/07/docker-and-aws-collaborate-to-help-deploy-applications-to-amazon-ecs-on-aws-fargate/
- https://qiita.com/sychocola1/items/f9cc960f85d2fc17d355#%E3%82%AF%E3%83%A9%E3%82%B9%E3%82%BF%E3%83%BC%E3%81%AE%E4%BD%9C%E6%88%90
