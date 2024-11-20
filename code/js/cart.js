const cartContentRender = document.querySelector("#render_cart_page_product");
let carts = JSON.parse(localStorage.getItem("carts") || "null");
const totalPriceText = document.querySelector("#total_price");

if (!carts) {
  localStorage.setItem("carts", JSON.stringify([]));
  carts = [];
}

if (cartContentRender) {
    renderContenCart();
    totalPriceHandle();
}

function renderContenCart() {
    let carts = JSON.parse(localStorage.getItem("carts"));
    cartContentRender.innerHTML = carts.map((product) => {
    return `
         <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                <a href="#" class="shrink-0 md:order-1">
                    <img class="h-20 w-20 dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg"
                        alt="imac image" />
                    <img class="hidden h-20 w-20 dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg"
                        alt="imac image" />
                </a>

                <label for="counter-input" class="sr-only">Choose quantity:</label>
                <div class="flex items-center justify-between md:order-3 md:justify-end">
                    <div class="flex items-center">
                        <button type="button" id="decrement-button-2"
                            onClick="handleClickButtonCart(${product.count}, ${product.Ma}, 'desc')"
                            data-input-counter-decrement="counter-input-2"
                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" id="counter-input-2" data-input-counter
                            class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                            placeholder="" value="${product.count}" required />
                        <button onClick="handleClickButtonCart(${product.count}, ${product.Ma}, 'inc')" type="button" id="increment-button-2"
                            data-input-counter-increment="counter-input-2"
                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-end md:order-4 md:w-32">
                        <p class="text-base font-bold text-gray-900 dark:text-white">${product.GiaBan} / ${product.DonVi}</p>
                    </div>
                </div>

                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">${product.Ten}</a>
                </div>
            </div>
        </div>
    `;
  }).join("");
}


function totalPriceHandle() {
    let carts = JSON.parse(localStorage.getItem("carts"));
    const total = carts.reduce((initialValue, item) => {
        const price = parseFloat(item.GiaBan, 10) * parseInt(item.count) || 0; 
        return initialValue + price;
    }, 0);

    totalPriceText.innerHTML = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(total);
}

function handleClickButtonCart(count, Ma, type) {
    switch(type) {
        case "inc" :{
            count  = count + 1;
            let carts = JSON.parse(localStorage.getItem("carts"));
            let checkProductExit = carts.find(
                (item) => parseInt(item.Ma) === parseInt(Ma)
              );
              console.log(checkProductExit)
            if(!checkProductExit) return;
            checkProductExit.count = count;
            const newCart = carts.map((item) => {
                if (item.Ma === checkProductExit.Ma) {
                return checkProductExit;
                }
                return item;
            });
            localStorage.setItem("carts", JSON.stringify(newCart));
            totalPriceHandle();
            renderContenCart();
            break;
        }
        case "desc": {
            if(count == 1) {
                alert("Số lượng không thể nhỏ hơn 1");
                return;
            }
            count  = count - 1;
            let carts = JSON.parse(localStorage.getItem("carts"));
            let checkProductExit = carts.find(
                (item) => parseInt(item.Ma) === parseInt(Ma)
              );
              console.log(checkProductExit)
            if(!checkProductExit) return;
            checkProductExit.count = count;
            const newCart = carts.map((item) => {
                if (item.Ma === checkProductExit.Ma) {
                return checkProductExit;
                }
                return item;
            });
            localStorage.setItem("carts", JSON.stringify(newCart));
            totalPriceHandle();
            renderContenCart();
            break;
        }
    }

}