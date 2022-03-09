/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('restaurants', require('./components/Restaurants.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);
Vue.component('product-component', require('./components/ProductsComponent.vue').default);
Vue.component('order-cart', require('./components/OrderCartComponent.vue').default);
Vue.component('steps', require('./components/Steps.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: {
        cart: [],
        newCart: null,
        total: 0,
        quantità: 0,
        restaurant: Number,
    },

    created() {
        const el = document.getElementById('custom-data')
        if (el != null) {
            const profiles = JSON.parse(el.dataset.profiles)
            this.restaurant = profiles
        }
    },

    methods: {
        /* Prende il singolo prodotto e lo aggiunge all'array cart se non è presente */
        AddNewCart(product) {
            if (!this.cart.some(e => e.id === product.id)) {
                product.qty = 1;
                this.cart.push(product);
            }
        },

        totalCart() {
            this.total = 0;
            for (let i = 0; i < this.cart.length; i++) {
                this.total += this.cart[i].price * this.cart[i].qty;
            }
            return this.total;
        },

        refreshQty(qty) {
            this.quantità += qty;
        },

        changeLocalStorage() {
            if (localStorage.getItem("cart")) {
                if (JSON.parse(localStorage.getItem("cart")).length > 0) {
                    if (
                        JSON.parse(localStorage.getItem("cart"))[0].restaurant_id ==
                        this.restaurant
                    ) {
                        console.log("cart overwritten");
                        this.cart = JSON.parse(localStorage.cart);
                    }
                }
            }
        },

    },

    watch: {

        restaurant: function () {
            this.changeLocalStorage();
        },

        cart: function () {
            this.totalCart();
        },
        quantità: function () {
            this.totalCart();
        },
    },



});
