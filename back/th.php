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
    <button onclick="addMid()">新增</button>
</div>

<table class="all">

    <?php
    $bigs = $Type->all(['big_id' => 0]);
    foreach ($bigs as $big):
        ?>
        <tr class="tt">
            <td><?= $big['name'] ?></td>
            <td class="ct">
                <button class="edit-btn" data-id="<?= $big['id'] ?>">修改</button>
                <button class="del-btn" data-id="<?= $big['id'] ?>">刪除</button>
            </td>
        </tr>

        <?php
        if ($Type->count(['big_id' => $big['id']]) > 0):
            $mids = $Type->all(['big_id' => $big['id']]);
            foreach ($mids as $mid):
                ?>
                <tr class="pp ct">
                    <td><?= $mid['name'] ?></td>
                    <td>
                        <button class="edit-btn" data-id="<?= $mid['id'] ?>">修改</button>
                        <button class="del-btn" data-id="<?= $mid['id'] ?>">刪除</button>
                    </td>
                </tr>

                <?php
            endforeach;
        endif;
    endforeach;
    ?>
</table>

<script>

    getBigs();
    function addBig(params) {
        let name = $("#big").val();

        $.post("./api/save_type.php", { name, big_id: 0 }, function () {
            $("#big").val("");
            getBigs();
        });
    }

    function addMid(params) {
        let name = $("#mid").val();
        let big_id = $("#selBig").val();

        $.post("./api/save_type.php", { name, big_id }, function () {
            location.reload();
        });
    }

    function getBigs(params) {
        $.get("./api/get_bigs.php", (options) => {
            $("#selBig").html(options);
        });
    }
    $(".del-btn").click(function () {
        let id = $(this).data("id");
        if (confirm("確定要刪除此分類嗎?")) {
            $.post("./api/del.php", { id, table: "Type" }, () => {
                location.reload();
            });
        }
    });
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