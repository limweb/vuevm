import Vue from "./vue.js";
window.Vue = Vue;
import Vuex from "./vuex.js"; // import Vue from "./vue.js";
import VueRouter from "./vue-router.js";
import axios from "./axios.js";
import elementui from "./elementui.js";
import th from "./th.js";
// import veeValidate from "./vee-validate.js";
// import vuePage from "./vue-pagination.js";
// import vuels from "./vue-ls.js";
import collectjs from "../node_modules/collect.js/dist/index.js";
// // window.VueRouter = VueRouter;
// // window.Vue.prototype.$collect = collectjs;
// // Vue.use(VueRouter);
Vue.prototype.$collect = collectjs;
window.vm = new Vue({
    data() {
        return { msg: "aaaaaaaaaaaaa" };
    }
});
vm.$mount("#app");