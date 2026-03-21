# Overview

## 2026-03-17

参照:
- `AGENTS.md`
- `docs/3-17-yuki-design.md`
- `docs/3-17-yuki-tickets.md`

### 作業ルール
- このリポジトリは classic theme 前提。テンプレート階層と既存 WordPress 構造を崩さない。
- テンプレートは薄く保ち、再利用ロジックは `functions.php` や小さな helper / partial に寄せる。
- テンプレート内で新規 PHP 関数、`add_action()`、`add_filter()` を定義しない。
- WordPress 標準出力を styling hook として優先利用する。`body_class()`、`post_class()`、`get_search_form()`、`wp_nav_menu()`、`the_content()`、`wp_tag_cloud()` を活かす。
- 出力は原則 escape。`WP_Query` を使う場合は `wp_reset_postdata()` を戻す。
- スタイルは `smacss/` の適切なレイヤーで管理し、変更時は `smacss/main/*.css` まで更新する。
- 作業は原則 1 チケットずつ。`docs/worklogs/TK-xx.md` に記録し、ユーザーレビューを挟んでから次へ進む。コミットも原則 1 チケット 1 コミット。

### 設計意図
- 3/17 時点の正本は `docs/3-17-yuki-design.md` と `docs/3-17-yuki-tickets.md`。
- v1 の中心は 2 本柱:
- ヘッダーモーダル起点の WordPress 検索導線
- `featured` タグを使うトップカルーセル
- 連携方式は `WordPress custom REST endpoint + gakuson 側 direct fetch`。`WordPress -> Xserver` 同期は v1 対象外。
- 検索は GET で `s`、`category_name`、`tag` を送る。検索対象は `post` のみ、カテゴリ / タグは単一選択。
- カルーセルは最大 5 件。0 件は非表示、1 件は静的ヒーロー、2 件以上でスライダー。
- 下層ページ対応は「テンプレート統合」ではなく「トップ基準の見た目と導線の横展開」を重視する。
- 既存 jQuery、既存 SCSS、WordPress 標準機能を優先し、新規ライブラリは増やさない。

### チケット順
1. TK-01 基盤整備
2. TK-02 WordPress標準出力ベース整理
3. TK-03 ヘッダー検索モーダル
4. TK-04 検索結果ページ
5. TK-05 トップカルーセル
6. TK-06 横展開
7. TK-07 下層デザイン統一
8. TK-08 REST endpoint / direct fetch
9. TK-09 総合確認と仕上げ

### 依存関係
- TK-01 は起点。helper 整理と Sass 出力導線を先に固める。
- TK-02 は TK-01 依存。横展開前に WordPress 標準出力ベースへ寄せる。
- TK-03 は TK-01 依存。検索モーダルを先に WordPress 検索へ接続する。
- TK-04 は TK-02 / TK-03 依存。検索結果ページは検索 UI と標準出力整理の後。
- TK-05 は TK-01 依存。トップ訴求だけ先行着手できる。
- TK-06 は TK-02 / TK-04 / TK-05 依存。標準出力整理、検索結果、トップ訴求が揃ってから横展開。
- TK-07 は TK-06 依存。横展開後に下層のトーンを仕上げる。
- TK-08 は TK-01 / TK-05 依存。カルーセル仕様が固まってから REST endpoint 化する。
- TK-09 は TK-01 から TK-08 まで依存。最後に全体確認。

### 実務上の読み方
- 最短の土台づくりは `TK-01 -> TK-02 -> TK-03 -> TK-04`。
- 見た目確認を早めたい場合は `TK-05` を検索系と並行検討できるが、正式な依存線は別。
- 「整理(TK-02)」と「横展開(TK-06)」は別工程。先に共通ルールを整え、後から各テンプレートへ反映する。
- 外部連携は TK-08 で初めて本格化するため、v1 前半はテーマ内 UI と WordPress 標準運用の整備が主眼。
