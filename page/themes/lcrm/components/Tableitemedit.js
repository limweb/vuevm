export default {
    template: `
<div stype="display:inline;">
    <div v-if="col.inputtype=='color'">
        <span  :style="{background: item[col.key] }" style="padding: 7px;  text-align: center; display: inline-block;"></span>
        <span>{{item[col.key]}}</span>
    </div>
    <div v-else-if="col.inputtype=='checkbox' && (col.key).toLowerCase() == 'status'" ><input type="checkbox"  v-model="item[col.key]"  />{{fctf(item[col.key])}}</div>
    <div v-else-if="col.inputtype=='checkbox' && (col.key).toLowerCase() == 'visible'"><input type="checkbox"  v-model="item[col.key]"  />{{fctf(item[col.key])}}</div>
    <div v-else-if="col.inputtype=='checkbox'" ><input type="checkbox"  v-model="item[col.key]"  />{{fctf(item[col.key])}}</div>
    <div v-else-if="col.inputtype=='select'">
        <select v-model="item[col.key]" class="">
            <option v-for="r in $attrs.select[col.key]" :value="r[col.key]">{{r[col.key]}}</option>
        </select>
    </div>
    <div v-else >
        <span  v-if="col.readonly"> {{item[col.key]}} </span>
        <input v-else v-model="item[col.key]" type="text" />
        
    </div>
</div>
`,
    props: {
        col: {
            type: Object,
            required: true
        },
        item: {
            type: Object,
            required: true
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
        fctf(tf) {
            if (tf) {
                return true;
            } else {
                return false;
            }
        }
    },
    created() {
        // console.log("attrs", this.$attrs);
    }
};