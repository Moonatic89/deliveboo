<template>
  <div class="cart shadow p-3 bg-body rounded">
    <h5 class="text-center mb-4">Carrello</h5>
    <div id="cart">
      <!-- One Product -->
      <div v-show="cart.length > 0" v-for="product in cart" :key="product.id">
        <div class="d-flex justify-content-between">
          <p class="m-0">{{ product.name }}</p>
          <p class="m-0">{{ product.price }} €</p>
        </div>
        <!-- funzione per selezionare la quantità -->

        <div class="QtyBtn">
          <div>
            <div @click="remove_qty(product)" id="lessQty" class="btn-minus">
              -
            </div>
            <span id="coutnerQty">{{ product.qty }}</span>
            <div @click="add_qty(product)" id="moreQty" class="btn-plus">+</div>
          </div>
        </div>
      </div>

      <!-- Pass array cart to $request -->
      <div
        class="card-footer d-flex justify-content-between align-items-center"
      >
        <h6>TOTALE:</h6>
        <span v-if="total > 0" class="fw-bold">{{ total.toFixed(2) }} €</span>
      </div>
      <input
        type="hidden"
        id="cart-data"
        name="cart"
        :value="JSON.stringify(cart)"
      />

      <input type="hidden" id="amount-data" name="amount" :value="total" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cart: [],
      total: Number,
    };
  },

  methods: {
    totalCart() {
      this.total = 0;
      for (let i = 0; i < this.cart.length; i++) {
        this.total += this.cart[i].price * this.cart[i].qty;
      }
      return this.total;
    },

    add_qty(product) {
      product.qty++;
      if (product.qty > 100) {
        product.qty = 100;
      }
      this.totalCart();
    },

    remove_qty(product) {
      product.qty--;
      if (product.qty < 0) {
        product.qty = 0;
      }
      this.totalCart();
    },

    getCart() {
      /* Cart */
      if (localStorage.getItem("cart")) {
        if (JSON.parse(localStorage.getItem("cart")).length > 0) {
          this.cart = JSON.parse(localStorage.cart);
          console.log(this.cart);
        }
      }
    },
  },

  mounted() {
    this.getCart();
    this.totalCart();
  },
};
</script>

<style lang="scss" scoped>
.cart {
  .QtyBtn {
    display: flex;
    justify-content: space-between;
    margin: 0.3rem 0 1rem 0;

    div {
      display: flex;
      justify-content: center;
      align-items: center;

      .btn-minus,
      .btn-plus {
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        border-radius: 50%;
        border: 2px solid #fece2c;
        color: #fece2c;
        font-size: 1.3rem;
        cursor: pointer;
      }

      #coutnerQty {
        margin: 0 1rem;
      }
    }
  }

  .totale {
    font-weight: bold;
    font-size: 1rem;
    margin-top: 5px;
  }

  .button-checkout {
    background-color: #fece2c;
    box-shadow: -5px 6px 0px 1px #3b3b3b;
    -webkit-box-shadow: -5px 6px 0px 1px #3b3b3b;
    border: 0;
    border-radius: 0;
    text-align: center;
    color: #3b3b3b;
    transition: 0.3s ease;

    &:hover {
      color: #fece2c;
      background-color: #3b3b3b;
      box-shadow: -5px 6px 0px 1px #fece2c;
      -webkit-box-shadow: -5px 6px 0px 1px #fece2c;
    }
  }
}
</style>
