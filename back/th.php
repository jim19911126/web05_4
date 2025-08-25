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
                <button class="type-edit-btn" data-id="<?= $big['id'] ?>">修改</button>
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
                        <button class="type-edit-btn" data-id="<?= $mid['id'] ?>">修改</button>
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
    })
    $(".edit-btn").on("click", function () {
        let id = $(this).data("id");
        // 這裡可以打開一個編輯的對話框，讓使用者修改分類名稱
        let name = $(this).parent().prev().text();
        let newName = prompt("請輸入新的分類名稱", name);
        if(newName != null){
            $.post("./api/save_type.php", { id, name: newName,}, () => {
                $(this).parent().prev().text(newName);
            });
        }
    });
</script>

<h2 class="ct">商品管理</h2>
<div class="ct">
    <button onclick="location.href='?do=add_item'">新增商品</button>
</div>

<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>價格</td>
        <td>庫存</td>
        <td>操作</td>
    </tr>
    <?php
    $items = $Item->all();
    foreach ($items as $item):
        ?>
        <tr class="pp ct">
            <td><?= $item['no'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['stock'] ?></td>
            <td>
                <?php
                echo $item['sh'] == 1 ? '販售中' : '已下架';
                ?>
            </td>
            <td>
                <button data-id="<?= $item['id'] ?>" class="edit-btn">修改</button>
                <button data-id="<?= $item['id'] ?>" class="del-btn">刪除</button>
                <button data-id="<?= $item['id'] ?>" class="up-btn">上架</button>
                <button data-id="<?= $item['id'] ?>" class="down-btn">下架</button>
            </td>
        </tr>
        <?php endforeach; ?>
</table>

<script>
    $(".del-btn").click(function () {
        let id = $(this).data("id");
        if (confirm("確定要刪除這筆資料嗎?")) {
            $.post("./api/del.php", { id, table: "Item" }, () => {
                location.reload();
            });
        }
    })

    $(".up-btn,.down-btn").on("click", function () {
        let id = $(this).data("id");
        let sh=1;
        let action = $(this).text();
        switch (action) {
            case "上架":
                sh = 1;
                break;

            case "下架":
                sh = 0;
                break;
        }
        $.post("./api/switch.php", { id, sh }, () => {
            location.reload();
        });
    })

    $(".edit-btn").on("click", function () {
        let id = $(this).data("id");
        // 這裡可以打開一個編輯的對話框，讓使用者修改商品資訊
        location.href = `?do=edit_item&id=${id}`;
    });
</script>