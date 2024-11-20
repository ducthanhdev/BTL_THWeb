<?php
include '../connect.php';
include "./helpers/paginteSuaSix.php";

session_start();
if (empty($_SESSION['username'])) {
?>
    <script>
        window.location.href = `index.php?code=403`;
    </script>
<?php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm Sữa Tuần 6</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <form id="form_update" action="updateProductSix.php" method="POST" style="display: none;">
        <input type="hidden" name="Title" data-name="Title">
        <input type="hidden" name="Address" data-name="Address">
        <input type="hidden" name="PhoneNumber" data-name="PhoneNumber">
        <input type="hidden" name="Email" data-name="Email">
        <input type="hidden" name="Id" data-name="Id">
    </form>

    <div class='container mx-auto mt-8'>
        <h2 class="text-2xl font-bold mb-4 text-center text-[#0ea5e9]">Thông Tin Hãng Sữa</h2>
        <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Mã SP</th>
                    <th class="py-2 px-4 border">Tên SP</th>
                    <th class="py-2 px-4 border">Địa Chỉ</th>
                    <th class="py-2 px-4 border">Số Điện Thoại</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemsPerPage = 1;
                $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                paginate($itemsPerPage, $currentPage, "Product");
                ?>
            </tbody>
        </table>
        <?php paginateBtnNavigate($itemsPerPage, $currentPage, "Product"); ?>
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

                            dataOrigin[item.dataset.name] = item.innerText;
                            dataNew[item.dataset.name] = item.innerText;
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