export default {
    template: `
<div stype="display:inline;">
    <div v-if="col.inputtype=='color'">
        <span  :style="{background: item[col.key] }" style="padding: 7px;  text-align: center; display: inline-block;"></span>
        <span>{{item[col.key]}}</span>
    </div>
    <span v-else-if="col.inputtype=='checkbox' && (col.key).toLowerCase() == 'status'">{{fcstatus(item[col.key])}}</span>
    <span v-else-if="col.inputtype=='checkbox' && (col.key).toLowerCase() == 'visible'">{{fcvisible(item[col.key])}}</span>
    <div v-else-if="col.inputtype=='checkbox'" ><input type="checkbox"  v-model="item[col.key]" disabled />{{fctf(item[col.key])}}</div>
    <span v-else >{{item[col.key]}}</span>
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
            if(tf){
                return true;
            } else {
                return false;
            }
        }
    }
};