export default {
    template: `<div>
            <h1>Home</h1>
            <br/>
            <pre>{{$route.path}}</pre>
            <br/>
            <a href="/logout">Logout</a>
            <br/>
            <router-link to="/login">Login</router-link>
            <br/>
            <router-link to="/homea">Homea</router-link>
            <br/>
            <router-link to="/homeb">Homeb</router-link>
            <br/>
            <router-link to="/homec">Homec</router-link>
            <br/>
            <router-link to="/homed">Homed</router-link>
            <br/>
            <router-link to="/homee">Homee</router-link>
            <br/>
            <router-link to="/colors">color</router-link>
            <br/>
    
    </div>`,
    name: "Home",
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