require('./bootstrap');

window.Vue                  = require('vue');
Vue.prototype.$lang         = document.documentElement.getAttribute('lang');
Vue.prototype.$currency     = document.documentElement.getAttribute('currency');
Vue.prototype.$currencyRate = document.documentElement.getAttribute('currency-rate');
Vue.prototype.$mainCurrency = document.documentElement.getAttribute('main-currency');
Vue.prototype.$device       = document.documentElement.getAttribute('device');
Vue.prototype.trans         = trans;

export const bus = new Vue();
import BootstrapVue from 'bootstrap-vue';
import Fragment     from 'vue-fragment';

Vue.component('google-events-mob', require('./components/front/GoogleComponent.vue'));

// home components
Vue.component('home-sliders-mob',           require('./components/front/home/HomeSliders.vue'));
Vue.component('home-slider-category-mob',   require('./components/front/home/HomeSliderCategory.vue'));
Vue.component('home-slider-collection-mob', require('./components/front/home/HomeSliderCollection.vue'));
// product/sets components
Vue.component('category-mob',           require('./components/front/CategoryComponent.vue'));
Vue.component('parameters-filter-mob',  require('./components/front/ParametersFilterComponent.vue'));
Vue.component('new-mob',                require('./components/front/NewComponent.vue'));
Vue.component('sale-mob',               require('./components/front/SaleComponent.vue'));
Vue.component('product-mobile',         require('./components/front/ProductComponent.vue'));
Vue.component('promo-sets-mobile',      require('./components/front/PromoSets.vue'));

// Vue.component('collection-mobile',      require('./components/front/CollectionComponent.vue'));
// Vue.component('set-mobile',             require('./components/front/SetComponent.vue'));

// cart components
Vue.component('cart-mob',           require('./components/front/cart/CartComponent.vue'));
Vue.component('cart-summary-mob',   require('./components/front/cart/CartSummary.vue'));
Vue.component('cart-counter-mob',   require('./components/front/cart/CartCounter.vue'));
// auth components
Vue.component('reset-password-mob', require('./components/front/auth/ResetPasswordComponent.vue'));
Vue.component('auth-mob',           require('./components/front/auth/Auth.vue'));
// order components
Vue.component('order-mob',          require('./components/front/OrderShippingComponent.vue'));
Vue.component('order-payment-mob',  require('./components/front/OrderPaymentComponent.vue'));
Vue.component('alerts-mob',         require('./components/front/AlertsComponent.vue'));
Vue.component('settings-btn-mob', require('./components/front/SettingsButon.vue'));
Vue.component('settings-modal-mob', require('./components/front/SettingsModal.vue'));

Vue.component('collection', require('./components/front/collections/Collections.vue'));
Vue.component('set', require('./components/front/collections/Set.vue'));
Vue.component('set-modal', require('./components/front/collections/SetModal.vue'));
Vue.component('search',  require('./components/front/Search.vue'));


const app = new Vue({
    el: '#cover-mob'
});
