export default {
    template: ` <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 signin-form">
                <div class="panel-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">
                                <!-- brand -->
                                <img src="data:image/webp;base64,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" alt="LCRM">
                                <!-- / brand -->
                            </h2>
                        </div>
                    </div>
                </div>
                                    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="box-color">
                    <h4>Sign in with your Account</h4>
                    <br>
                    <form method="POST" action="http://demo.lcrmapp.com/signin" accept-charset="UTF-8" name="form"><input name="_token" type="hidden" value="O3aKTioElVKHMHuZ2b1S68wrQeI7fxiOOK7dCNAa">
                    <div class="form-group ">
                        <label for="E-Mail Address">E-Mail Address</label> :
                        <span></span>
                        <input class="form-control" required="required" placeholder="E-mail" name="email" type="email">
                    </div>
                    <div class="form-group ">
                        <label for="Password">Password</label> :
                        <span></span>
                        <input class="form-control" required="required" placeholder="Password" name="password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="remember" value="remember" name="remember">
                            <i class="primary"></i> Keep me signed in
                        </label>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                    </form>
                </div>
                <hr class="separator">
                <div class="text-center">
                    <h5><a href="http://demo.lcrmapp.com/forgot" class="forgot_pw _600">Forgot Password?</a></h5>
                </div>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>

</div> `,
    name: "Home",
    data() {
        return {};
    },
    mounted() {
        this.$nextTick(async() => {
            await this.$store.commit("hide");
            console.log("mounted----Home>", this.$store.state.overlay, this.$route);
            console.log("page--------------------->", this.$options.name);
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
            });
        });
    }
};