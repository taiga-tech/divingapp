# 概要
### サーバサイド
### フロントエンド
  - vue (spa)
# 開発環境
|language|Version|
|---|---|
|Docker DeskTop|2.5.0.1 (stable)|
|Docker Engine|19.03.13|
|docker-compose|1.27.4|
|PHP|7.4.12|
|Laravel|4.1.1|
|composer|2.0.7|
|npm|6.14.8|
|node|10.23.0|

# 本番環境
|AWS||
|--|--|
|ecs-cli|1.20.0|
|ecs|fargate|
|container|ecr|
|volume|efs|
|upload image|s3|

## 現状デプロイ方法
http://3.238.141.69/
  > AWSCloud Containers Conference2020で発表された`DockerCLIでのECS統合`を使用してデプロイしました

### 参考資料
- https://docs.docker.com/storage/volumes/
- https://docs.docker.com/engine/context/ecs-integration/#tuning-the-cloudformation-template
- https://docs.aws.amazon.com/ja_jp/AmazonECS/latest/userguide/efs-volumes.html
- https://matsuand.github.io/docs.docker.jp.onthefly/engine/context/ecs-integration/
- https://dev.classmethod.jp/articles/docker-ecs/#toc-1
- https://github.com/docker/compose-cli
- https://aws.amazon.com/jp/about-aws/whats-new/2020/07/docker-and-aws-collaborate-to-help-deploy-applications-to-amazon-ecs-on-aws-fargate/

### デプロイ手順
- ecrに最新イメージpush
- contextを作成したecsに変更する
- `docker compose ls`でステータスがランニングになっていないことを確認する
  > ecsにコンテナが立ち上がっていたらなぜかエラーが出る。
- `docker compose up`でデプロイ完了

### デプロイで苦戦したこと
- ホストからのvolumeに対応していない
- `$ENV` を読み取らない
  > `env_file`でまとめて定義することで解決
- デプロイ後にコンテナにアクセス出来ない(sshは推薦されていない)
- ipが変動する


# インストール方法
```bash
  % git clone https://github.com/taiga-tech/divingapp.git
  % cd divingapp
  % cp .docker-compose.env .env
  % cp ./src/.env.example ./src/.env
  % docker-compose -f docker-compose.local.yml up -d --build
  % docker-compose -f docker-compose.local.yml run php php artisan migrate
  % docker-compose -f docker-compose.local.yml run php npm install
  % docker-compose -f docker-compose.local.yml run php npm run dev
```

# CricleCIの動き

### master brunch 以外
- test
- test結果のslack通知

### master brunch
- test
- ~~ecrpush~~
  > ecrへのpushは成功したが、必要なものがなかったので、現在調査中

- ecr, ecsへのデプロイは、hostPCで実行
  ``` shell
  # circleciでしたいこと
  # ecrログイン
    % aws ecr get-login-password --profile < profile名 > | docker login --username AWS --password-stdin xxxxxxxxxxxx.dkr.ecr.us-east-1.amazonaws.com
  # php push
    % docker tag divingapp_php:latest xxxxxxxxxxxx.dkr.ecr.us-east-1.amazonaws.com/< リポジトリ名 >:latest
    % docker push xxxxxxxxxxxx.dkr.ecr.us-east-1.amazonaws.com/< リポジトリ名 >:latest
  # nginx push
    % docker tag divingapp_nginx:latest xxxxxxxxxxxx.dkr.ecr.us-east-1.amazonaws.com/< リポジトリ名 >:latest
    % docker push xxxxxxxxxxxx.dkr.ecr.us-east-1.amazonaws.com/< リポジトリ名 >:latest
  # deploy
    % docker context use ecs
    % docker compose up
  ```
  > circleciのデフォルトdocker versionでは、
    現在おそらく対応していないようなので、完全自動化に向けてversion変更方法を調査中
- test結果のslack通知
- ~~ecrpush結果のslack通知~~

#### slack通知の参考画像
![](https://user-images.githubusercontent.com/67569270/96187946-d2ad5880-0f78-11eb-8eae-fb99a7af7cc7.png)
