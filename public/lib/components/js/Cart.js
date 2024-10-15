class Cart {
  constructor() {
    this.selectorWrapperCart = $(".cart-wrapper");
    this.cartItem = ".cart-item";
  }
  addToCart($this) {
    const ghichu = $("#ghichuinput").val();
    let quantity = 0;
    if($("#qtym")){
       quantity = $("#qtym").val();
    }else{
      quantity = 0;
    }
    console.log(quantity);

    const inputCartQuantity = document.getElementById("cart_quantity");
    let url = $this.data("url");
    if (inputCartQuantity) {
      const quantity = inputCartQuantity.value;
      url += `?quantity=${quantity}`;
    }
    let swalOption = {
      //  title: "test",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Tiếp tục",
      cancelButtonText: "Bỏ qua",
    };
    $.ajax({
      type: "GET",
      url: url,
      data: {
        ghichu: ghichu,
        quantity: quantity,
      },
      dataType: "json",
      success: function ($data) {
        if ($data.code === 200) {
          $("#popup-cart-mobile").addClass("active");
          $(".backdrop__body-backdrop___1rvky ").addClass("active");
          console.log($data.data);
          $("#image-cart-mobile-1").attr("src", $data.data.avatar_path);
          $("#name-cart-mobile-1").html($data.data.name);
          $("#price-cart-mobile-1").html(
            $data.data.price.toLocaleString() + "₫"
          );
          $("#quantity-cart-mobile-1").html($data.data.quantity);
          // swalOption.title = "Thêm sản phẩm vào giỏ hàng thành công. Bạn có muốn đi đến giỏ hàng ?";
          // swalOption.icon = 'success';
          // Swal.fire(swalOption).then((result) => {
          //     if (result.isConfirmed) {
          //         //let hostname = window.location.hostname;
          //         window.location.href = "/cart/list";
          //     }
          // })
        } else {
          
          swalOption.title =
            "Thêm sản phẩm vào giỏ thất bại !  Bạn có muốn đi đến giỏ hàng ?";
          Swal.fire(swalOption).then((result) => {
            if (result.isConfirmed) {
              //let hostname = window.location.hostname;
              window.location.href = "/cart/list";
            }
          });
        }
      },
      error: function () {},
    });
  }
  buyNow($this) {
    event.preventDefault();
    let url = $this.data("url");
    let quantity = $this.data("quantity");
    let size = $this.data("size");
    let swalOption = {
      icon: "warning",
      showCancelButton: false,
      showConfirmButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      // confirmButtonText: 'Tiếp tục',
      // cancelButtonText: 'Bỏ qua'
    };
    $.ajax({
      type: "GET",
      url: url,
      data: {
        quantity: quantity,
        size: size,
      },
      dataType: "json",
      success: function ($data) {
        if ($data.code === 200) {
          window.location.href = "/cart/list";
          // swalOption.title = "Thêm sản phẩm vào giỏ hàng thành công. Bạn có muốn đi đến giỏ hàng ?";
          // swalOption.icon = 'success';
          // Swal.fire(swalOption).then((result) => {
          //     if (result.isConfirmed) {
          //         //let hostname = window.location.hostname;
          //         window.location.href = "/cart/list";
          //
          //     }
          // })
        } else {
          swalOption.title =
            "Thêm sản phẩm vào giỏ thất bại !  Bạn có muốn đi đến giỏ hàng ?";
          Swal.fire(swalOption).then((result) => {
            if (result.isConfirmed) {
              //let hostname = window.location.hostname;
              window.location.href = "/cart/list";
            }
          });
        }
      },
      error: function () {},
    });
  }
  updateCart($this) {
    event.preventDefault();
    let url = $this.data("url");
    let quantity = $this
      .parents(".cart-item")
      .find("input[name='quantity']")
      .val();
    $.ajax({
      type: "GET",
      url: url,
      data: {
        quantity: quantity,
      },
      dataType: "json",
      success: function (data) {
        if (data.code === 200) {
          $(".cart-wrapper").html(data.htmlcart);
          $("#totalPrice").html(data.totalPrice + '₫');
          alert("Update giỏ hàng thành công");
        } else {
          alert("Update giỏ hàng không thành công");
        }
      },
      error: function () {},
    });
  }
  removeCart($this) {
    event.preventDefault();
    let url = $this.data("url");
    let usePoint = $("#usePoint").val();
    if (usePoint) {
      usePoint = parseInt(usePoint);
    } else {
      usePoint = 0;
    }
    $.ajax({
      type: "GET",
      url: url,
      dataType: "json",
      data: {
        usePoint: usePoint,
      },
      success: function (data) {
        if (data.code === 200) {
          $(".cart-wrapper").html(data.htmlcart);
          $("#totalPrice").html(data.totalPrice + '₫');
          // $('#total-price-cart').text(data.totalPrice);
          alert("Xóa sản phẩm thành công");
        } else {
          alert("Xóa sản phẩm không thành công");
        }
      },
      error: function () {},
    });
  }
  clearCart($this) {
    event.preventDefault();
    let url = $this.data("url");
    $.ajax({
      type: "GET",
      url: url,
      dataType: "json",
      success: function (data) {
        if (data.code === 200) {
          $(".cart-wrapper").html(data.htmlcart);
          $("#totalPrice").html(data.totalPrice);
          //  $('#total-price-cart').text(data.totalPrice);
          alert("Xóa giỏ hàng thành công");
        } else {
          alert("Xóa giỏ hàng không thành công");
        }
      },
      error: function () {},
    });
  }
}

let cart = new Cart();
$(document).on("click", ".add-to-cart", function () {
  $this = $(this);
  cart.addToCart($this);
});
$(document).on("click", ".buy-now", function () {
  $this = $(this);
  cart.buyNow($this);
});
$(document).on("click", ".update-cart", function () {
  $this = $(this);
  cart.updateCart($this);
});
$(document).on("click", ".remove-cart", function () {
  $this = $(this);
  cart.removeCart($this);
});
$(document).on("click", ".clear-cart", function () {
  $this = $(this);
  cart.clearCart($this);
});

$(document).on("click", ".cart_btn-close", function () {
  $("#popup-cart-mobile").removeClass("active");
  $(".backdrop__body-backdrop___1rvky").removeClass("active");
});
$(document).on("click", ".quantity-cart .prev-cart", function () {
  let input = $(this).parents(".quantity-cart").find("input[type='number']");
  let value = parseFloat(input.val()) - 1;
  if (value < 1) {
    input.val(1);
  } else {
    input.val(value);
  }
  input.trigger("change");
});
$(document).on("click", ".quantity-cart .next-cart", function () {
  let input = $(this).parents(".quantity-cart").find("input[type='number']");
  let value = parseFloat(input.val()) + 1;
  input.val(value);
  input.trigger("change");
});
$(document).on("change", ".number-cart", function () {
  let url = $(this).data("url");
  let quantity = $(this)
    .parents(".cart-item")
    .find("input[name='quantity']")
    .val();
  let usePoint = $("#usePoint").val();
  if (usePoint) {
    usePoint = parseInt(usePoint);
  } else {
    usePoint = 0;
  }
  $.ajax({
    type: "GET",
    url: url,
    data: {
      quantity: quantity,
      usePoint: usePoint,
    },
    dataType: "json",
    success: function (data) {
      if (data.code === 200) {
        $(".cart-wrapper").html(data.htmlcart);
        $("#totalPrice").html(data.totalPrice);
        // $('#total-price-cart').text(data.totalPrice);
        // $('#total-price-money-cart').text(data.totalPriceMoney);
        // $('#total-price-point-cart').text(data.totalPricePoint);
        // alert('add to cart success');
      } else {
        alert("add to cart error");
      }
    },
    error: function () {},
  });
});
$(document).on("change", "#usePoint", function () {
  let url = $(this).data("url");
  let usePoint = parseInt($(this).val());
  if (usePoint) {
    usePoint = parseInt(usePoint);
  } else {
    usePoint = 0;
  }
  $.ajax({
    type: "GET",
    url: url,
    data: {
      usePoint: usePoint,
    },
    dataType: "json",
    success: function (data) {
      if (data.code === 200) {
        $(".cart-wrapper").html(data.htmlcart);
        // $('#total-price-cart').text(data.totalPrice);
        // $('#total-price-money-cart').text(data.totalPriceMoney);
        // $('#total-price-point-cart').text(data.totalPricePoint);
        // alert('add to cart success');
      } else {
        alert("update cart error");
      }
    },
    error: function () {},
  });
});
