export default {
    name: "CrudMixin",
    beforeRouteEnter(to, from, next) {
        console.log("route เข้า component ", this);
        // Pass a callback to next (optional)
        next(vm => {
            // this callback has access to component instance (ie: 'this') via `vm`
            vm.$nextTick(() => {
                console.log("check vm", vm);
                // vm.$root.$refs.overlay.style.display = "none";
            });
            vm.getdatas();
        });
    },

    beforeRouteLeave(to, from, next) {
        console.log("่ก่อน ออก จาก Component นี้ ");

        if (this.update_save || this.insert_save) {
            if (confirm("ข้อมุูลที่แก้ไข ยังไม่ saved ต้องการ saveก่อน หรือไม่ ? ")) {
                next(false);
            } else {
                this.update_save = false;
                this.insert_save = false;
                next(vm => {
                    // vm.$roo.$refs.overlay.style.display = "block";
                });
            }
        } else {
            this.update_save = false;
            this.insert_save = false;
            next(vm => {
                // vm.$roo.$refs.overlay.style.display = "block";
            });
        }
    },
    methods: {
        fcvisible(vi) {
            if (vi) {
                return "Visible";
            } else {
                return "Invisible";
            }
        },
        fcstatus(sta) {
            if (sta) {
                return "Active";
            } else {
                return "Inactive";
            }
        },
        hideoverlay() {
            this.$store.commit("hide");
        },
        validateinsert(item) {
            if (item.required) {
                return item.required;
            } else {
                return "";
            }
        },
        validateupdate(item) {
            if (item.required) {
                return item.required;
            } else {
                return "";
            }
        },
        getkw() {
            return this.filtertxt;
        },
        getdatas() {
            this.$store.commit("show");
            let url = "";
            console.log("checkajax", this.ajax);
            if (this.ajax) {
                url =
                    "/api/v3" +
                    this.$route.path +
                    "/all/" +
                    this.page +
                    "/" +
                    this.perpage +
                    "/" +
                    this.ajax +
                    "/" +
                    this.getkw();
            } else {
                url = "/api/v3" + this.$route.path + "/all";
            }

            console.log("route---->url-->", url);
            this.$http
                .get(url)
                .then(response => {
                    console.log("response--->", response);
                    Object.keys(response.data).map(key => {
                        this[key] = response.data[key];
                    });
                    // this.datas = response.data.datas;
                    // this.columns = response.data.columns;
                    // this.infos = response.data.info;
                    this.title = response.data.info.title;
                    let sortOrders = {};
                    this.columns.map(r => {
                        sortOrders[r.key] = 1;
                    });
                    this.sortOrders = sortOrders;
                    this.$store.commit("hide");
                })
                .catch(err => {
                    console.log(err);
                    this.$store.commit("hide");
                });
            Object.keys(this.viewstate).map(i => {
                this.viewstate[i] = false;
            });
            this.viewstate["v_lists"] = true;
        },
        updated() {
            console.log("updatedata--->", this.row_update);
            this.validateobj = {};
            this.columns.map(i => {
                if (i.required && i.key != "id") {
                    this.validateobj[i.key] = this.row_update[i.key];
                }
            });
            this.$validator
                .validateAll(this.validateobj)
                .then(result => {
                    if (result) {
                        if (!this.update_save) {
                            this.changeview("v_lists");
                            return;
                        }
                        this.update_save = false;
                        delete this.row_update.clone;
                        let data = JSON.stringify(this.row_update);
                        let url =
                            "/api/v3" + this.$route.path + "/update/" + this.row_update.id;
                        console.log("url==", url);
                        this.$http
                            .put(url, data, {
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(rs => {
                                console.log("result--->", rs);
                                this.changeview("v_lists");
                            })
                            .catch(err => {
                                console.log(err);
                                this.changeview("v_lists");
                            });
                    } else {
                        alert("กรุณากรอกข้อมูลให้ครบ");
                    }
                })
                .catch(console.log);
        },
        inserted() {
            console.log(this.row_insert);
            this.validateobj = {};
            this.columns.map(i => {
                if (i.required && i.key != "id") {
                    this.validateobj[i.key] = this.row_insert[i.key];
                }
            });
            this.$validator
                .validateAll(this.validateobj)
                .then(result => {
                    console.log(result);
                    if (result) {
                        let url = "/api/v3" + this.$route.path + "/insert";
                        console.log("url insert==", url);
                        let data = JSON.stringify(this.row_insert);
                        this.insert_save = false;
                        this.$http
                            .post(url, data, {
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(rs => {
                                console.log("rs--->", rs);
                                this.datas.push(rs.data.data);
                                this.row_insert = {};
                                this.changeview("v_lists");
                            })
                            .catch(err => {
                                this.row_insert = {};
                                console.log("error-->", err);
                                this.changeview("v_lists");
                            });
                    } else {
                        alert("กรุณากรอกข้อมูลให้ครบ");
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        sortBy(col) {
            if (col.orderable) {
                this.sortKey = col.key;
                this.sortOrders[col.key] = this.sortOrders[col.key] * -1;
            }
        },
        checkeall() {
            console.log("check--all", this.checked_all);
            this.datas.map(r => (r.checked = !this.checked_all));
        },
        changeview(view) {
            console.log("view--->", view);
            if (this.chkwatched) {
                this.chkwatched = false;
                this.unwatch();
            }
            //---clear---default ------
            //---clear---default ------
            if (this.viewstate) {
                Object.keys(this.viewstate).map(v => {
                    if (v == view) {
                        this.viewstate[v] = true;
                    } else {
                        this.viewstate[v] = false;
                    }
                });
            }
            window.scrollTo(0, 0);
        },
        changepage(page) {
            console.log("page===>", page);
            this.page = page;
            if (this.ajax) {
                this.getdatas();
            }
        },
        view(row) {
            console.log("view--->", row);
            this.row_view = row;
            this.changeview("v_view");
        },
        deleterow(row) {
            this.row_view = row;
            this.changeview("v_delete");
        },
        insert() {
            console.log("insert-----");
            this.$validator.errors.clear();
            this.columns.map(i => {
                if (i.required && i.key != "id") {
                    this.$validator.attach({ name: i.key, rules: "required" });
                }
            });
            this.row_insert = {};
            this.changeview("v_insert");
            this.watchinsert();
        },
        insertcancel() {
            //====== save ------------------
            this.insert_save = false;
            this.changeview("v_lists");
        },
        deleteyn() {
            //====== save ------------------
            if (confirm("Are you sure want to delete ? ")) {
                console.log("delete----");
                let url = "/api/v3" + this.$route.path + "/delete/" + this.row_view.id;
                console.log("url--->", url);
                this.$http
                    .delete(url, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(rs => {
                        console.log("deleted rs-->", rs);
                        this.datas.map((i, idx) => {
                            console.log(i, idx);
                            if (i.id == rs.data.data.id) {
                                this.datas.splice(idx, 1);
                            }
                        });
                    })
                    .catch(err => {
                        console.log("error--->", err);
                    });
                this.changeview("v_lists");
            }
        },
        updatecancel() {
            this.update_save = false;
            this.row_update = Object.assign(this.row_update, this.row_update.clone);
            delete this.row_update.clone;
            //====== save ------------------
            this.changeview("v_lists");
        },
        edit(row) {
            this.$validator.errors.clear();
            this.row_update = row;
            this.row_update.clone = Object.assign({}, row);
            this.changeview("v_update");
            this.watchupdate();
        },
        updateobj() {
            let data = [];
            this.columns.map(col => {
                // console.log(col)
                if (col.visible) {
                    col.value = this.row_update[col.key];
                    data.push(col);
                }
            });
            return data;
        },
        insertobj() {
            let data = [];
            this.columns.map(col => {
                if (col.visible) {
                    data.push(col);
                }
            });
            return data;
        },
        printv(row) {
            this.changeview("v_print");
        },
        print() {
            window.print();
        },
        watchinsert() {
            this.unwatch = this.$watch(
                "row_insert",
                function(val, oldVal) {
                    console.log("watch row_insert is changed");
                    this.insert_save = true;
                    this.unwatch();
                }, { deep: true }
            );
            this.chkwatched = true;
        },
        watchupdate() {
            this.unwatch = this.$watch(
                "row_update",
                function(val, oldVal) {
                    console.log("watch row_update in changed");
                    this.update_save = true;
                    this.unwatch();
                }, { deep: true }
            );
            this.chkwatched = true;
        },
        exportxlsx() {
            console.log("export slxs");
            return this.$moment().format("YYYYMMDDHHms") + ".xls";
        },
        exportcsv() {
            console.log("export csv");
            return this.$moment().format("YYYYMMDDHHms") + ".csv";
        },
        json_fields() {
            let fields = {};
            this.columns.map(i => {
                if (i.visible) {
                    fields[i.key] = "String";
                }
            });
            return fields;
        },
        exportdatas() {
            let datas = this.datas.filter(i => i.checked);
            console.log("datalength=", datas.length);
            return datas;
        },
        search() {
            console.log("search");
            if (this.filtertxt && this.ajax) {
                this.getdatas();
            }
        },
        changeperpage() {
            console.log("changeperpage");
            if (this.ajax) {
                this.getdatas();
            }
        }
    },
    created() {
        console.log("mixins created");
        window.vc = this;
        // console.log = () => {};
    },
    data() {
        return {
            viewstate: {
                v_lists: true,
                v_insert: false,
                v_view: false,
                v_update: false,
                v_delete: false,
                v_print: false,
                v_import: false,
                v_export: false
            },
            sortOrders: {},
            row_view: {},
            row_insert: {},
            row_update: {},
            insert_save: false,
            update_save: false,
            chkwatched: false,
            validateobj: {},
            title: "title",
            filtertxt: "",
            sortKey: "",
            sortOrders: {},

            perpage: 10,
            page: 1,
            total: 0,

            test: "start",
            loading: false,
            checked_all: 0,
            datas: [],
            columns: [],
            domains: [],
            ajax: 0,
            items: [],
            cols: []
        };
    },
    computed: {
        filteredData() {
            let self = this;
            let data = self.datas;
            let sortKey = self.sortKey;
            let filtertxt = self.filtertxt && self.filtertxt.toLowerCase();
            let order = self.sortOrders[sortKey] || 1;
            if (filtertxt) {
                data = data.filter(row => {
                    return this.columns.some(c => {
                        return (
                            String(row[c.key])
                            .toLowerCase()
                            .indexOf(filtertxt) > -1
                        );
                    });
                });
            }
            if (sortKey) {
                data = data.slice().sort(function(a, b) {
                    a = a[sortKey];
                    b = b[sortKey];
                    return (a === b ? 0 : +a > +b ? 1 : -1) * order;
                });
            }
            if (typeof data == "undefined") {
                return [];
            } else {
                return data;
            }
        },
        lists() {
            if (this.ajax) {
                return this.filteredData;
            } else {
                if (this.page > this.totalpage) {
                    this.page = 1;
                    this.$refs.paginate ? (this.$refs.paginate.selected = 0) : null;
                }
                let skip = (this.page - 1) * Number(this.perpage);
                let take = Number(skip) + Number(this.perpage);
                return this.filteredData.slice(skip, take);
            }
        },
        totalpage() {
            if (this.ajax) {
                return Math.ceil(this.total / this.perpage);
            }
            return Math.ceil(this.filteredData.length / this.perpage);
        },
        itempagestart() {
            return (this.page - 1) * this.perpage + 1;
        },
        itempageend() {
            return this.perpage * this.page;
        },
        viewobj() {
            let data = [];
            this.columns.map(col => {
                // console.log(col)
                if (col.visible) {
                    data.push({ label: col.label, value: this.row_view[col.key] });
                }
            });
            // console.log(data);
            return data;
        }
    },
    mounted() {
        // this.$nextTick(() => {
        //     this.$store.commit("hide");
        //     console.log("mounted---->", this.$store.state.overlay);
        // });
    },
    updated() {
        // this.$nextTick(() => {
        //     this.$store.commit("hide");
        //     console.log("updated---->", this.$store.state.overlay);
        // });
    }
    // components: {},
    // beforeCreate() {},
    // beforeMount() {},
    // beforeUpdate() {},
    // beforeDestroy() {},
    // destroyed() {},
};