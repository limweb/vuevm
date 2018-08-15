Vue.use(Vuex);

export const store = new Vuex.Store({
    namespaced: true,
    state: {
        key: 123,
        overlay: "block"
    },
    mutations: {
        show(state) {
            console.log("store-----commit--show");
            state.overlay = "block";
        },
        hide(state) {
            console.log("store-----commit--hide");
            state.overlay = "none";
        }
    },
    getters: {
        overlaystyle: state => {
            let ovr = { display: state.overlay };
            return ovr;
        }
    },
    modules: {}
});