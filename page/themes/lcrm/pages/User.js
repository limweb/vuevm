export default {
    template: `<div><h1>User Page</h1></div>`,
    name: "Userpage",
    data() {
        return {};
    },
    computed: {},
    mounted() {
        this.$nextTick(async() => {
            // await this.$store.commit("hide");
            // console.log("mounted----Home>", this.$store.state.overlay, this.$route);
            // console.log("page--------------------->", this.$options.name);
            window.vc = this;
        });
    },
    beforeRouteEnter(to, from, next) {
        console.log("route เข้า component ", this);
        // Pass a callback to next (optional)
        next(vm => {
            // this callback has access to component instance (ie: 'this') via `vm`
            vm.$nextTick(() => {
                console.log("check vm", vm);
                // vm.$root.$refs.overlay.style.display = "none";
                vm.$store.commit("hide");
                console.log("mounted----Home>", vm.$store.state.overlay, vm.$route);
                console.log("page--------------------->", vm.$options.name);
            });
        });
    }
};