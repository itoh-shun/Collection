# Collection

Creator: Shun Itoh by Spiral Inc.

このプログラムはスパイラル社のSpiral v1で利用できます。

LarabelのCollectionを模したものです。

```php
//<!-- SMP_DYNAMIC_PAGE DISPLAY_ERRORS=ON NAME=xxx -->
require_once 'Collection/require.php';

$collection = collect([1, 2, 3]);

$collection = new SiLibrary\Collection([1, 2, 3]);

```

# Collections
このクラスは、データの配列を操作するための流暢で便利なラッパーを提供します。たとえば、次のコードを確認してください。ヘルパーを使用して配列から新しいコレクション インスタンスを作成し、各要素に対して関数を実行してから、空の要素をすべて削除します。

## コレクションの作成
上記のように、ヘルパーは指定された配列の新しいインスタンスを返します。したがって、コレクションの作成は次のように簡単です。

~~~
$collection = collect([1, 2, 3]);
~~~

## Collection クラスの使い方

### データの追加
set メソッドを使用して、新しいデータを追加または上書きできます。
~~~
$collection->set('address', '123 Main St');
~~~

### データの取得
プロパティのようにアクセスするか、get メソッドを使用してデータを取得できます。
~~~
echo $collection->name;      // John
echo $collection->get('age');  // 25
~~~

### Arrayとして扱う
ArrayableTraitを実装しているので、Arrayと同様に扱えます。

~~~
$count = count($collection);
~~~

### データのフィルタリング
where: キーと値を指定して、一致するデータを取得します。

whereNot: キーと値を指定して、一致しないデータを取得します。

whereIn: キーと値のリストを指定して、一致するデータを取得します。

whereNotIn: キーと値のリストを指定して、一致しないデータを取得します。

filter: コールバック関数を使用してデータをフィルタリングします。

reject: コールバック関数を使用してデータを除外します。
~~~
$filtered = $collection->where('name', 'John');
~~~

### 統計関数
sum: 数値データの合計を取得します。

avg: 平均を取得します。

max: 最大値を取得します。

min: 最小値を取得します。
~~~
echo $collection->sum();
~~~

### その他の操作

first: 最初のデータを取得します。

last: 最後のデータを取得します。

count: アイテムの数を取得します。

column: 指定されたキーのすべての値を配列として取得します。

remove: 指定したキーのデータを削除し、削除されたデータを返します。