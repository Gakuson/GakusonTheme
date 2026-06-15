# GakusonTheme / Nanzan Topics

学生団体「がくそん」が運営する南山大学生向けメディアサイト [Nanzan Topics!](https://nantopi.com) 用の WordPress theme です。

記事発信と組織運営を支える Web 基盤として、投稿一覧、記事詳細、カテゴリ・タグ、固定ページ、サイドバー、ナビゲーション、人気記事表示などを扱います。

## Problem

学生団体「がくそん」では、ポータルサイトだけでなく、南山大学生向けのメディアサイト「Nanzan Topics!」も運営しています。

サークル紹介、授業情報、食事スポット、新入生向け情報、ボランティア、学内イベントなど、大学生活に密着した記事を継続的に出すには、記事を読みやすく表示し、学生団体のトーンに合った WordPress theme が必要でした。

## Role

GakusonTheme v1 は、@HarutoMizuno と @Y-Mizutani2005 による共同制作です。

この repository は、単独所有の制作物ではなく、学生団体の Web 基盤を共同で作り、現在も団体として管理・更新しているプロジェクトとして位置づけています。担当範囲は、theme の実装、表示改善、WordPress 運用に合わせた保守、Google Docs to WordPress 入稿フローとの接続です。

## What I Built

公開 repository に含まれる主な要素は以下です。

- WordPress theme の基本テンプレート
- `front-page.php`、`single.php`、`category.php`、`tag.php` などの記事表示テンプレート
- `header.php`、`footer.php`、`sidebar.php` などの共通 UI
- 投稿一覧、記事詳細、カテゴリ・タグ、固定ページ、404 ページ
- 人気記事表示用の閲覧数カウント
- SMACSS ベースの SCSS / CSS 構成
- JavaScript / jQuery による navigation などの画面動作
- Nanzan Topics! のブランドに合わせた画像・アイコン類
- Google Docs 由来 HTML の見出し、目次、画像、引用、会話吹き出し表示

WordPress 標準の投稿運用を活かしつつ、学生向けメディアとして読みやすい見た目と導線を整えています。

## Result

Nanzan Topics! は、ポータルサイト「がくそん」と比べて滞在時間が長く、より深く情報を読まれるメディアとして運営されています。

2025年4月時点で、GA4 計測の月間アクティブユーザーは 681 人、月間イベント数は 5,808 件です。ポータルサイトで広く接点を取り、Nanzan Topics! で詳しい情報を届ける構造の一部を担っています。

## Tech Stack

- WordPress
- PHP
- SCSS
- CSS
- JavaScript
- jQuery
- Sass

## Project Structure

```text
.
|-- front-page.php               # トップページ
|-- single.php                   # 投稿詳細
|-- category.php / tag.php       # カテゴリ・タグ一覧
|-- page.php / page-newindex.php # 固定ページ
|-- header.php / footer.php      # 共通 header / footer
|-- sidebar.php                  # sidebar と回遊導線
|-- functions.php                # theme setup、asset enqueue、閲覧数表示
|-- style.css                    # WordPress theme metadata
|-- js/script.js                 # navigation などの画面動作
|-- smacss/                      # SCSS / CSS の main source
|-- img/ icon/ favicon/ poster/  # 公開表示用 assets
|-- gdocs_to_wordpress.md        # Google Docs 入稿 HTML への対応メモ
```

## Local Development

WordPress の theme directory に配置して確認します。PHP template は WordPress 上での表示確認が前提です。

style を編集する場合は、`smacss/` 配下の SCSS と生成済み CSS の対応を確認し、変更した CSS も commit に含めます。

```powershell
npm install
npx sass smacss/main/main-post.scss smacss/main/main-post.css --no-source-map
```

上記は一例です。編集対象に合わせて `smacss/main/`、`smacss/page/`、`smacss/module/` などの入出力を選びます。

## Evidence

- Public media site: [nantopi.com](https://nantopi.com)
- GitHub repository: [Gakuson/GakusonTheme](https://github.com/Gakuson/GakusonTheme)
- 共同制作: `@HarutoMizuno` / `@Y-Mizutani2005`
- GA4 計測値: 2025年4月時点の内部計測に基づく
- Google Docs to WordPress 対応メモ: [`gdocs_to_wordpress.md`](gdocs_to_wordpress.md)

## Links

- [Nanzan Topics!](https://nantopi.com)
- [GitHub repository](https://github.com/Gakuson/GakusonTheme)
