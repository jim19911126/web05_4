<h2 class="ct">商品分類</h2>

<div class="ct">
    新增大分類
    <input type="text" name="big" id="big">
    <button onclick="addBig()">新增</button>
</div>

<div class="ct">
    新增中分類
    <select name="selBig" id="selBig"></select>
    <input type="text" name="mid" id="mid">
    <button>新增</button>
</div>

<table class="all">
    <tr class="tt">
        <td>女用皮件</td>
        <td class="ct">
            <button>修改</button>
            <button>刪除</button>
        </td>
    </tr>
    <tr class="pp ct">
        <td>男用皮件</td>
        <td>
            <button>修改</button>
            <button>刪除</button>
        </td>
    </tr>
</table>

<script>
    function addBig(params) {
        let name = $("#big").val();

        $.post("./api/save_type.php", { name, big_id:0 }, function() {
            location.reload();
        });
    }
</script>

<h2 class="ct">商品管理</h2>
<div class="ct">
    <button>新增商品</button>
    <select name="" id="">新增商品</select>
</div>

<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>價格</td>
        <td>庫存</td>
        <td>操作</td>
    </tr>
    <tr class="pp ct">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button>修改</button>
            <button>刪除</button>
            <button>上架</button>
            <button>下架</button>
        </td>
    </tr>
</table>