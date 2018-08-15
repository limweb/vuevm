export default {
    template:`
    <div class="controls">
        <div v-if="(item.label).toLowerCase() == 'status'">
            <input disabled  type="checkbox" v-model="item.value" >
            <span >{{fcstatus(item.value)}}</span>
        </div>
        <div v-else-if="(item.label).toLowerCase() == 'visible'">
            <input disabled  type="checkbox" v-model="item.value" >
            <span >{{fcvisible(item.value)}}</span>
        </div>
        <div v-else-if="(item.label).toLowerCase() == 'searchable'">
            <input disabled  type="checkbox" v-model="item.value" >
            <span >{{fcsearch(item.value)}}</span>
        </div>
        <div v-else-if="(item.label).toLowerCase() == 'orderable'">
            <input disabled  type="checkbox" v-model="item.value" >
            <span >{{fcorderble(item.value)}}</span>
        </div>
        <span v-else>{{item.value}}</span>
    </div>
    `,
    data() {
        return {
            
        }
    },
    props:{
        item:{
            type: Object,
            required: true
        }
    },
    methods:{
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
        fcsearch(sta) {
            if (sta) {
                return "Searchable";
            } else {
                return "NoSearchable";
            }
        },
        fcorderble(sta) {
            if (sta) {
                return "Orderable";
            } else {
                return "NoOrderable";
            }
        },
    }
}