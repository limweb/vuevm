// import Paymentslog from "../pages/Paymentslog.js";
// import Setting from "../pages/Setting.js";
// import Contact from "../pages/Contact.js";
// import Invoice from "../pages/Invoices.js";
// import Template from "../pages/Template.js";

const Invoice = () =>
    import ("../pages/Invoices.js");
const Crudtemplate = () =>
    import ("../pages/Crudtemplate.js");
const Setting = () =>
    import ("../pages/Setting.js");
const Contact = () =>
    import ("../pages/Contact.js");
const Template = () =>
    import ("../pages/Template.js");
const Homepage = () =>
    import ("../pages/Home.js");
const Dashboard = () =>
    import ("../pages/Daseboard.js");
const Userpage = () =>
    import ("../pages/User.js");
const Login = () =>
    import ("../pages/Login.js");
const Columns = () =>
    import ("../pages/Columns.js");
const Zortq = () =>
    import ("../pages/Zortq.js");
const Dbinfos = () =>
    import ("../pages/Dbinfos.js");
const Apikeys = () =>
    import ("../pages/Apikeys.js");
const Smscredittr = () =>
    import ("../pages/Smscredittr.js");
const Logcomship = () =>
    import ("../pages/Logcomship.js");
const Creditshipcom = () =>
    import ("../pages/Creditshipcom.js");
const Smslog = () =>
    import ("../pages/Smslog.js");
const Curdtable = () =>
    import ("../pages/Crudtable.js");
const Menus = () =>
    import ("../pages/Menus.js");

const User = {
    props: ["id"],
    template: "<div>User {{ id }}</div>"
};
const NotFoundComponent = { template: "<div>Not found</div>" };

const routes = [
    // { path: "/payment_logs", component: Paymentslog },
    // { path: "/setting", component: Setting },
    // { path: "/sales_team", component: Contact },
    // { path: "/user/:id", component: User, props: true },
    { path: "/login", name: "login", component: Login },
    { path: "*", name: "*", component: Homepage }
    // { path: "*", component: NotFoundComponent }
];

phproute.map(i => {
    console.log(i);
    routes.push({
        path: "/" + i.permalink,
        name: i.permalink,
        component: eval(i.component)
    });
    console.log(i.component);
});

// routes.push({ path: "/*", component: Homepage });

console.log("routes--", routes);
// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
export const router = new VueRouter({
    mode: "history",
    routes: routes,
    scrollBehavior: function(to, from, savedPosition) {
        return savedPosition || { x: 0, y: 0 };
    }
});