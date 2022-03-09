<template>
  <!-- Stampo il singolo prodotto del carello-->
  <div v-if="cart.length > 0">
    <div class="cart shadow p-3 bg-body rounded">
      <h5 class="text-center mb-4">Il tuo ordine</h5>
      <div v-for="(product, i) in cart" :key="i">
        <div class="d-flex justify-content-between">
          <p class="m-0">{{ product.name }}</p>
          <p class="m-0">{{ product.price }} €</p>
        </div>

        <!-- funzione per selezionare la quantità -->
        <div class="QtyBtn">
          <div>
            <button
              @click="
                remove_qty(product, cart);
                refreshQty(product.qty);
              "
              id="lessQty"
              class="btn-minus"
            >
              <span>-</span>
            </button>
            <span id="coutnerQty">{{ product.qty }}</span>
            <button
              @click="
                add_qty(product);
                refreshQty(product.qty);
              "
              id="moreQty"
              class="btn-plus"
            >
              <span>+</span>
            </button>
          </div>

          <i
            class="fas fa-trash-alt"
            style="color: #ca1d1f; font-size: 20px"
            @click="removeProduct(product, cart)"
          ></i>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mt-4">
        <span class="totale">Totale: {{ total.toFixed(2) }} €</span>
        <a href="/checkout">
          <button type="submit" class="button-checkout">
            Procedi all'ordine
          </button>
        </a>
      </div>
    </div>
  </div>

  <div v-else class="opacity shadow p-3 bg-body rounded">
    <h5 class="text-center mb-4">Il tuo carrello è vuoto</h5>
    <div class="d-flex justify-content-center">
      <i
        class="fas fa-shopping-basket text-center"
        style="color: #3b3b3b; font-size: 40px"
      ></i>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      success: false,
      error: false,
    };
  },
  props: {
    cart: [],
    total: Number,
  },

  methods: {
    onSuccess(message) {
      this.success = true;
    },

    onFailure(message) {
      this.error = true;
    },

    removeProduct(product, cart) {
      var index = cart.findIndex(function (element) {
        return element.id === product.id;
      });
      if (index !== -1) cart.splice(index, 1);
    },

    /* less qty product */
    remove_qty(product, cart) {
      product.qty--;
      if (product.qty <= 0) {
        this.removeProduct(product, cart);
      }
    },

    /* more qty product */
    add_qty(product) {
      product.qty++;
    },

    refreshQty(qty) {
      this.$emit("refresh-qty", qty);
    },
  },
  watch: {
    cart: {
      handler(product) {
        localStorage.cart = JSON.stringify(product);
      },
      deep: true,
    },
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
      }

      #coutnerQty {
        margin: 0 1rem;
      }
    }

    .fa-trash-alt:hover {
      cursor: pointer;
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

.opacity {
  opacity: 0.5;
  cursor: no-drop;
}
</style>