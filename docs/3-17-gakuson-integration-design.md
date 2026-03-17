# 3/17 gakuson 連携方式メモ

## この文書の位置づけ
- この文書は、`docs/3-17-yuki-design.md` に統合した連携判断の補足メモです。
- 2026-03-17 時点の正本は `docs/3-17-yuki-design.md` と `docs/3-17-yuki-tickets.md` です。
- v1 の正式採用案は `WordPress custom REST endpoint + gakuson 側 direct fetch` です。

## 結論
- WordPress 側でカルーセル専用の custom REST endpoint を公開する
- gakuson 側の静的 JS がその endpoint を direct fetch して描画する
- push 同期、Bearer token 認証、Xserver 側受け口 PHP は v1 では採用しない

## 採用理由
- WordPress を正本のまま扱える
- 構成が短く、v1 を最短で出しやすい
- gakuson 側は静的サイトのままでよい
- まずは軽い JSON を返す endpoint と最小描画に集中できる

## 採用にあたって意識するリスク
- 表示時レイテンシは WordPress 側応答に依存する
- CORS、security plugin、ホスティング設定の影響を受ける
- WordPress 側障害が gakuson 側初回表示の遅延として見えやすい

## v1 アーキテクチャ
```text
WordPress
  └─ GET /wp-json/gakuson/v1/carousel
       └─ featured 記事の軽量 JSON を返す

gakuson (Static site on Xserver)
  └─ JS が endpoint を direct fetch
       └─ 受け取った JSON でカルーセル描画
```

## WordPress 側の要件
- `register_rest_route()` で custom endpoint を定義する
- `permission_callback` は公開読み取り前提で定義する
- `featured` 記事抽出ルールを 1 箇所に閉じ込める
- 表示に不要な WordPress 標準フィールドは返さない
- `transient` などで短時間キャッシュできるようにする

## レスポンス draft
### Route
- `GET /wp-json/gakuson/v1/carousel`

### Fields
- `items[]`

### item
- `id`
- `title`
- `url`
- `category`
- `tags[]`
- `thumbnailUrl`
- `excerpt`
- `updatedAt`

## gakuson 側の要件
- ページ描画後に非同期で fetch する
- loading 表示を持つ
- 失敗時は fallback message を表示する
- 0 件、1 件、複数件で UI を分ける

## CORS の扱い
- v1 は `public GET only` を前提にする
- `Authorization` ヘッダや custom header は使わない
- browser devtools で response header と console error を確認する

## フォールバック案
- CORS が安定しない
- WordPress 側応答が重い
- 高トラフィック時に表示が不安定

上記のいずれかが起きたら、次を再評価する。
- WordPress から Xserver へ JSON をミラーする
- GAS / GitHub Actions などで静的 JSON を更新する
- Xserver 側に PHP を 1 本置いて JSON を代理配信する

## 未確定事項
- namespace / route 名の最終確定
- CORS を public GET のまま許可するか、特定 origin に絞るか
- cache TTL
- サムネイル未設定時の fallback

## 関連文書
- [3-17-yuki-design.md](./3-17-yuki-design.md)
- [3-17-yuki-tickets.md](./3-17-yuki-tickets.md)
