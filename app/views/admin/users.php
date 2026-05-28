<div class="topbar">

    <h1>
        Quản lý người dùng
    </h1>

</div>

<table>

    <thead>

        <tr>

            <th>ID</th>

            <th>Username</th>

            <th>Email</th>

            <th>Role</th>

            <th>Hành động</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($users as $user): ?>

            <tr>

                <td>

                    <?= $user["id"] ?>

                </td>

                <td>

                    <?= htmlspecialchars(
                        $user["username"]
                    ) ?>

                </td>

                <td>

                    <?= htmlspecialchars(
                        $user["email"]
                    ) ?>

                </td>

                <td>

                    <form method="POST" action="/NguyenNhatTruong_2393/Admin/changeRole/<?= $user["id"] ?>">

                        <select name="role" onchange="this.form.submit()">

                            <option value="customer" <?= $user["role"] == "customer"
                                ? "selected"
                                : "" ?>>

                                customer

                            </option>

                            <option value="admin" <?= $user["role"] == "admin"
                                ? "selected"
                                : "" ?>>

                                admin

                            </option>

                        </select>

                    </form>

                </td>

                <td>

                    <a class="delete-btn" href="/NguyenNhatTruong_2393/Admin/deleteUser/<?= $user["id"] ?>">

                        Xóa

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>