<template>
  <!-- stampo il singolo prodotto del ristorante -->
  <div class="col-12 col-lg-4 col-xl-3 product shadow p-0 me-3">
    <figure class="m-0">
      <img
        v-if="!product.product_image"
        src="http://127.0.0.1:8000/img-prova/panino1.png"
        :alt="product.name"
        class="product-image"
      />
      <img
        v-else
        :src="'/storage/' + product.product_image"
        :alt="product.name"
        class="product-image"
      />
    </figure>
    <div class="info-product ps-2 pt-2">
      <h4 class="m-0">{{ product.name }}</h4>
      <p class="my-2">{{ product.ingredients }}</p>
      <div class="d-flex justify-content-between align-items-center">
        <p class="m-0 fw-bold">{{ product.price }} €</p>
        <div class="add" @click="add_product()">
          <i class="fas fa-cart-plus"></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: {},
  },

  methods: {
    /* passo il prodotto al carello */
    add_product() {
      this.$emit("add-cart", this.product);
    },
  },
};
</script>

<style lang="scss" scoped>
.product {
  max-width: 309px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  .product-image {
    width: 100%;
    max-height: 150px;
    object-fit: cover;
  }

  .add {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fece2c;
    font-size: 1rem;
    color: #fff;
    cursor: pointer;
    transition: 0.3s ease;

    &:hover {
      background-color: #ca1d1f;
      font-size: 1.1rem;
    }
  }
}
</style>