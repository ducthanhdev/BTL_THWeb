let carts = JSON.parse(localStorage.getItem("carts") || "null");
const countCart = document.querySelector("#count-cart");

if (!carts) {
  localStorage.setItem("carts", JSON.stringify([]));
  carts = [];
}

const btns = document.querySelectorAll(".btn-add-to-cart");
btns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    let carts = JSON.parse(localStorage.getItem("carts"));
    const productAddtoCart = JSON.parse(e.currentTarget.dataset.product);
    if (!productAddtoCart) return;
    let checkProductExit = carts.find(
      (item) => item.Ma === productAddtoCart.Ma
    );
    if (!checkProductExit) {
      productAddtoCart.count = 1;
      carts.push(productAddtoCart);
      localStorage.setItem("carts", JSON.stringify(carts));
    } else {
      checkProductExit.count = checkProductExit.count + 1;
      const newCart = carts.map((item) => {
        if (item.Ma === checkProductExit.Ma) {
          return checkProductExit;
        }
        return item;
      });
      localStorage.setItem("carts", JSON.stringify(newCart));
    }
    countCartHandler();
  });
});

function countCartHandler() {
  countCart.innerHTML = JSON.parse(
    localStorage.getItem("carts") || "[]"
  ).length;
}
countCartHandler();



