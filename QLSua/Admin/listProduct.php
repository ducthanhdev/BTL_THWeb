<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <form id="form_update" action="update.php" method="POST" style="display: none;">
        <input type="hidden" name="title" data-name="title">
        <input type="hidden" name="thumbnail" data-name="thumbnail">
        <input type="hidden" name="weight" data-name="weight">
        <input type="hidden" name="price" data-name="price">
        <input type="hidden" name="content" data-name="content">
        <input type="hidden" name="is_active" data-name="is_active">
        <input type="hidden" name="id" data-name="id">
    </form>

    <div class='container mx-auto mt-8'>
        <h2 class="text-2xl font-bold mb-4">Danh sách Sản Phẩm</h2>
        <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Mã SP</th>
                    <th class="py-2 px-4 border">Tên SP</th>
                    <th class="py-2 px-4 border">Mô Tả</th>
                    <th class="py-2 px-4 border">Hình Ảnh</th>
                    <th class="py-2 px-4 border">Trọng Lượng</th>
                    <th class="py-2 px-4 border">Giá</th>
                    <th class="py-2 px-4 border">Trạng Thái</th>
                    <th class="py-2 px-4 border">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "select * from Sua";
                $result = mysqli_query($conn, $query);
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="row_data_customer">
                            <td class="py-2 px-4 border text-center" data-name="id">
                                <?php echo $row["id"] ?>
                            </td>
                            <td focus="true" data-name="title" class="py-2 px-4 border text-center">
                                <?php echo $row["title"] ?>
                            </td>
                            <td data-name="content" class="px-4 py-2 border text-center ">
                                <p class="max-h-[200px] overflow-auto max-w-[400px] whitespace-pre">
                                    <?php echo $row["content"] ?>
                                </p>
                            </td>
                            <td data-name="thumbnail" class="py-2 px-4 border text-center">
                                <a href="<?php echo $row["thumbnail"] ?>" target="_blank" rel="noopener noreferrer">Xem Hình
                                    Ảnh</a>
                            </td>
                            <td data-name="weight" class="py-2 px-4 border text-center">
                                <?php echo $row["weight"] ?>
                            </td>
                            <td data-name="price" class="py-2 px-4 border text-center">
                                <?php echo $row["price"] ?>
                            </td>
                            <td data-name="is_active" class="py-2 px-4 border text-center">
                                <?php echo $row["is_active"] == 0 ? "Ẩn" : "Hiển Thị" ?>
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <div class="flex gap-2 items-center">
                                    <button
                                        class="btn_update text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg></button>
                                    <form action="delete.php" method="POST" id="deleteForm">
                                        <input type="hidden" value="<?php echo $row["id"] ?>" name="id" data-name="id">
                                        <button type="submit" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4
                                            focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                            dark:focus:ring-yellow-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <script>
        const rowDatas = document.querySelectorAll('.row_data_customer');
        const formUpdate = document.querySelector("#form_update");
        const inputSubmit = formUpdate.querySelectorAll('input')


        rowDatas.forEach(rowElement => {
            rowElement.addEventListener("click", (e) => {
                const btnUpdate = e.target.closest('.btn_update');
                if (btnUpdate) {
                    btnUpdate.addEventListener("click", (e) => {
                        const elementSaveData = rowElement.querySelectorAll("td[data-name]");
                        const dataOrigin = {}
                        const dataNew = {}
                        elementSaveData.forEach((item, index) => {
                            if (index > 0) {
                                item.setAttribute("contenteditable", true);
                                if (index == 1) {
                                    item.focus();
                                }
                            }


                            if (item.dataset.name === "thumbnail") {
                                dataOrigin[item.dataset.name] = item.querySelector("a").getAttribute("href");
                                dataNew[item.dataset.name] = item.querySelector("a").getAttribute("href");
                            } else {
                                dataOrigin[item.dataset.name] = item.innerText;
                                dataNew[item.dataset.name] = item.innerText;
                            }
                        })

                        elementSaveData.forEach(item => {
                            item.addEventListener("input", (e) => {
                                dataNew[item.dataset.name] = item.innerText;
                                if (_.isEqual(dataOrigin, dataNew)) {
                                    btnUpdate.innerHTML = `
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    `;
                                } else {
                                    btnUpdate.innerHTML =
                                        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    `;
                                    btnUpdate.addEventListener("click", (e) => {
                                        Swal.fire({
                                            title: "Warninh",
                                            text: "Bạn Có Chắc Chắn Update!",
                                            icon: "info",
                                            showConfirmButton: true,
                                            showCancelButton: true,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                inputSubmit.forEach(input => {
                                                    input.value = dataNew[input.dataset.name];
                                                });
                                                formUpdate.submit();
                                            }

                                        });
                                    })
                                }
                            })
                        })
                    })
                }

            })
        })

        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        if (getUrlParameter("code") === '0') {
            Swal.fire({
                title: "Thành Công",
                text: "Bạn đã cập nhật thành công!",
                icon: "success",
                showConfirmButton: true,
            }).then(() => {
                const url = new URL(window.location.href);
                const param = 'code';
                url.searchParams.delete(param);
                window.history.pushState({}, document.title, url.toString());
            });
        } else if (getUrlParameter("code") === "1") {
            Swal.fire({
                title: "Thất Bại",
                text: "Đã Có Lỗi Xảy Ra!",
                icon: "info",
                showConfirmButton: true,
            }).then(() => {
                const url = new URL(window.location.href);
                const param = 'code';
                url.searchParams.delete(param);
                window.history.pushState({}, document.title, url.toString());
            });
        }
    </script>
</body>

</html>