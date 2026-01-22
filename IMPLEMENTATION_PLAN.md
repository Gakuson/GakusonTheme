# Nanトピ！テーマ刷新 実装計画書

## 進捗状況

| Phase | タスク | ステータス |
|-------|--------|-----------|
| 1 | SCSS共通化 | ⏸️ 現状維持（意図的設計のため） |
| 1 | `custom_wp_tag_cloud()` 重複削除 | ✅ 完了 |
| 2 | モバイルUI刷新 | 🔜 未着手 |
| 3 | ページデザイン刷新 | 📋 計画中 |
| 4 | 機能追加 | 📋 計画中 |

---

## Phase 2: モバイルUI刷新（詳細計画）

### 2-1. 固定ボトムナビゲーション追加

**目的**: スマホユーザーの操作性向上（親指で届く位置にナビを配置）

**実装内容**:
```
┌─────────────────────────────────┐
│                                 │
│         ページコンテンツ          │
│                                 │
├─────────────────────────────────┤
│  🏠    🔍    📁    ☰           │  ← 固定ボトムナビ
│ ホーム  検索  カテゴリ メニュー    │
└─────────────────────────────────┘
```

**作業ファイル**:
| ファイル | 作業内容 |
|---------|---------|
| `footer.php` | ボトムナビHTML追加（`</body>`直前） |
| `smacss/module/module.scss` | `.bottom-nav` スタイル追加 |
| `smacss/layout/layout.scss` | `#footer` の `margin-bottom` 調整（ナビ分の余白） |
| `js/bottom-nav.js`（新規） | カテゴリドロワー開閉、検索モーダル制御 |
| `functions.php` | 新規JSファイルのエンキュー追加 |

**SCSS設計案**:
```scss
// smacss/module/module.scss に追加

// ボトムナビゲーション（SPのみ表示）
.bottom-nav {
    display: none; // PCでは非表示
    
    @include media-sp {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: #fff;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        z-index: 100;
        justify-content: space-around;
        align-items: center;
    }
}
.bottom-nav_item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 16px;
    color: $text-color;
    font-size: 0.7rem;
}
.bottom-nav_icon {
    width: 24px;
    height: 24px;
    margin-bottom: 4px;
}
```

**HTML構造案**:
```php
<!-- footer.php の </body> 直前に追加 -->
<nav class="bottom-nav">
    <a href="<?php echo home_url(); ?>" class="bottom-nav_item">
        <img class="bottom-nav_icon" src="<?php echo get_template_directory_uri(); ?>/icon/home.svg" alt="">
        <span>ホーム</span>
    </a>
    <button class="bottom-nav_item" id="search-trigger">
        <img class="bottom-nav_icon" src="<?php echo get_template_directory_uri(); ?>/icon/search.svg" alt="">
        <span>検索</span>
    </button>
    <button class="bottom-nav_item" id="category-trigger">
        <img class="bottom-nav_icon" src="<?php echo get_template_directory_uri(); ?>/icon/folder.svg" alt="">
        <span>カテゴリ</span>
    </button>
    <button class="bottom-nav_item" id="menu-trigger">
        <img class="bottom-nav_icon" src="<?php echo get_template_directory_uri(); ?>/icon/menu.svg" alt="">
        <span>メニュー</span>
    </button>
</nav>
```

---

### 2-2. ハンバーガーメニューの改善

**目的**: 現行メニューをモダンなフルスクリーンオーバーレイに変更

**現状確認が必要なファイル**:
- `header.php` - 現在のハンバーガーメニュー構造
- `js/navbutton.js` - 現在のメニュー開閉ロジック
- `smacss/state/state.scss` - `.is-active` 系の状態クラス

**改善案**:
1. メニュー展開時にフルスクリーンオーバーレイ表示
2. カテゴリ一覧を階層表示
3. 閉じるボタンを分かりやすく
4. スムーズなアニメーション追加

---

### 2-3. タッチフレンドリーなUI要素

**目的**: タップターゲットサイズの最適化

**チェックリスト**:
- [ ] リンク・ボタンの最小サイズを44x44pxに
- [ ] タップ領域の余白確保（padding増加）
- [ ] ホバー効果をタップ効果に変更（SP時）
- [ ] スクロール時のヘッダー縮小（オプション）

**主な修正対象**:
- `.feature`（記事カード）のタップ領域
- `.Hashtag_text`（タグリンク）のパディング
- ページネーションボタン

---

## Phase 3: ページデザイン刷新（概要）

### 3-1. フロントページのカード型グリッド化
- 現状: 3カラムグリッド → 維持しつつモダン化
- カードにホバーエフェクト追加
- サムネイルのアスペクト比統一
- 日付・カテゴリ表示の改善

### 3-2. 記事一覧のスワイプカルーセル化
- Slick Carousel（既存）を活用
- 「人気記事」「新着記事」をカルーセル化
- ドットインジケーター追加
- スワイプ操作対応

### 3-3. 投稿詳細ページのモダン化
- アイキャッチ画像のフルワイド表示
- 目次の自動生成＆固定サイドバー化
- 関連記事セクションの追加
- SNSシェアボタンの改善

---

## Phase 4: 機能追加（概要）

### 4-1. 質問箱埋め込み用テンプレート
- `page-questions.php` 新規作成
- Peing/マシュマロのiframe埋め込み
- レスポンシブ対応の埋め込みスタイル

### 4-2. 入稿アプリ出力対応スタイル
**対応が必要なHTML要素**:
```scss
// 記事本文用スタイル（page-post.scss に追加）

// 画像ブロック
figure {
    margin: 2em 0;
    img {
        max-width: 100%;
        height: auto;
    }
    figcaption {
        font-size: 0.85em;
        color: #666;
        text-align: center;
    }
}

// 引用ブロック
blockquote {
    border-left: 4px solid $accent-yellow;
    padding-left: 1em;
    margin: 1.5em 0;
    font-style: italic;
}

// マーカー
.marker-yellow { background: linear-gradient(transparent 60%, #fff799 60%); }
.marker-red { background: linear-gradient(transparent 60%, #ffb7b7 60%); }
.marker-blue { background: linear-gradient(transparent 60%, #b7d4ff 60%); }

// 目次（自動生成用）
.toc {
    background: #f9f9f9;
    padding: 1.5em;
    border-radius: 8px;
    margin: 2em 0;
}
```

---

## 技術メモ

### 現在のブレークポイント
```scss
$breakpoints: (
    'sp': 750px,
    'tablet': 1024px,
);
```

### カラーパレット
```scss
$primary-bg: #EDF2F5;      // 背景色
$text-color: #43474A;      // テキスト色
$accent-blue: #BDE7FF;     // アクセント（水色）
$accent-yellow: #FFB916;   // 見出し色（黄色）
$footer-bg: #FAF0DB;       // フッター背景
```

### BEM命名規則（Nanトピ版）
```
.block_element__modifier
例: .bottom-nav_item__active
```

### ファイル読み込み順序（main.scss）
```
base.scss → layout.scss → module.scss → sidebar.scss(任意) → state.scss → page-xxx.scss
```

---

## 注意事項

1. **SCSSコンパイル**: 変更後は必ずコンパイルしてCSSを生成
2. **キャッシュ**: functions.php のバージョン番号を更新してキャッシュクリア
3. **テスト**: Local by Flywheelでの動作確認必須
4. **Git**: 作業前にブランチを切ることを推奨

---

## 参考リンク

- [GitHub リポジトリ](https://github.com/Gakuson/GakusonTheme)
- [がくそん公式サイト](https://www.gakuson.com/)
- [SMACSS公式](http://smacss.com/)
