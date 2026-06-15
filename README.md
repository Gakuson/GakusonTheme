# GakusonTheme

GakusonTheme は、学生団体「がくそん」が運営する南山大学生向けメディアサイト [Nanzan Topics!](https://nantopi.com) の WordPress theme です。

記事一覧、記事詳細、カテゴリ・タグ、固定ページ、サイドバー、ナビゲーション、人気記事表示など、学生向けメディアとしての記事閲覧体験と運用導線を支えるために作られています。

## Overview

Nanzan Topics! は、南山大学生向けに授業、サークル、イベント、生活情報などを発信する Web メディアです。この theme は、WordPress の投稿運用を活かしながら、学生団体のトーンに合う表示、スマートフォン閲覧、記事回遊、カテゴリ・タグ導線を整えるためのものです。

現在の main branch では、style を SMACSS ベースの構成へ整理し、Google Docs から WordPress へ入稿する運用にも対応しやすい形に更新しています。

## What This Theme Powers

- トップページの記事一覧と注目導線
- 投稿詳細ページ
- カテゴリ・タグ別の記事一覧
- 固定ページ
- 404 ページ
- header / footer / sidebar などの共通 UI
- 人気記事表示用の閲覧数カウント
- WordPress menu と thumbnail の利用
- Google Docs 由来 HTML の見出し、目次、画像、引用、会話吹き出し表示

## Tech Stack

- WordPress
- PHP
- SCSS / CSS
- JavaScript
- jQuery
- Sass

## Theme Structure

```text
.
|-- front-page.php              # トップページ
|-- single.php                  # 投稿詳細
|-- category.php / tag.php      # カテゴリ・タグ一覧
|-- page.php / page-newindex.php # 固定ページ
|-- header.php / footer.php     # 共通 header / footer
|-- sidebar.php                 # sidebar と回遊導線
|-- functions.php               # theme setup、asset enqueue、閲覧数表示
|-- style.css                   # WordPress theme metadata
|-- js/script.js                # navigation などの画面動作
|-- smacss/                     # SCSS / CSS の main source
|-- img/ icon/ favicon/ poster/ # 公開表示用 assets
|-- gdocs_to_wordpress.md       # Google Docs 入稿 HTML への対応メモ
```

## Local Development

WordPress の theme directory に配置して確認します。PHP template は WordPress 上での表示確認が前提です。

style を編集する場合は、`smacss/` 配下の SCSS と生成済み CSS の対応を確認し、変更した CSS も commit に含めます。Sass を使う場合は、依存関係を入れてから対象ファイルを compile します。

```powershell
npm install
npx sass smacss/main/main-post.scss smacss/main/main-post.css --no-source-map
```

上記は一例です。編集対象に合わせて `smacss/main/`、`smacss/page/`、`smacss/module/` などの入出力を選びます。

## Author Role and Collaboration

GakusonTheme v1 は、@HarutoMizuno と @Y-Mizutani2005 による共同制作です。現在は学生団体「がくそん」が Nanzan Topics! の運用基盤として管理・更新しています。

採用向けには、個人の単独制作物ではなく、共同制作された WordPress theme を団体運用の中で改善・保守している実績として説明します。担当範囲は、theme の実装、表示改善、WordPress 運用に合わせた保守、Google Docs to WordPress 入稿フローとの接続です。

## Google Docs to WordPress Integration

この repository には、Google Docs から WordPress へ変換された HTML を theme 側で扱うための対応メモとして `gdocs_to_wordpress.md` を含めています。

主な対応対象は、見出し、目次、画像、引用、標準テーブル、会話吹き出しブロックなどです。記事執筆者が Google Docs で本文を書き、WordPress 側で読みやすく表示できるように、theme 側の class 設計と表示を合わせています。

関連する自動入稿ツールは別 repository / 別 project として扱い、この repository では theme 側の表示対応を管理します。

## Privacy and Operational Notes

この README は、公開サイトと公開 repository から説明できる範囲に限定しています。メンバー個人情報、未公開の運営情報、内部連絡先、未公開の営業・協賛情報は含めません。

Nanzan Topics! の公開内容、問い合わせ導線、SNS、広告・協賛表示、運営判断は学生団体「がくそん」の管理対象です。
