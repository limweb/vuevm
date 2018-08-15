console.log("app in root");
// const User = {
//     props: ["id"],
//     template: "<div>User {{ id }}</div>"
// };
// const NotFoundComponent = { template: "<div>Not found</div>" };
import JsonExcel from "./components/JsonExcel.js";
import Printa4table from "./components/Printa4table.js";
// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
import { store } from "./store/store.js";
import { router } from "./route/route.js";
import EventBus from "./mixins/eventBus.js";
const Test = "AAAAA";
// import collectjs from "./node_modules/collect.js/dist/index.js";
// import collectjs from "./modules/collect.js";
// console.log("collectjs", collectjs);
// Vue.prototype.$collect = collectjs;
//---- Vue add Plugin ------------------------------------------------
router.beforeEach((to, from, next) => {
    console.log("beforeEach");
    // can use store at this
    if (to.path == "/noroute") {
        next(false);
    } else {
        store.commit("show");
        console.log("overlay ------------>block", store.state.overlay);
        next();
    }
});

router.afterEach(route => {
    console.log("afterEach", route);
    store.commit("hide");
});

router.onError(err => {
    console.log("Handling this error", err);
});

console.log("---- Vue add Plugin --------------------------------------");
Object.defineProperties(Vue.prototype, {
    $bus: {
        get: function() {
            return EventBus;
        }
    }
});
// const vueConfig = require("vue-config");
let configs = {
    // API: "http://localhost:8000", // It's better to require a config file,
    API: "/", // It's better to require a config file,
    NODE_ENV: "development"
};
Vue.prototype.$config = configs;

//-------------- axios ---------------------------------start
if (configs.NODE_ENV == "development") {
    // console.log(process.env.NODE_ENV );
    console.log("development");
    var axoisinstance = axios.create({
        baseURL: configs.API,
        timeout: 10 * 60 * 1000,
        headers: { "X-Custom-Header": "foobar" }
    });
} else {
    console.log("production");
    // console.log(process.env.NODE_ENV );
    var axoisinstance = axios.create({
        baseURL: window.location.protocol + "//" + window.location.host,
        timeout: 1000,
        headers: { "X-Custom-Header": "foobar" }
    });
}
Vue.prototype.$http = axoisinstance;
Vue.prototype.$download = download;
Vue.prototype.$moment = moment;
ELEMENT.locale(ELEMENT.lang.th);
Vue.use(VeeValidate);
Vue.use(VueLocalStorage);
Vue.component("paginate", VuejsPaginate);
Vue.component("downloadExcel", JsonExcel);

console.log("-----start----vue---------instance");
window.vm = new Vue({
    router: router,
    store: store,
    mixins: [],
    data() {
        return {
            phpurl: phpurl
        };
    },
    el: "#app",
    methods: {},
    computed: {},
    watch: {},
    components: {
        printa4table: Printa4table
    },
    beforeCreate() {},
    created() {
        console.log("-----oncreated------");
        this.test = Test;
    },
    beforeMount() {},
    mounted() {
        this.$nty = new Notyf();
    },
    beforeUpdate() {},
    updated() {},
    beforeDestroy() {},
    destroyed() {}
});
console.log("-----start---------vue js vm", vm);
var version = Vue.version;
console.log("vue version is:", version);