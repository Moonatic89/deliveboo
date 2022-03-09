<template>
  <div class="container mx-auto">
    <div class="categorie-disponibili pt-5" id="order_now">
      <div class="line"></div>
      <div class="titolo-ristorante">Seleziona le categorie</div>
      <div class="line"></div>
    </div>

    <div class="categoryContainer py-5">
      <div
        class="
          d-flex
          flex-wrap
          align-items-center
          justify-content-center
          seleziona-categorie
        "
      >
        <div
          class="m-2 category-input"
          v-for="(category, i) in categories"
          :key="i"
        >
          <div class="category-card" style="width: 15rem">
            <img
              :src="'./img/categories_images/' + category.category_image"
              alt="Card
            image cap"
            />
            <div class="category-body">
              <input
                type="checkbox"
                class="categories"
                :id="category.id"
                :value="category.id"
                v-model="checkedCat"
                @change="getRestaurants()"
              />

              <label :for="category.id">{{ category.name }}</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories -->

    <div class="risotranti-disponibili pt-5" id="order_now">
      <div class="line"></div>
      <div class="titolo-ristorante">Scegli i ristoranti</div>
      <div class="line"></div>
    </div>

    <div class="restaurantContainer py-5">
      <div
        class="
          row row-cols-2 row-cols-md-4 row-cols-xl-5
          gy-4
          w-100
          justify-content-center
        "
      >
        <div
          class="restaurant-card col-12 col-sm-12 col-md-4 p-0 mx-2"
          v-for="restaurant in restaurants"
          :key="restaurant.id"
        >
          <a :href="'/restaurants/' + restaurant.slug">
            <img
              :src="
                restaurant.restaurant_image
                  ? '/storage/' + restaurant.restaurant_image
                  : 'https://demofree.sirv.com/nope-not-here.jpg'
              "
              :alt="restaurant.name"
            />
            <div class="restaurant-info">
              <h4 class="mb-2">{{ restaurant.name }}</h4>
              <p class="desc">{{ restaurant.description }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      restaurants: [],
      categories: [],
      checkedCat: [],
      loading: true,
      meta: null,
      links: null,
    };
  },
  methods: {
    getCategories() {
      axios
        .get("/api/categories")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getRestaurants() {
      if (this.checkedCat.length === 0) {
        axios
          .get("/api/restaurants")
          .then((response) => {
            this.restaurants = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        axios
          .get("/api/restaurants/filter/", {
            params: {
              category: this.checkedCat,
            },
          })
          .then((response) => {
            this.restaurants = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  mounted() {
    this.getCategories();
    this.getRestaurants();
  },
};
</script>

<style lang="scss" scoped>
.categorie-disponibili,
.risotranti-disponibili {
  display: flex;
  justify-content: center;
  text-align: center;
}

.category-card {
  position: relative;
  border-radius: 0.5rem;
  overflow: hidden;
  img {
    width: 100%;
    object-fit: cover;
    height: 7.5rem;
    aspect-ratio: 4/3;
  }
  .category-body {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    label {
      background-color: #fece2c;
      box-shadow: -5px 6px 0px 1px #3b3b3b;
      -webkit-box-shadow: -5px 6px 0px 1px #3b3b3b;
      border-radius: 0;
      padding: 0.2rem 0.8rem;
      color: #3b3b3b;
      font-size: 1.2rem;
      font-weight: 500;
      text-transform: uppercase;
      cursor: pointer;
    }

    input.categories {
      display: none;
    }

    input.categories:checked + label {
      color: #fece2c;
      background-color: #3b3b3b;
      box-shadow: -5px 6px 0px 1px #fece2c;
      -webkit-box-shadow: -5px 6px 0px 1px #fece2c;
    }
  }
}

.titolo-ristorante {
  align-items: center;
  font-size: 25px;
  font-weight: bold;
  margin-left: 10px;
  margin-right: 10px;
}

.line {
  height: 5px;
  width: 140px;
  background-color: #fece2c;
  align-items: center;
  margin-top: 15px;
}

.restaurant-card {
  width: 235px;
  height: 270px;
  border-radius: 5px;
  position: relative;
  text-align: center;
  overflow: hidden;

  a {
    color: #fff;
    text-decoration: none;

    img {
      width: 235px;
      height: 270px;
      border-radius: 5px;
      object-fit: cover;
      transition: 0.3s ease;
      filter: brightness(0.8);
    }

    .restaurant-info {
      h4 {
        transition: 0.4s ease;
        width: 100%;
        position: absolute;
        left: 50%;
        bottom: -2rem;
        transform: translateX(-50%);
        text-align: center;
        text-shadow: 1px 1px 4px rgb(0 0 0 / 50%);
        line-height: 10.8rem;
      }
      .desc {
        padding: 0 1.5rem;
        transition: 0.4s ease;
        position: absolute;
        left: 0;
        top: 17rem;
        color: #fff;
        display: -webkit-box;
        -webkit-line-clamp: 7;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
    }

    &:hover img {
      transform: scale(1.2);
      overflow: hidden;
      object-fit: cover;
      object-position: center;
      filter: blur(1px) brightness(0.4);
    }

    &:hover h4 {
      bottom: 8rem;
    }

    &:hover .desc {
      top: 4.5rem;
    }
  }
}
</style>
